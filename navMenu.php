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
        <li class="active"><a href="visor_general_laboratorio.php">Home</a></li>
        <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Sistema
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="estudio.php">Estudios</a></li>
          <li><a href="perfil.php">Perfil</a></li>
		  <li><a href="asignar_permiso.php">Permoso -> Perfil</a></li>
		  <li><a href="asignar_perfil.php">Perfil -> Usuario</a></li>
        </ul>
      </li>
	  
        <li ><a href="#">Usuario</a></li> 
        <li><a href="#">Page 3</a></li> 
		
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>