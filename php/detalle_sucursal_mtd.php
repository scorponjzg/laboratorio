<?php 
session_start();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	if(isset($_SESSION['usuario']) && $_SESSION['usuario'] == 1){	
		require_once 'configMySQL.php';
		
		$returnJs = [];
		
		$conn = new mysqli($mysql_config['host'], $mysql_config['user'], $mysql_config['pass'], $mysql_config['db']);
		
		//check connection_aborted
		if($conn -> connect_error) {
			die("Connection failed: " . $conn -> connect_error);		
		}
		
		$conn -> set_charset('utf8');

		$id = isset($_POST['sucursal']) ? $conn->real_escape_string($_POST['sucursal']) : '';
			
		
			$sql = "SELECT pk_unidad as id, nombre as sucursal, direccion as lugar,IFNULL(telefono,'') as tel, IFNULL(web,'') as pagina, IFNULL(correo,'') as email FROM unidad WHERE activo=1  && pk_unidad=".base64_decode($id);
			
			$result = $conn->query($sql);
			if($result->num_rows == 1){
			
				$returnJs['sucursal'] = $result->fetch_assoc();
				$returnJs['sucursal']['id'] = base64_encode($returnJs['sucursal']['id']);
			 	$result->free();
			}
		
		echo json_encode($returnJs);
		$conn->close();
	}
}

?>