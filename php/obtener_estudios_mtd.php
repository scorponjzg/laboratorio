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
	$buscar = isset($_POST['buscar']) && $_POST['buscar'] !='' ? "&& nombre like '%".$conn -> real_escape_string($_POST['buscar'])."%';" : '';
	
	$conn -> set_charset('utf8');
		
		$sql = "SELECT clave as codigo, nombre as estudio, precio_publico as precio,pk_estudioClinico as id FROM estudioclinico WHERE activo=1 ".$buscar; 
	
	if(isset($_SESSION['tipo']) && $_SESSION['tipo'] == 1){
		$sql = "SELECT clave as codigo, nombre as estudio, precio_publico as precio,IFNULL(precio_proveedor,'No registrado') as costo, pk_estudioClinico as id FROM estudioclinico WHERE activo=1 ".$buscar; 
		$returnJs['show']= true;
	}
	$returnJs['sql'] = $sql;
	$result = $conn->query($sql);

	if($result->num_rows > 0){
	
		while($row = $result->fetch_assoc()){
			$row['id']= base64_encode($row['id']);
			$returnJs['estudio'][] = $row;
			
		}
		 $result->free();
		
	}
	echo json_encode($returnJs);
	$conn->close();
} 

?>