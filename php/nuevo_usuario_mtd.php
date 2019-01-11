<?php 
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

		$nombre = isset($_POST['nombre']) ? $conn->real_escape_string($_POST['nombre']) : '';
		$ap = isset($_POST['ap']) ? $conn->real_escape_string($_POST['ap']) : '';
		$am = isset($_POST['am']) ? $conn->real_escape_string($_POST['am']) : '';
		$usuario = isset($_POST['usuario']) ? $conn->real_escape_string($_POST['usuario']) : '';
		$clave = isset($_POST['clave']) ? $conn->real_escape_string($_POST['clave']) : '';
		$perfil = isset($_POST['perfil']) ? $conn->real_escape_string(base64_decode($_POST['perfil'])) : '';
		$sucursal = isset($_POST['sucursal']) ? $conn->real_escape_string(base64_decode($_POST['sucursal'])) : '';
		
			$sql = "INSERT INTO usuario(fk_perfil, fk_unidad, nombre, a_paterno, a_materno,usuario,contrasena) VALUES({$perfil},{$sucursal},'{$nombre}','{$ap}','{$am}','{$usuario}','".sha1($clave)."');";
		
			error_log($sql);
			$conn->query($sql);
			
			if($conn->affected_rows == 1){
			
				$returnJs['ingresado'] = 'true';
			
			} else {

				
					$returnJs['ingresado']="Por el momento no se encuentra disponible la funcionlidad, por favor intente en otro momento.";
				
			}
		
		echo json_encode($returnJs);
		$conn->close();
	} else {

		header("HTTP/1.0 400 Bad Request");

		echo "No tiene los permisos requieridos";
	}

}