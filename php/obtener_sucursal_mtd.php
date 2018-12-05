<?php 
session_start();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	if(isset($_SESSION['usuario']) && $_SESSION['usuario'] == 1){
	
		
		require_once 'configMySQL.php';
		
		$returnJs = [];
		$returnJs['show']= false;
		
		$conn = new mysqli($mysql_config['host'], $mysql_config['user'], $mysql_config['pass'], $mysql_config['db']);
		
		//check connection_aborted
		if($conn -> connect_error) {
			die("Connection failed: " . $conn -> connect_error);		
		}
		$buscar = isset($_POST['buscar']) && $_POST['buscar'] !='' ? "&& nombre like '%".$conn -> real_escape_string($_POST['buscar'])."%';" : '';
		
		$conn -> set_charset('utf8');
			
			$sql = "SELECT clave, nombre, precio_publico FROM estudioClinico WHERE activo=1 ".$buscar; 
		
		
			$sql = "SELECT pk_unidad as id, nombre as sucursal, direccion as lugar,IFNULL(telefono,'No registrado') as tel, IFNULL(web,'No registrado') as pagina, IFNULL(correo,'No registrado') as email FROM unidad WHERE activo=1 ".$buscar; 
			$returnJs['show']= true;
		
		error_log($sql);
		$result = $conn->query($sql);

		if($result->num_rows > 0){
		
			while($row = $result->fetch_assoc()){
				$row['id']= base64_encode($row['id']);
				$returnJs['unidad'][] = $row;
				
			}
			 $result->free();
			echo json_encode($returnJs);
			$conn->close();
		}
	} else {

		header("HTTP/1.0 400 Bad Request");

		echo "No tiene los permisos requieridos";
	}
}

?>