<?php

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	
	session_start();

	$_SESSION = array();
	
	require_once 'configMySQL.php';

	$conn = new mysqli($mysql_config['host'], $mysql_config['user'], $mysql_config['pass'], $mysql_config['db']);
		// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	$conn->set_charset("utf8");
	
	$usuario = isset($_POST['usuario']) ? $conn->real_escape_string($_POST['usuario']) : '';
	$contrasena = isset($_POST['contrasena']) ? $conn->real_escape_string($_POST['contrasena']) : ''; 
	$returnJs = [];
	$returnJs['registrado'] = false;
				
	$sql = "SELECT u.pk_usuario, CONCAT(u.nombre,' ', u.a_paterno,' ', IFNULL(u.a_materno, '')) as nombre, u.fk_perfil,m.modulo,p.perfil FROM usuario as u ".
	"INNER JOIN perfil as p ON u.fk_perfil=p.pk_perfil ".
	"LEFT JOIN permiso as per on per.fk_perfil=p.pk_perfil ".
	"LEFT JOIN modulo as m ON per.fk_modulo=m.pk_modulo ".
	"WHERE usuario = '{$usuario}' && contrasena = '".sha1($contrasena)."' && activo = 1;";
			//error_log($sql);						
	$result = $conn->query($sql);
	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
		$returnJs['registrado'] = true ;
		$result->free();
		$_SESSION['usuario'] = $row['pk_usuario'];
		$_SESSION['tipo'] = $row['fk_perfil'] ;
		$_SESSION['nombre'] = $row['nombre'] ;
		//error_log(print_r($row, true));
	}
					
	echo json_encode($returnJs);
	$conn->close();
}


