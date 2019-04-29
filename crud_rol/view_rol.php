<?php 

require_once '../control.php';
require_once 'model_rol.php';
require_once '../conexion.php';
//Logica
$documento = new type_role();
$model = new rolModel();
$db = database::conectar();

if(isset($_REQUEST['action']))
{
	switch ($_REQUEST['action']) {
	
		case 'actualizar':
			$documento->__SET('name_rol',   $_REQUEST['name_rol']);
			$documento->__SET('state_rol',	$_REQUEST['state_rol']);
			$documento->__SET('name_rol2',	$_REQUEST['name_rol2']);

			$model->Actualizar_rol($documento);
			// print "<script>alert(\"Registro Actualizado Exitosamente.\");window.location='view_rol.php';</script>";
			break;
		
		case 'registrar':
			$documento->__SET('name_rol', 	$_REQUEST['name_rol']);
			$documento->__SET('state_rol',	$_REQUEST['state_rol']);

			$model->Registrar_rol($documento);
			print "<script>alert(\"Resgistro Agregado Exitosamente.\");window.location='view_rol.php';</script>";
			break;

		case 'eliminar':
			$model->Eliminar_rol($_REQUEST['name_rol']);
			print"<script>alert(\"Registro Eliminado Exitosamente.\");window.location='view_rol.php';</script>";
			break;

		case 'editar':
			$name_rol = $model->Obtener_rol($_REQUEST['name_rol']);
			$state_rol = $model->Obtener_rol($_REQUEST["name_rol"]);
			break;	
	}
}
?>
<?php 
$adm=$_SESSION["admin"];
if ($adm!='1') {
	header("location: index.html");
}

 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>CRUD documento</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<div class="container">
	<body>

<div class="container-fluid">
<br><a class="btn btn-primary" href="?action=ver&m=1">NUEVO REGISTRO</a>
</div>

<div id="div_form">
<?php if((!empty($_GET['m'])) && (!empty($_GET['action']))){ ?>

<form action="#" method="post">
	<br>	
	 <div class="col-md-3">
	<div class="container-fluid">
	<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">ROL:</span>
  </div>
 <input type="text" aria-label="Default" aria-describedby="inputGroup-sizing-default" class="form-control" name="name_rol" required>
</div>
   </div>
</div> 
	 <div class="col-md-3">
	<div class="container-fluid">
	<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">ESTADO:</span>
  </div>
 <input type="text" aria-label="Default" aria-describedby="inputGroup-sizing-default" class="form-control" name="state_rol" required>
</div>
<input class="btn btn-primary" type="submit" value="Guardar" onclick="this.form.action = '?action=registrar';"/>
   </div>
</div>   

</form>	
</div>
<?php } ?>
<div id="div_form">

<?php if(!empty($_GET['name_rol']) && (!empty($_GET['action']))){ ?>

<form action="#" method="post">

<!-- LABLE ADMINISTRADOR -->

<div class="col-md-3">
	<div class="container-fluid">
		<br><label>documento por Modificar</label>
	<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">ROL:</span>
  </div>
  <br><input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="name_rol2" id="user_login" value="<?php echo $name_rol->__GET('name_rol'); ?>" required>
</div>
   </div>
</div> 
<div class="col-md-3">
	<div class="container-fluid">
	<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">DESC:</span>
  </div>
  <br><input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="state_rol" id="user_login" value="<?php echo $name_rol->__GET('state_rol'); ?>" required>
</div>
  <input class="btn btn-primary" type="submit" value="Actualizar" onclick="this.form.action = '?action=actualizar';" />
   </div>
</div> 
<input type="text" name="name_rol" value="<?php echo $name_rol->__GET('name_rol'); ?>" style="display:none" required>
</form>
</div>

<?php } ?> 
<?php  
//FIN -> FORMULARIO ACTUALIZAR REGISTRO
$sql1= "SELECT * FROM role";

$query = $db->query($sql1);

if($query->rowCount()>0):?> 
	
	<div class="container-fluid">
		<br><h1>CONSULTA - REGISTRO</h1><br>
		<table id="customers">
	</div>
		
<?php  

foreach ($model->Listar_rol() as $r):?>
<div class="container">
	<ul class="list-group">

<nav aria-label="breadcrumb">
  <ol style="background-color:#BBBBBB " class="breadcrumb">
    <li style="color:black " class="breadcrumb-item active" aria-current="page">
    	 Nombre del rol: <?php echo $r->__GET('name_rol');?><br> 
  		 Estado: <?php echo $r->__GET('state_rol');?><br>
  		<a class="btn btn-primary" href="?action=editar&name_rol=<?php echo $r->name_rol;?>">Editar</a> <a class="btn btn-primary" href="?action=eliminar&name_rol=<?php echo $r->name_rol;?>" onclick="return confirm('¿Esta seguro de eliminar este user?')">Eliminar</a> 
    </li>
  </ol>
</nav>
</ul>
</div>

<?php endforeach; ?>
</table>
<?php else: ?>
<div class="container-fluid">
	<br><h4 class="alert alert-danger">Señor user no se Encuentran registros</h4>
</div>
<?php endif; ?>

<div class="container-fluid ">
  <a class="btn btn-primary" href="../fusion.php">Volver</a>
</div>

<script src="../js/jquery.js"></script>
<script src="../css/bootstrap.min.css"></script>
</body>
</div>
</html>