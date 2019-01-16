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
	$buscar = isset($_POST['buscar']) && $_POST['buscar'] !='' ? " && nombre like '%".$conn -> real_escape_string($_POST['buscar'])."%';" : '';
	$sucursal = isset($_POST['sucursal']) && $_POST['sucursal'] !='0' ? " && o.fk_unidad = ".base64_decode($conn -> real_escape_string($_POST['sucursal'])) : " && o.fk_unidad = ".$_SESSION['id_unidad'];
	$fecha = isset($_POST['fecha']) && $_POST['fecha'] !='0' ? " && SUBSTRING_INDEX(o.fecha_ingreso, ' ', 1) = '".$conn -> real_escape_string($_POST['fecha'])."'" : " && SUBSTRING_INDEX(o.fecha_ingreso, ' ', 1) = '".date('Y-m-d')."'";
	
	$conn -> set_charset('utf8');
		
		$sql = "SELECT  CONCAT(u.a_paterno,' ',IFNULL(u.a_materno,''),' ',u.nombre) as atendio, o.pk_orden as id, o.folio, SUBSTRING_INDEX(o.fecha_ingreso, ' ', 1) as registro , o.estatus as estado, o.precio_total as total FROM orden as o INNER JOIN usuario as u ON u.pk_usuario = o.fk_usuario  WHERE o.pk_orden>0 ".$sucursal.$fecha.$buscar; 
		
	if(isset($_SESSION['tipo']) && $_SESSION['tipo'] == 1){
		$sql = "SELECT  CONCAT(u.a_paterno,' ',IFNULL(u.a_materno,''),' ',u.nombre) as atendio, o.pk_orden as id, o.folio, SUBSTRING_INDEX(o.fecha_ingreso, ' ', 1) as registro , o.estatus as estado, o.precio_total as total,o.costo_total as costo FROM orden as o INNER JOIN usuario as u ON u.pk_usuario = o.fk_usuario  WHERE o.pk_orden>0 ".$sucursal.$fecha.$buscar;
		$returnJs['show']= true;
	}
	
	$result = $conn->query($sql);

	if($result->num_rows >= 0){
	
	while($row = $result->fetch_assoc()){
		$sql = "SELECT COUNT(*) as estudios FROM estudio WHERE fk_orden = ".$row['id'];
		$result2 = $conn->query($sql);
		$row['id']= base64_encode($row['id']);
		if($result2->num_rows == 1){
			
			$returnJs['orden'][] = array_merge($row,$result2->fetch_assoc());
		}
		
	 	$result2->free();
	}
	 $result->free();
	echo json_encode($returnJs);
	$conn->close();
}
} 

?>