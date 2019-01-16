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
  <title>ViviLab</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="css/bootstrap-select.css">
  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/bootstrap-select.js" type="text/javascript"></script>
  <script src="js/numerosALetras.js"></script>
  <script src="js/visor_general_laboratorio.js"></script>
</head>
<body>

<style>
th {
	
	text-align:center;
}
.selectores{
	width:45%;
	margin: 20px auto;
}
button{
	width:45%;
}
</style>
<div class="container centrado" style="padding-left: 0px;">
	<?php include 'navMenu.php'?>
	
	<div class="starter-template" style="text-align:center">
		<br>
		

		<div class="tab-content">
			<div id="resultados" class="tab-pane fade in active">
				<div class="centrado">
					
					<div class="panel panel-default" style="width: 60%; margin:6% auto 0 auto; ">
						
						<div class="panel panel-body" style="margin-bottom: 0px;">
						
							<div style="text-align: center; margin-top: 12px" id="boton_nuevo">
								
								<button id="nuevo" type="button" class="btn btn-success" data-accion="1" style="width:45%;text-align:center; color: white; background:rgb(32,190,198);" onclick="window.location.href='nueva_orden.php'"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nueva orden</button>
								<br>
								<?php if($_SESSION['tipo'] == 1){ ?>
									<div class="selectores">
									 	
									 	<select class="form-control" id="fecha" name="fecha">
									        <option value="0">seleccione una fecha</option>
									    </select>
									 </div>
									 <div class="selectores">
									 	
									 	<select class="form-control" id="sucursal" name="sucursal">
									        <option Value="0">Seleccione la sucursal asignada</option>
									    </select>
									 </div>
								<?php } ?>
								<div class="selectores">
									<?php if($_SESSION['tipo'] == 1){ ?>
								  		 <button type="commit" onclick="encotrarOrden()" class="btn btn-info " style="margin-right:25px;" >Buscar</button>
									<?php }?>
									<button class="btn btn-info " onclick="crearCSV('ordenes','ordene')">Exportar a CSV</button>
								</div>
							</div>
						</div>
						
					</div>
					
					<div class="tab-content">
						
						<div class="table-responsive">
							<table class="table table-bordered"style="margin-top: 20px;" id="ordenes" name="ordenes">
								<thead >
								  <tr class="info">
									<th style="width:15%;">Folio</th>
									<th style="width:10%;">Num.Estudios</th>
									<th style="width:15%;">Atendi&oacute;</th>
									<th style="width:8%;">Registro</th>
									<th style="width:8%;">Total</th>
									<?php if($_SESSION['tipo'] == 1){ ?>
										<th style="width:8%;">Costo</th>
										<th style="width:8%;">Utilidad</th>
									<?php } ?>
									<th style="width:8%;">Estado</th>
									<?php if($_SESSION['tipo'] == 1){ ?>
										<th style="width:8%;">Cancelar</th>
									<?php } ?>
								  </tr>
								</thead>
								<tbody id="orden">
								  
								</tbody>
							</table>
						
							<br>
							<table class="table table-bordered">
						 		<thead>
						 			<tr>
						 				<th class="info" style="width: 80%;">Importe en letra</th>
						 				<th class="info" style="width: 20%;text-align: center">Total</th>
						 				<?php if($_SESSION['tipo'] == 1){ ?>
							 				<th class="info" style="width: 20%;text-align: center">Costo</th>
							 				<th class="info" style="width: 20%;text-align: center">Utilidad</th>
						 			    <?php }?>
						 				
						 			</tr>
						 		</thead>
						 		<tbody>
						 			<tr>
						 				<td style="text-align: left;" id="totalEnLetra">CERO 00/100 M.N.</td>
						 				<td id="total">0</td>
						 				<?php if($_SESSION['tipo'] == 1){ ?>
							 				<td id="costo">0</td>
							 				<td id="utilidad">0</td>
						 			    <?php }?>
						 			</tr>
						 		</tbody>
						 	</table>
						</div>
				</div>
			</div>
		</div>
				 
	</div>
</div>

	</div><!-- /.container -->

    </body>
</html>