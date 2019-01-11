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
  <title>Nuevo usuario</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/nuevo_usuario.js"></script>
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
				<label for="ap">*Apellido paterno:</label>
				<input type="text" class="form-control" id="ap" name="ap" placeholder="Ingrese el apellido paterno">
			 </div>	
			 <div class="form-group">	
				<label for="am">Apellido materno:</label>
				<input type="text" class="form-control" id="am" name="am" placeholder="Ingrese el apellido materno">
			 </div>
			<div class="form-group">		 
				<label for="nombre">*Nombre(s):</label>
				<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese un nombre">
			</div>
			<div class="well">
				 <div class="form-group">	
					<label for="usuario">*Usuario para acceder al sistema:</label>
					<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingrese el nombre de usuario con el que se accederá al sistema">
				 </div>
				  <div class="form-group">	
					<label for="clave">*Clave de acceso al sistema:</label>
					<input type="text" class="form-control" id="clave" name="clave" placeholder="Ingrese la contraseña con la que se ingresara al sistema">
				 </div>
				 <div class="form-group">	
					<label for="confirmacion">*Confirmar clave:</label>
					<input type="text" class="form-control" id="confirmacion" placeholder="Confirme la contraseña de arriba">
				 </div>
			</div>
			 <div class="form-group">
			 	<label for="perfil">*Perfil de usuario:</label>
			 	<select class="form-control" id="perfil" name="perfil">
			        <option value="0">seleccione un perfil</option>
			    </select>
			 </div>
			 <div class="form-group">
			 	<label for="sucursal">*Sucursal:</label>
			 	<select class="form-control" id="sucursal" name="sucursal">
			        <option Value="0">Seleccione la sucursal asignada</option>
			    </select>
			 </div>
					  
			  <button type="commit" class="btn btn-info " style="margin-right:25px;" >Guardar</button>
			  <button type="button" class="btn btn-danger " style="margin: 0 auto;" onclick="window.location.replace('usuario.php');">Cancelar</button>
			  <br>
			  <br>
		</div>
 </form>
  </div>
</div>

</body>
</html>