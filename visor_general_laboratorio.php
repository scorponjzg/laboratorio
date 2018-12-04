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
  <script src="js/visor_general.js"></script>
</head>
<body>

<style>
th {
	
	text-align:center;
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
								
								<button id="nuevo" type="button" class="btn btn-success" data-accion="1" style="width:45%;text-align:center; color: white; background:rgb(32,190,198);"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nueva orden</button>
								<br>
								<br>
								<button onclick="crearCSV('reclutados','reclutados')">Exportar a CSV</button>
							</div>
						</div>
					
				</div>
				
				<div class="tab-content">
					
						<!--div class="table-responsive">
							<table class="table table-bordered"style="margin-top: 20px;" id="reclutados" name="reclutados">
								<thead >
								  <tr class="info">
									<th style="width:12%;">Foto</th>
									<th style="width:13%;">Nombre</th>
									<th style="width:12%;">Tel&eacute;fono / Celular</th>
									<th style="width:10%;">Medio de contacto</th>
									<th style="width:4%;">Edad</th>
									<th style="width:10%;">Servicio de interes</th>
									<th style="width:10%;">Estatus</th>
									<th style="width:13%;">Reclutador</th>
									<th style="width:10%;">Fecha</th>
									<th style="width:6%;">Editar</th>
								  </tr>
								</thead>
								<tbody id="reporte">
								  
								</tbody>
							</table-->
						
							<br>
					</div>
				</div>
			</div>
		</div>
			 
	</div>
</div>

	</div><!-- /.container -->

    </body>
</html>