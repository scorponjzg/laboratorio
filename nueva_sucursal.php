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
  <title>Nueva sucursal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/nueva_sucursal.js"></script>
</head>
<body> 
 <style>
 	
 	input {
 		text-align: center;
 	}

 	
 </style>
<div class="container">
  <?php include 'navMenu.php'?>
  <div class="panel panel-default" style="width:50%; margin: 80px auto; text-align:center">
    <form action="#" style="margin: 10px;" id='formulario' autocomplete="off">
		<div class="well">		
			<div class="form-group">		 
				<label for="nombre">*Nombre:</label>
				<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese un nombre">
			</div>
			 <div class="form-group">		
				<label for="dir">*Direcci&oacute;n:</label>
				<input type="text" class="form-control" id="dir" name="dir" placeholder="Ingrese una dirección">
			 </div>	
			 <div class="form-group">	
				<label for="tel">Tel&eacute;fono:</label>
				<input type="text" class="form-control" id="tel" name="tel" placeholder="Ingrese un n&uacute;mero telef&oacute;nico">
			 </div>
			 <div class="form-group">	
				<label for="web">Sitio Web:</label>
				<input type="text" class="form-control" id="web" name="web" placeholder="Ingrese un sitio web">
			 </div>
			  <div class="form-group">	
				<label for="email">Correo electr&oacute;nico:</label>
				<input type="text" class="form-control" id="email" name="email" placeholder="Ingrese un correo electr&oacute;nico">
			 </div>
					  
			  <button type="commit" class="btn btn-info " style="margin-right:25px;" >Guardar</button>
			  <button type="button" class="btn btn-danger " style="margin: 0 auto;" onclick="window.location.replace('estudio.php');">Cancelar</button>
			  <br>
			  <br>
		</div>
 </form>
  </div>
</div>

</body>
</html>