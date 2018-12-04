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
  <title>Estudio</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/detalle_estudio.js"></script>
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
  <div class="panel panel-default" style="width:50%; margin: 50px auto; text-align:center">
    <form action="#" style="margin: 10px;" id='formulario' autocomplete="off">
		<div class="well">		
				<input type="hidden" id="estudio" name="estudio">	
			<div class="form-group">		 
				<label for="nombre">*Clave:</label>
				<input type="text" class="form-control editar" id="clave" name="clave" disabled>
			</div>
			 <div class="form-group">		
				<label for="a_paterno">*Nombre de estudio:</label>
				<input type="text" class="form-control editar" id="nombre" name="nombre" disabled>
			 </div>	
			 <div class="form-group">	
				<label for="a_materno">Precio p&uacute;blico:</label>
				<input type="number" class="form-control editar" id="precio" name="precio" disabled>
			 </div>
			 <div class="form-group">	
				<label for="edad">Costo:</label>
				<input type="number" class="form-control editar" id="costo" name="costo" placeholder="No Registrado" disabled>
			 </div>
			<div class="form-group">	
				<label for="direccion">Capturado/Editado por:</label>
				<div class="read" id="modificador"></div>
				</div>
			
			 <div class="form-group">		 
				<label>Fecha registro</label>
				<div class="read" id="registro"></div>
				
			</div>
			 <div class="form-group">		
				<label for="editado" >Fecha de modificaci&oacute;n:</label>
				<div class="read" id="editado"></div>
				
			 </div>	
			 
			 					
			  <button type="button" class="btn btn-success btnPrincipal" onclick="window.location.href='estudio.php'" style="margin-right:25px" id="regresar">Regresar</button>
			  <button type="button" class="btn btn-info btnPrincipal" style="margin-right:25px;" id="editar">Editar</button>
			  <button type="button" class="btn btn-danger btnPrincipal" style="margin: 0 auto;" id="eliminar">Eliminar</button>
			  <button type="commit" class="btn btn-info btnEditar" style="margin-right:25px;display:none;" >Guardar</button>
			  <button type="button" class="btn btn-danger btnEditar" style="margin: 0 auto;display:none;" id="cancelar">Cancelar</button>
			  <br>
			  <br>
		</div>
 </form>
  </div>
</div>

</body>
</html>