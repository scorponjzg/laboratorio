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

		$id_estudio = isset($_POST['estudio']) ? $conn->real_escape_string($_POST['estudio']) : '';
		$clave = isset($_POST['clave']) ? $conn->real_escape_string($_POST['clave']) : '';
		$nombre = isset($_POST['nombre']) ? $conn->real_escape_string($_POST['nombre']) : '';
		$precio = isset($_POST['precio']) ? $conn->real_escape_string($_POST['precio']) : '';
		$costo = isset($_POST['costo']) ? $conn->real_escape_string($_POST['costo']) : '';
			
			$sql = "UPDATE estudioClinico SET clave='{$clave}', nombre='{$nombre}', precio_publico={$precio}, precio_proveedor={$costo}, quien_modifico=(SELECT CONCAT(u.a_paterno, ' ', u.a_materno, ' ', u.nombre, '. Perfil: ',p.perfil ) FROM usuario as u LEFT JOIN perfil as p ON u.fk_perfil=p.pk_perfil WHERE u.pk_usuario={$_SESSION['usuario']}) WHERE pk_estudioClinico=".base64_decode($id_estudio)."; ";
				
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