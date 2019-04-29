<?php 

require_once '../control.php';
require_once 'model_mac.php';
require_once '../conexion.php';
//Logica
$maquinas = new type_machines();
$model = new machinesModel();
$db = database::conectar();

if(isset($_REQUEST['action']))
{
	switch ($_REQUEST['action']) {
	
		case 'actualizar':
			$maquinas->__SET('name_maq',   $_REQUEST['name_maq']);
			$maquinas->__SET('state_mac',	$_REQUEST['state_mac']);
			$maquinas->__SET('name_maq2',	$_REQUEST['name_maq2']);

			$model->Actualizar_maquinas($maquinas);
			print "<script>alert(\"Registro Actualizado Exitosamente.\");window.location='view_maquinas.php';</script>";
			break;
		
		case 'registrar':
			$maquinas->__SET('name_maq', 	$_REQUEST['name_maq']);
			$maquinas->__SET('state_mac',	$_REQUEST['state_mac']);

			$model->Registrar_maquinas($maquinas);
			print "<script>alert(\"Resgistro Agregado Exitosamente.\");window.location='view_maquinas.php';</script>";
			break;

		case 'eliminar':
			$model->Eliminar_maquinas($_REQUEST['name_maq']);
			print"<script>alert(\"Registro Eliminado Exitosamente.\");window.location='view_maquinas.php';</script>";
			break;

		case 'editar':
			$name_maq = $model->Obtener_maquinas($_REQUEST['name_maq']);
			$state_mac = $model->Obtener_maquinas($_REQUEST["name_maq"]);
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
	<title>CRUD maquinas</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../estilos/crudess.css">
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
     <span class="input-group-text" id="inputGroup-sizing-default">Maquina:</span>
    </div>
   <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" class="form-control" name="name_maq" placeholder="name_maq" required>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">Estado:</span>
    </div>
   <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" class="form-control" name="state_mac" placeholder="state_mac" required>
  </div>
  <br><input class="btn btn-primary" type="submit" value="Guardar" onclick="this.form.action = '?action=registrar';"/>
 </div>
</div>

	
</form>	
</div>
<?php } ?>
<div id="div_form">

<?php if(!empty($_GET['name_maq']) && (!empty($_GET['action']))){ ?>

<form action="#" method="post">



<div class="col-md-3">
 <div class="container-fluid">
 	<br><label>maquinas por Modificar</label>
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">Maquina:</span>
    </div>
   <br><input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="name_maq2" id="user_login" value="<?php echo $name_maq->__GET('name_maq'); ?>" required>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">estado:</span>
    </div>
   <br><input type="number" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="state_mac" id="user_login" value="<?php echo $state_mac->__GET('state_mac'); ?>" required>
  </div>
   <br><input class="btn btn-primary" type="submit" value="Actualizar" onclick="this.form.action = '?action=actualizar';" />
 </div>
</div>
<br><input type="text" name="name_maq" value="<?php echo $name_maq->__GET('name_maq'); ?>" style="display:none" placeholder="name_maq" required>
</form>
</div>

<?php } ?> 
<?php  
//FIN -> FORMULARIO ACTUALIZAR REGISTRO
$sql1= "SELECT * FROM machines_accessories";

$query = $db->query($sql1);

if($query->rowCount()>0):?> 
	<div class="container-fluid">
		<br><h1>CONSULTA - REGISTRO</h1><br>
	</div>
		<table id="customers">
		
<?php  

foreach ($model->Listar_maquinas() as $r):?>
		<br><br>
<div class="container">
	<ul class="list-group">

<nav aria-label="breadcrumb">
  <ol style="background-color:#BBBBBB " class="breadcrumb">
    <li style="color:black" class="breadcrumb-item active" aria-current="page">
    	 Maquina: <?php echo $r->__GET('name_maq');?><br> 
  		 Estado: <?php echo $r->__GET('state_mac');?><br>
  		<a class="btn btn-primary" href="?action=editar&name_maq=<?php echo $r->name_maq;?>">Editar</a> <a class="btn btn-primary" href="?action=eliminar&name_maq=<?php echo $r->name_maq;?>" onclick="return confirm('¿Esta seguro de eliminar este user?')">Eliminar</a> 
    </li>
  </ol>
</nav>
</ul>
</div>

<?php endforeach; ?>
</table>
<?php else: ?>
<div class="container-fluid">
	<h4 class="alert alert-danger">Señor user no se Encuentran registros</h4>
</div>
<?php endif; ?>
<div class="container-fluid">
	<a class="btn btn-primary" href="../fusion.php">volver</a>
</div>
</body>
</div>
</html>