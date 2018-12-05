<?php 
session_start();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	
	if(isset($_SESSION['usuario']) && $_SESSION['usuario'] == 1){

		require_once 'configMySQL.php';
		
		$returnJs = [];
		$returnJs['editado'] = 'Por el momento no se encuentra en la funcionalidad activa, intente en otro momento.';
		$noCambios = 0;
		$conn = new mysqli($mysql_config['host'], $mysql_config['user'], $mysql_config['pass'], $mysql_config['db']);
		
		//check connection_aborted
		if($conn -> connect_error) {
			die("Connection failed: " . $conn -> connect_error);		
		}
		
		$conn -> set_charset('utf8');

		$id = isset($_POST['estudio']) ? $conn->real_escape_string($_POST['estudio']) : '';
		$nombre = isset($_POST['nombre']) ? $conn->real_escape_string($_POST['nombre']) : '';
		$dir = isset($_POST['dir']) ? $conn->real_escape_string($_POST['dir']) : '';
		$tel = isset($_POST['tel']) ? $conn->real_escape_string($_POST['tel']) : '';
		$web = isset($_POST['web']) ? $conn->real_escape_string($_POST['web']) : '';
		$email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';
			
			$sql = "UPDATE unidad SET nombre='{$nombre}', direccion='{$dir}', telefono='{$tel}', web='{$web}', correo='{$email}' WHERE pk_unidad=".base64_decode($id)."; ";
				
			$noCambios = $conn->query($sql);
			
			if($conn->affected_rows == 1){
			
				$returnJs['editado'] = 'true';
			
			} else {

				if($noCambios == 1){
					$returnJs['editado']="No realizó ningún cambio.";
				}
			}
		
		echo json_encode($returnJs);
		$conn->close();
	} else {

		header("HTTP/1.0 400 Bad Request");

		echo "No tiene los permisos requieridos";
	}

}