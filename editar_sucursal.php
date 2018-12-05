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
  <title>Edita sucursal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/edita_sucursal.js"></script>
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
  <div class="panel panel-default" style="width:50%; margin: 70px auto; text-align:center">
    <form action="#" style="margin: 10px;" id='formulario' autocomplete="off">
		<div class="well">		
				<input type="hidden" id="sucursal" name="estudio">	
			<div class="form-group">		 
				<label for="nombre">*Nombre:</label>
				<input type="text" class="form-control" id="nombre" name="nombre" placeholder="No Registrado">
			</div>
			 <div class="form-group">		
				<label for="dir">*Dirección:</label>
				<input type="text" class="form-control" id="dir" name="dir" placeholder="No Registrado">
			 </div>	
			 <div class="form-group">	
				<label for="tel">Teléfono:</label>
				<input type="text" class="form-control" id="tel" name="tel" placeholder="No Registrado">
			 </div>
			 <div class="form-group">	
				<label for="web">Sitio Web:</label>
				<input type="text" class="form-control" id="web" name="web" placeholder="No Registrado">
			 </div>
			 <div class="form-group">	
				<label for="email">Correo electrónico:</label>
				<input type="text" class="form-control" id="email" name="email" placeholder="No Registrado">
			 </div>
			  <button type="commit" class="btn btn-info" style="margin-right:25px;" >Guardar</button>
			  <button type="button" class="btn btn-danger" style="margin: 0 auto;" id="cancelar">Cancelar</button>
			  <br>
			  <br>
		</div>
 </form>
  </div>
</div>

</body>
</html>