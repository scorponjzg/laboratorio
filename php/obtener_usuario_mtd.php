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
	$buscar = isset($_POST['buscar']) && $_POST['buscar'] !='' ? "&& CONCAT(u.nombre,' ', u.a_paterno,' ', IFNULL(u.a_materno, ''))  like '%".$conn -> real_escape_string($_POST['buscar'])."%';" : '';
	
	$conn -> set_charset('utf8');
		
		
	
	if(isset($_SESSION['usuario']) && $_SESSION['usuario'] == 1){
		$sql = "SELECT u.pk_usuario as id, CONCAT(u.nombre,' ', u.a_paterno,' ', IFNULL(u.a_materno, '')) as nombre, p.perfil, uni.nombre as sucursal FROM usuario as u ".
	"INNER JOIN perfil as p ON u.fk_perfil=p.pk_perfil ".
	"INNER JOIN unidad as uni ON u.fk_unidad=uni.pk_unidad ".
	"WHERE u.activo = 1 ".$buscar; 
		$returnJs['show']= true;
	}else{
		$returnJs['msg'] = "NO cuenta con los permisos necesarios para ver está información.";
	}
	
	$result = $conn->query($sql);

	if($result->num_rows >= 0){
	
	while($row = $result->fetch_assoc()){
		$row['id']= base64_encode($row['id']);
		$returnJs['usuario'][] = $row;
		
	}
	 $result->free();
	echo json_encode($returnJs);
	$conn->close();
}
} 

?>