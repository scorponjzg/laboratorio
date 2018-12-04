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

		$id_estudio = isset($_POST['estudio']) ? $conn->real_escape_string($_POST['estudio']) : '';
			
			$sql = "UPDATE estudioClinico SET activo=0,quien_modifico=(SELECT CONCAT(u.a_paterno, ' ', u.a_materno, ' ', u.nombre, '. Perfil: ',p.perfil ) FROM usuario as u LEFT JOIN perfil as p ON u.fk_perfil=p.pk_perfil WHERE u.pk_usuario={$_SESSION['usuario']}) WHERE pk_estudioClinico=".base64_decode($id_estudio)."; ";
				error_log($sql);
			$conn->query($sql);

			//error_log($result->num_rows);
			if($conn->affected_rows == 1){
			
				$returnJs['editado'] = 'true';
			
			}
		
		echo json_encode($returnJs);
		$conn->close();
	} else {

		header("HTTP/1.0 400 Bad Request");

		echo "No tiene los permisos requieridos";
	}

}