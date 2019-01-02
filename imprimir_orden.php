<?php 
session_start();
if (!isset($_SESSION["tipo"]) && !isset($_SESSION["usuario"]) && $_SESSION['tipo'] == 1) {
    header("Location: index.php"); /* Redirect browser */
	
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Imprimir orden</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="css/bootstrap-select.min.css">
  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap-select.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/imprimir_orden.js"></script>
  <script src="js/numerosALetras.js"></script>
</head>
<body> 
 <style>
 	
 	input {
 		text-align: center;

 	}

 </style>
<div class="container">

  <div class="panel panel-default" style="width:60%; margin: 80px auto; text-align:center">
  
  </div>
</div>

</body>
</html>