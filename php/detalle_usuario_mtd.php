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

	$id = isset($_POST['usuario']) ? $conn->real_escape_string($_POST['usuario']) : '';
		
	if(isset($_SESSION['usuario']) && $_SESSION['usuario'] == 1){
		$sql = "SELECT u.pk_usuario as id, p.perfil, u.fk_perfil as idP, u.fk_unidad as idU, u.nombre, u.a_paterno as ap, u.a_materno as am, u.usuario, uni.nombre as unidad FROM usuario as u INNER JOIN unidad as uni ON uni.pk_unidad = u.fk_unidad INNER JOIN perfil as p ON p.pk_perfil= u.fk_perfil  WHERE u.activo=1 && u.pk_usuario > 1 && u.pk_usuario=".base64_decode($id); 
			
		$result = $conn->query($sql);
		if($result->num_rows == 1){
		
			$returnJs['usuario'] = $result->fetch_assoc();
			$returnJs['usuario']['id'] = base64_encode($returnJs['usuario']['id']);
			$returnJs['usuario']['idP'] = base64_encode($returnJs['usuario']['idP']);
			$returnJs['usuario']['idU'] = base64_encode($returnJs['usuario']['idU']);
		 	$result->free();
		}
	}
	echo json_encode($returnJs);
	$conn->close();
}

?>