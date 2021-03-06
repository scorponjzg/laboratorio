<?php 
session_start();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
		
	require_once 'configMySQL.php';
	
	$returnJs = [];
	
	$conn = new mysqli($mysql_config['host'], $mysql_config['user'], $mysql_config['pass'], $mysql_config['db']);
	
	//check connection_aborted
	if($conn -> connect_error) {
		die("Connection failed: " . $conn -> connect_error);		
	}
	
	$conn -> set_charset('utf8');

	$id = isset($_POST['estudio']) ? $conn->real_escape_string($_POST['estudio']) : '';
		
	if(isset($_SESSION['usuario']) && $_SESSION['usuario'] == 1){
		$sql = "SELECT clave as codigo, nombre as estudio, precio_publico as precio,IFNULL(precio_proveedor,'') as costo, pk_estudioClinico as id, create_time as fecha_registro, IFNULL(update_time,'No editado') as fecha_editado, quien_modifico as responsable FROM estudioclinico WHERE activo=1 && pk_estudioClinico=".base64_decode($id); 
		$result = $conn->query($sql);
		if($result->num_rows == 1){
		
			$returnJs['estudio'] = $result->fetch_assoc();
			$returnJs['estudio']['id'] = base64_encode($returnJs['estudio']['id']);
		 	$result->free();
		}
	}
	echo json_encode($returnJs);
	$conn->close();
}

?>