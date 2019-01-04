<?php 
session_start();
function RandomString(){
	$sucursal = explode(" ",$_SESSION["unidad"]);
	$iniciales = "";
	for($i=0; $i < count($sucursal); $i++){
		$iniciales .= substr($sucursal[$i], 0,  1);
	}
    $characters = '0123456789';//abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ
    $randstring = '';
    for ($i = 0; $i < 8; $i++) {
        $randstring = $randstring.$characters[rand(0, strlen($characters))];
    }
    return $iniciales.$randstring;
}
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	
	

		require_once 'configMySQL.php';
		
		$returnJs = [];
		$estudio = [];
		$total = 0;
		$folio = RandomString();
		$returnJs['ingresado'] = 'true';
		$noCambios = 0;
		$conn = new mysqli($mysql_config['host'], $mysql_config['user'], $mysql_config['pass'], $mysql_config['db']);
		
		//check connection_aborted
		if($conn -> connect_error) {
			die("Connection failed: " . $conn -> connect_error);		
		}
		
		$conn -> set_charset('utf8');

		$id_estudio = isset($_POST['estudio']) ? $conn->real_escape_string($_POST['estudio']) : '';
		$ap = isset($_POST['ap']) ? $conn->real_escape_string($_POST['ap']) : '';
		$am = isset($_POST['am']) ? $conn->real_escape_string($_POST['am']) : '';
		$nombre = isset($_POST['nombre']) ? $conn->real_escape_string($_POST['nombre']) : '';
		$edad = isset($_POST['edad']) ? $conn->real_escape_string($_POST['edad']) : '';
		$sexo = isset($_POST['sexo']) ? $conn->real_escape_string($_POST['sexo']) : '';
		$tel = isset($_POST['tel']) ? $conn->real_escape_string($_POST['tel']) : '';
		//error_log(print_r($_POST,true));
		//error_log(print_r($_SESSION,true));

		foreach ($_POST as $key => $value) {
			if(strpos($key,"estudio")!== false){
				$estudio[]=$value;
			}
		}

		 $pk = implode(",", $estudio);

		 $sql = "SELECT SUM(precio_publico) as total FROM estudioClinico WHERE pk_estudioClinico IN ($pk)";
		 //error_log($sql);
		 $result = $conn->query($sql);
			
		if($result->num_rows == 1){
	
			$total = $result->fetch_assoc();

			if($total > 0){
				$conn->query("START TRANSACTION;");
				$sql = "INSERT INTO orden(folio, a_paterno_paciente, a_materno_paciente, nombre_paciente, edad, sexo, telefono, fk_usuario, fk_unidad,precio_total) VALUES('{$folio}','{$ap}','{$am}','{$nombre}',{$edad},'{$sexo}','{$tel}',{$_SESSION['usuario']},{$_SESSION['id_unidad']},{$total['total']});";
				//error_log($sql);
				$conn->query($sql);

				
				if($conn->affected_rows == 1){
					$last_id = $conn -> insert_id;
					
					for($i=0; $i < count($estudio); $i++){
						$sql = "INSERT INTO estudio(fk_estudioClinico,fk_orden,cantidad,costo) VALUES({$estudio[$i]},{$last_id},(SELECT precio_publico FROM estudioClinico WHERE pk_estudioClinico={$estudio[$i]}),(SELECT IFNULL(precio_proveedor,0) FROM estudioClinico WHERE pk_estudioClinico={$estudio[$i]}));";
							
							$conn->query($sql);
							
							if($conn->affected_rows != 1){
								$returnJs['ingresado']="5.Por el momento no se encuentra disponible el módulo de ordenes, por favor contacte al administrador del sistema.";
							}
					}
					
				
				} else {
					$returnJs['ingresado']="4.Por el momento no se encuentra disponible el módulo de ordenes, por favor contacte al administrador del sistema.";
				}

			}else{
				$returnJs['ingresado']="3.Por el momento no se encuentra disponible el módulo de ordenes, por favor contacte al administrador del sistema.";
			}
		} else {
				$returnJs['ingresado']="2.Por el momento no se encuentra disponible el módulo de ordenes, por favor contacte al administrador del sistema.";
		}
		
		if($returnJs["ingresado"] == "true"){
			$conn->query("COMMIT;");
			//error_log("COMMIT");
			$returnJs['nueva']=base64_encode($last_id);
		} else {
			error_log("ROLLBACK in nueva_orden_mtd.php");
			$conn->query("ROLLBACK;");
		}
		echo json_encode($returnJs);
		$result->free();
		$conn->close();
	} else {

		$returnJs['ingresado']="1.Por el momento no se encuentra disponible el módulo de ordenes, por favor contacte al administrador del sistema.";

	}
		
	

