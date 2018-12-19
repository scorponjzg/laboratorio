<?php 
function RandomString(){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 10; $i++) {
        $randstring = $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}
session_start();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	
	if(isset($_SESSION['usuario']) && $_SESSION['usuario'] == 1){

		require_once 'configMySQL.php';
		
		$returnJs = [];
		$returnJs['ingresado'] = 'Por el momento no se encuentra en la funcionalidad activa, intente más tarde.';
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

		if($costo != ''){
			$sql = "INSERT INTO estudioClinico(clave,nombre,precio_publico,precio_provedor,tipo_ingreso,quien_modifico) VALUES('{$clave}','{$nombre}',{$precio},{$costo},'Ingreso por sistema',(SELECT CONCAT(u.a_paterno, ' ', u.a_materno, ' ', u.nombre, '. Perfil: ',p.perfil ) FROM usuario as u LEFT JOIN perfil as p ON u.fk_perfil=p.pk_perfil WHERE u.pk_usuario={$_SESSION['usuario']}));";
		} else {
			$sql = "INSERT INTO estudioClinico(clave,nombre,precio_publico,tipo_ingreso,quien_modifico) VALUES('{$clave}','{$nombre}',{$precio},'Ingreso por sistema',(SELECT CONCAT(u.a_paterno, ' ', u.a_materno, ' ', u.nombre, '. Perfil: ',p.perfil ) FROM usuario as u LEFT JOIN perfil as p ON u.fk_perfil=p.pk_perfil WHERE u.pk_usuario={$_SESSION['usuario']}));";
		}
			
			$conn->query($sql);
			
			if($conn->affected_rows == 1){
			
				$returnJs['ingresado'] = 'true';
			
			} else {

				if($noCambios == 1){
					$returnJs['ingresado']="No realizó ningún cambio.";
				}
			}
		
		echo json_encode($returnJs);
		$conn->close();
	} else {

		header("HTTP/1.0 400 Bad Request");

		echo "No tiene los permisos requieridos";
	}

}