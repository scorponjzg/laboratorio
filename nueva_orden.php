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
  <script src="js/numerosALetras.js"></script>
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
			<label >Seleccione los estudios:</label>
			<div class="row">
				<div class="col-sm-9" style="padding-right:0px;">
					<div class="form-group" style="width:100%">
					 	<select class="selectpicker" data-live-search="true" data-width="100%" id="select">
						</select>

					</div>
				</div>
				<div class="col-sm-3" style="padding-left:0px;">
					<div class="form-group" style="width:100%">
						 <button type="button" class="btn btn-success" style="width:100%" onclick="agregarEstudio()">Agregar estudio</button>
					</div>
				</div>
			
			</div>
		<div class="row">
  			<div class="col-sm-4">		
				<div class="form-group">		 
					<label for="ap"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>Apellido paterno:</label>
					<input type="text" class="form-control" id="ap" name="ap" placeholder="Ingrese el apellido paterno">
				</div>
			</div>
			<div class="col-sm-4">		
			 <div class="form-group">		
				<label for="am">Apellido materno:</label>
				<input type="text" class="form-control" id="am" name="am" placeholder="Ingrese el apellido materno">
			 </div>	
			</div>	
			 <div class="col-sm-4">		
			 <div class="form-group">	
				<label for="nombre"><span class="glyphicon glyphicon-asterisk" aria-hidden="true">Nombres:</label>
				<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese un nombre">
			 </div>
			</div>
		</div>
		<div class="row">
  			<div class="col-sm-4">
				 <div class="form-group">	
					<label for="edad"><span class="glyphicon glyphicon-asterisk" aria-hidden="true">Edad:</label>
					<input type="number" class="form-control" min="0" id="edad" name="edad" placeholder="Ingrese edad del paciente">
				 </div>
			 </div>
			 <div class="col-sm-4">
				  <div class="form-group">	
					<label for="sexo"><span class="glyphicon glyphicon-asterisk" aria-hidden="true">Sexo:</label>
						<select class="form-control"  id="sexo" name="sexo">
							<option value="0">Escoja una opción</option>
							<option value="Masculino" style="background-color: rgb(82,188,220),">Masculino</option>
							<option value="Femenino" style="background-color: pink,">Femenino</option>
						</select>
					
				 </div>
			 </div>
			 <div class="col-sm-4">
				 <div class="form-group">	
					<label for="tel">Tel&eacute;fono:</label>
					<input type="text" class="form-control" id="tel" name="tel" placeholder="Ingrese n&uacute;mero tel&eacute;fonico">
				 </div>
			 </div>
			 <div class="form-group">
			 	<table class="table table-bordered">
			 		<thead>
			 			<tr>
			 				<th class="info" style="width:15%"></th>
			 				<th class="info" style="width:60%; text-align: center">Estudios</th>
			 				<th class="info" style="width:10%"></th>
			 				<th class="info" style="width:10%"></th>
			 			</tr>
			 		</thead>
			 		<tbody id="estudioSeleccionado">
			 			
			 		</tbody>
			 	</table>
			 	<table class="table table-bordered">
			 		<thead>
			 			<tr>
			 				<th class="info" style="width: 80%;">Importe en letra</th>
			 				<th class="info" style="width: 20%;text-align: center">total</th>
			 				
			 			</tr>
			 		</thead>
			 		<tbody>
			 			<tr>
			 				<td style="text-align: left;" id="totalEnLetra">CERO 00/100 M.N.</th>
			 				<td id="total">0</th>
			 				
			 			</tr>
			 		</tbody>
			 	</table>
			 </div>
					  
			  <button type="commit" class="btn btn-info " style="margin-right:25px;" >Guardar</button>
			  <button type="button" class="btn btn-danger " style="margin: 0 auto;" onclick="window.location.replace('visor_general_laboratorio.php');">Cancelar</button>
			  <br>
			  <br>
		</div>
 </form>
  </div>
</div>

</body>
</html>