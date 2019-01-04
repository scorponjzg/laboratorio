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
 	.table {
    
    margin-bottom: 10px;
}
 	label {
 		font-weight: 500;
 		margin-right: 20px;

 	}
 	span{
 		font-weight: 700;
 	}

 	body{
 		font-size: 10px;
 	}
 	hr { 
	  display: block;
	  margin-top: 0.5em;
	  margin-bottom: 0.5em;
	  margin-left: auto;
	  margin-right: auto;
	  border-style: inset;
	  border-width: 2px;
	} 
	.total{
		padding: 0px !important;
		text-align: center;
	}
	.totalEnLetra{
		text-align: left;
		padding: 0px !important;
	}
 </style>
<div class="container">

  <div  style="width:100%; margin-top: 10px;">
	<div class="row">
	  <div class="col-xs-7">
	  	<div class="input-group" style="width:40%;margin-bottom: 25px;">
		    <span class="input-group-addon">ORDEN:</span>
		    <span id="orden" type="text" class="form-control folio" name="orden"> </span>
	    </div>
	    <label>Paciente:&nbsp;<span class="paciente"></span></label>
	    <br>
	    <label>Médico: A QUIEN CORRESPONDA</label>
	    <br>
	    <label>Empresa: PÚBLICO GENERAL</label>
		<br>
		<label>Edad:&nbsp;<span class="edad"></span></label>
		<label>Sexo:&nbsp;<span class="sexo"></span></label>
		<label>Tel.&nbsp;<span class="tel"></span></label>
		<br>
		<label>F.Ingreso:&nbsp;<span class="fIngreso"></span></label>
		<label>H.Ingreso:&nbsp;<span class="hIngreso"></span></label>
		<label>F.Impresión:&nbsp;<span class="fImpresion"></span></label>


	  </div>
	  <div class="col-xs-5">
	  	   <div style="width: 80%">
		  	<img class="img-responsive" src="img/ViviLab.jpg" alt="vivilab">
		 </div> 
		  <span class="direccion"></span>
		  <br>
		  <label>Tels.&nbsp;<span class="tels"></span></label><span class="web"></span>
		  <br>
		  <label>e-mail:&nbsp;<span class="correo"></span></label>
	  </div>
  
	</div><table class="table table-bordered">
			 		<thead>
			 			<tr>
			 				<th class="info" style="width:15%"></th>
			 				<th class="info" style="width:60%; text-align: center; padding: 0px;">Estudios</th>
			 				<th class="info" style="width:10%"></th>
			 			</tr>
			 		</thead>
			 		<tbody class="estudioSeleccionado">
			 			
			 		</tbody>
			 	</table>
			 	<table class="table table-bordered">
			 		<thead>
			 			<tr>
			 				<th class="info" style="width: 80%;padding: 0px;">Importe en letra</th>
			 				<th class="info" style="width: 20%;text-align: center;padding: 0px;">total</th>
			 				
			 			</tr>
			 		</thead>
			 		<tbody>
			 			<tr>
			 				<td class="totalEnLetra">CERO 00/100 M.N.</td>
			 				<td class="total">0.00</td>
			 				
			 			</tr>
			 		</tbody>
			 	</table>
			 	<div>
				 	<div class="input-group" style="width:60%; margin:0 auto 20px;">
					    <span class="input-group-addon">Atendió:</span>
					    <span type="text" class="form-control atendio " style="text-align: center;"> </span>
				    </div>
			    </div>
	
</div>
<hr>
<div  style="width:100%; margin-top: 10px;">
	<div class="row">
	  <div class="col-xs-7">
	  	<div class="input-group" style="width:40%;margin-bottom: 25px;">
		    <span class="input-group-addon">ORDEN:</span>
		    <span id="orden" type="text" class="form-control folio" name="orden"> </span>
	    </div>
	    <label>Paciente:&nbsp;<span class="paciente"></span></label>
	    <br>
	    <label>Médico: A QUIEN CORRESPONDA</label>
	    <br>
	    <label>Empresa: PÚBLICO GENERAL</label>
		<br>
		<label>Edad:&nbsp;<span class="edad"></span></label>
		<label>Sexo:&nbsp;<span class="sexo"></span></label>
		<label>Tel.&nbsp;<span class="tel"></span></label>
		<br>
		<label>F.Ingreso:&nbsp;<span class="fIngreso"></span></label>
		<label>H.Ingreso:&nbsp;<span class="hIngreso"></span></label>
		<label>F.Impresión:&nbsp;<span class="fImpresion"></span></label>


	  </div>
	  <div class="col-xs-5">
	  	   <div style="width: 80%">
		  	<img class="img-responsive" src="img/ViviLab.jpg" alt="vivilab">
		 </div> 
		  <span class="direccion"></span>
		  <br>
		  <label>Tels.&nbsp;<span class="tels"></span></label><span class="web"></span>
		  <br>
		  <label>e-mail:&nbsp;<span class="correo"></span></label>
	  </div>
  
	</div><table class="table table-bordered">
			 		<thead>
			 			<tr>
			 				<th class="info" style="width:15%"></th>
			 				<th class="info" style="width:60%; text-align: center; padding: 0px;">Estudios</th>
			 				<th class="info" style="width:10%"></th>
			 			</tr>
			 		</thead>
			 		<tbody class="estudioSeleccionado">
			 			
			 		</tbody>
			 	</table>
			 	<table class="table table-bordered">
			 		<thead>
			 			<tr>
			 				<th class="info" style="width: 80%;padding: 0px;">Importe en letra</th>
			 				<th class="info" style="width: 20%;text-align: center;padding: 0px;">total</th>
			 				
			 			</tr>
			 		</thead>
			 		<tbody>
			 			<tr>
			 				<td class="totalEnLetra">CERO 00/100 M.N.</td>
			 				<td class="total">0</td>
			 				
			 			</tr>
			 		</tbody>
			 	</table>
			 	<div>
				 	<div class="input-group" style="width:60%; margin:0 auto;">
					    <span class="input-group-addon">Atendió:</span>
					    <span type="text" class="form-control atendio " style="text-align: center;"> </span>
				    </div>
			    </div>
	
</div>
 
</div>

</body>
</html>