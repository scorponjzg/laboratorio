<?php 
session_start();
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	
	
	
	require_once 'configMySQL.php';
	
	$returnJs = [];
	$returnJs['show']= false;
	
	$conn = new mysqli($mysql_config['host'], $mysql_config['user'], $mysql_config['pass'], $mysql_config['db']);
	
	//check connection_aborted
	if($conn -> connect_error) {
		die("Connection failed: " . $conn -> connect_error);		
	}
	$orden = isset($_POST['orden']) ? $conn -> real_escape_string($_POST['orden']) : 0;
	
	$conn -> set_charset('utf8');
		
	$sql = "SELECT CONCAT(u.a_paterno,' ',IFNULL(u.a_materno,''),', ',u.nombre) AS atendio, uni.*, o.folio, CONCAT(o.a_paterno_paciente,' ', IFNULL(o.a_materno_paciente,''),', ',o.nombre_paciente) AS nombre, o.edad, o.sexo,IFNULL(o.telefono,'') AS tel, DATE_FORMAT(o.fecha_ingreso, '%h:%i' ) AS hora_ingreso,  DATE_FORMAT(o.fecha_ingreso, '%d:%m:%Y' ) as f_ingreso , DATE_FORMAT(NOW(), '%d:%m:%Y') as f_impresion, o.precio_total as total FROM orden AS o INNER JOIN usuario AS u ON u.pk_usuario = o.fk_usuario INNER JOIN unidad AS uni ON uni.pk_unidad = o.fk_unidad WHERE estatus=1 && pk_orden = ".base64_decode($orden);
		
		//error_log($sql);
	$result = $conn->query($sql);

	if($result->num_rows == 1){
		
		$returnJs['orden'] = $result->fetch_assoc();
		
	} else {
		error_log($conn->error);
	}

	$sql = "SELECT e.cantidad AS precio, ec.nombre AS estudio, ec.clave AS codigo FROM estudio as e INNER JOIN estudioClinico as ec ON e.fk_estudioClinico = ec.pk_estudioClinico WHERE e.fk_orden =".base64_decode($orden);
	//error_log($sql);
	$result2 = $conn->query($sql);

	if($result2->num_rows >= 0){
		
		while($row = $result2->fetch_assoc()){
			
			$returnJs['estudio'][] = $row;
			
		}
	}
		 $result->free();
	 	 $result2->free();
		 echo json_encode($returnJs);
		 $conn->close();

} 

?>