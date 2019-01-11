<?php
if (!isset($_SESSION))
    session_start();
if (!isset($_SESSION["tipo"]) && !isset($_SESSION["usuario"])) {
    header("Location: index.php"); /* Redirect browser */
    exit();
}
?>

<nav class="navbar navbar-default navbar-fixed-top" ;>
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <img src="img/ViviLabT.png" class="navbar-brand" alt="Vivilab" style="padding: 4px;">
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="visor_general_laboratorio.php">Inicio</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Sistema
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="sucursal.php">Sucursales</a></li>
            <li><a href="estudio.php">Estudios</a></li>
            
          </ul>
        </li>
	       <?php if($_SESSION['tipo'] == 1) { ?>
        <li ><a href="usuario.php">Usuario</a></li> 
        <?php  }; ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><label class="navbar-text"><span class="glyphicon glyphicon-home"></span>&nbsp;<?php echo $_SESSION['unidad']?></span></label></li>
        <li><label class="navbar-text"><span class="glyphicon glyphicon-user"></span>&nbsp;<?php echo $_SESSION['nombre']?></span></label></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
       
      </ul>
    </div>
  </div>
</nav>