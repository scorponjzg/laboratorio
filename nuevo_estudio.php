<?php 
session_start();
if (!isset($_SESSION["tipo"]) && !isset($_SESSION["usuario"])) {
    header("Location: index.php"); /* Redirect browser */
	
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Nuevo estudio</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/nuevo_estudio.js"></script>
</head>
<body> 
 <style>
 	
 	input {
 		text-align: center;
 	}

 	.read{
 		border: #ccc 1px solid;
 		padding: 6px 12px;
 		border-radius: 4px;
 		font-size: 14px;
 		color: #555;
 	}
 </style>
<div class="container">
  <?php include 'navMenu.php'?>
  <div class="panel panel-default" style="width:50%; margin: 80px auto; text-align:center">
    <form action="#" style="margin: 10px;" id='formulario' autocomplete="off">
		<div class="well">		
			<div class="form-group">		 
				<label for="clave">*Clave:</label>
				<input type="text" class="form-control editar" id="clave" name="clave">
			</div>
			 <div class="form-group">		
				<label for="nombre">*Nombre de estudio:</label>
				<input type="text" class="form-control editar" id="nombre" name="nombre">
			 </div>	
			 <div class="form-group">	
				<label for="precio">Precio p&uacute;blico:</label>
				<input type="number" class="form-control editar" id="precio" name="precio">
			 </div>
			 <div class="form-group">	
				<label for="costo">Costo:</label>
				<input type="number" class="form-control editar" id="costo" name="costo">
			 </div>
					  
			  <button type="commit" class="btn btn-info btnEditar" style="margin-right:25px;" >Guardar</button>
			  <button type="button" class="btn btn-danger btnEditar" style="margin: 0 auto;" onclick="window.location.replace('estudio.php');">Cancelar</button>
			  <br>
			  <br>
		</div>
 </form>
  </div>
</div>

</body>
</html>