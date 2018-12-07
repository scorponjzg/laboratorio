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
  <title>Nueva orden</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="css/bootstrap-select.min.css">
  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap-select.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/nueva_orden.js"></script>
</head>
<body> 
 <style>
 	
 	input {
 		text-align: center;
 	}

 	
 </style>
<div class="container">
  <?php include 'navMenu.php'?>
  <div class="panel panel-default" style="width:60%; margin: 80px auto; text-align:center">
    <form action="#" style="margin: 0px;" id='formulario' autocomplete="off">
		<div class="well" style="margin: 0px">		
			<div class="form-group">		 
				<label for="ap">*Apellido paterno:</label>
				<input type="text" class="form-control" id="ap" name="ap" placeholder="Ingrese el apellido paterno">
			</div>
			 <div class="form-group">		
				<label for="am">Apellido materno:</label>
				<input type="text" class="form-control" id="am" name="am" placeholder="Ingrese el apellido materno">
			 </div>	
			 <div class="form-group">	
				<label for="nombre">*Nombres:</label>
				<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese un nombre">
			 </div>
			 <div class="form-group">	
				<label for="edad">*Edad:</label>
				<input type="text" class="form-control" id="edad" name="edad" placeholder="Ingrese la edad del paciente">
			 </div>
			  <div class="form-group">	
				<label for="sexo">*Sexo:</label>
				<input type="text" class="form-control" id="sexo" name="sexo" placeholder="Ingrese el sexo del paciente">
			 </div>
			 <div class="form-group">	
				<label for="tel">Tel&eacute;fono:</label>
				<input type="text" class="form-control" id="tel" name="tel" placeholder="Ingrese un n&uacute;mero tel&eacute;fonico">
			 </div>
			 <div class="form-group" style="width:100%">
			 	<label for="estudios">Seleccione los estudios:</label>
			 	<select class="selectpicker dropdown" data-live-search="true" data-width="100%" id="select">
				</select>

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