<?php 
header("Content-Type: text/html;charset=utf-8");
session_start();  //arrancan todas las variable
$adm=$_SESSION['admin'];
if ($adm!="1") {
  header("location: login/login.php");
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<div class="container">
			<title>RYN gimnasio</title>
	<link rel="stylesheet" type="text/css" href="estilos/styles.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, user-scalable=no,initial-scale=1.0, maximum-scale=1.0,minimum-scale=1.0">	
	</div>
	
</head>
	<body>
		<div class="cabeza">
			<header>MENU</header>
		</div>
		<div class="men">
			<div class="container">
  <div class="row">
    <div class="col-sm">
      	<a class="botm" style="" href="crud_maquinas/view_maquinas.php">Maquinas</a>
		<a class="botm" style=" " href="crud_patologias/view_patologia.php">Patologias</a>
		<a class="botm" style=" " href="crud_people/view_people.php">Usuarios</a>
    </div>
    <br>
    <div class="col-sm">
      	<a class="botm" style=" " href="crud_rol/view_rol.php">Roles</a>
		
		<a class="botm" style=" " href="historia_clinica/view_historia.php">Historia clinica</a>
		<a class="botm" style=" " href="crud_tdoc/view_document.php">Tipo de documento</a>
    </div>
    <br>
    <div class="col-sm">
      	<a class="botm" style=" " href="ejercicios/view_exercise.php">Ejercicios</a>
		<a class="botm" style=" " href="crud_rutina/view_rutina.php">Rutinas</a>
		<a class="botm" style=" " href="medidas/view_medida.php">Medidas</a>
    </div>
  </div>
  
  	<a style="text-align: center" class="botm" style="" href="login/salir.php">Salir</a>
  
</div>
	</div>
<script src="js/jquery.js"></script>
<script src="css/bootstrap.min.css"></script>
</body>
</html>