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
		
		
			$sql = "SELECT pk_unidad as id, nombre as unidad FROM unidad"; 
					
		
		$result = $conn->query($sql);

		if($result->num_rows > 0){
		
			while($row = $result->fetch_assoc()){
				$row['id']= base64_encode($row['id']);
				$returnJs['unidad'][] = $row;
				
			}
		}
			$sql = "SELECT DISTINCT SUBSTRING_INDEX(fecha_ingreso, ' ', 1) as fecha FROM orden"; 
					
			
			$result = $conn->query($sql);

			if($result->num_rows > 0){
			
				while($row = $result->fetch_assoc()){
					
					$returnJs['fecha'][] = $row;
					
				}
			}
			 $result->free();
			echo json_encode($returnJs);
			$conn->close();
		}
	


?>