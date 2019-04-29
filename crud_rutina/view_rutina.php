<?php 

require_once '../control.php';
require_once 'model_rutina.php';
require_once '../conexion.php';
//Logica
$rutina = new type_rutina();
$model = new routineModel();
$db = database::conectar();

if(isset($_REQUEST['action']))
{
	switch ($_REQUEST['action']) {
	
		case 'actualizar':
			$rutina->__SET('cod_routine',   $_REQUEST['cod_routine']);
			$rutina->__SET('desc_routine',	$_REQUEST['desc_routine']);
			$rutina->__SET('cod_routine2',	$_REQUEST['cod_routine2']);

			$model->Actualizar_rutina($rutina);
			print "<script>alert(\"Registro Actualizado Exitosamente.\");window.location='view_rutina.php';</script>";
			break;
		
		case 'registrar':
			$rutina->__SET('cod_routine', 	$_REQUEST['cod_routine']);
			$rutina->__SET('desc_routine',	$_REQUEST['desc_routine']);

			$model->Registrar_rutina($rutina);
			print "<script>alert(\"Resgistro Agregado Exitosamente.\");window.location='view_rutina.php';</script>";
			break;

		case 'eliminar':
			$model->Eliminar_rutina($_REQUEST['cod_routine']);
			print"<script>alert(\"Registro Eliminado Exitosamente.\");window.location='view_rutina.php';</script>";
			break;

		case 'editar':
			$cod_routine = $model->Obtener_rutina($_REQUEST['cod_routine']);
			$desc_routine = $model->Obtener_rutina($_REQUEST["cod_routine"]);
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
	<title>CRUD rutina</title>
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
     <span class="input-group-text" id="inputGroup-sizing-default">cod_routine:</span>
    </div>
   <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="cod_routine" required>
  </div>
 </div>
</div> 

<form action="#" method="post">
<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">desc_routine:</span>
    </div>
   <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="desc_routine"  required>
  </div>
 </div>
</div> 

<div class="container-fluid">
  <br><div class="input-group mb-3">
    <div class="input-group-prepend">
        <div class="input-group-text"> 
  <?php
  foreach ($db->query("SELECT * FROM exercise WHERE state_ejr = 1") as $row):?>&nbsp;&nbsp;<br>
    <input type="checkbox" name="<?php echo $row['name_ejr'];?>">
    <?php echo $row['name_ejr'];?>&nbsp;&nbsp;
    <input class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" type="text" name="des<?php echo $row['name_ejr']; ?>"><br><br>
    <?php endforeach;?>
      </div>
  </div>
</div>
    
</div>
<div class="col-md-3">
  <div class="container-fluid">
  <br><input class="btn btn-primary" type="submit" value="Guardar" onclick="this.form.action = '?action=registrar';"/>
  </div>
</div> 

</form> 
</div>
<?php } ?>
<div id="div_form">

<?php if(!empty($_GET['cod_routine']) && (!empty($_GET['action']))){ ?>

<form action="#" method="post">
<br>
<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">codigo rutina:</span>
    </div>
   <br><input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default"" name="cod_routine2" id="user_login" value="<?php echo $cod_routine->__GET('cod_routine'); ?>" required>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">Descripcion rutina:</span>
    </div>
   <br><input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="desc_routine" id="user_login" value="<?php echo $cod_routine->__GET('desc_routine'); ?>" required>
  </div>
 </div>
</div>

<br><div class="input-group mb-3">
    <div class="input-group-prepend">
        <div class="input-group-text"> 
  <?php
  foreach ($db->query("SELECT * FROM exercise WHERE state_ejr = 1") as $row):?>&nbsp;&nbsp;<br>
    <input type="checkbox" name="<?php echo $row['name_ejr'];?>">
    <?php echo $row['name_ejr'];?>&nbsp;&nbsp;
    <input type="text" name="des<?php echo $row['name_ejr']; ?>"><br><br>
    <?php endforeach;?>
        </div>
    </div>
  </div>

<div class="col-md-3">
 <div class="container-fluid">
  <br><input class="btn btn-primary" type="submit" value="Actualizar" onclick="this.form.action = '?action=actualizar';" />
 </div>
</div>

<br><input type="text" name="cod_routine" value="<?php echo $cod_routine->__GET('cod_routine'); ?>" style="display:none" required>
</form>
</div>

<?php } ?> 
<?php  
//FIN -> FORMULARIO ACTUALIZAR REGISTRO
$sql1= "SELECT * FROM routine_exercise";

$query = $db->query($sql1);

if($query->rowCount()>0):?> 
  
  <div class="container-fluid">
    <br><h1>CONSULTA - REGISTRO</h1><br>
  </div>
    <table id="customers">
    
<?php  

foreach ($model->Listar_rutina() as $r):?>
<div class="container">
  <ul class="list-group">
    <nav aria-label="breadcrumb">
      <ol style="background-color:#BBBBBB" class="breadcrumb">
        <li style="color:black" class="breadcrumb-item active" aria-current="page">
      Codigo rutina: <?php echo $r->__GET('cod_routine');?><br> 
      Descripcion rutina: <?php echo $r->__GET('desc_routine');?><br> 
      Repeticiones-Tiempo: <?php echo $r->__GET('rep_time');?><br> 
      
      <a class="btn btn-primary" href="?action=editar&cod_routine=<?php echo $r->cod_routine;?>">Editar</a> <a class="btn btn-primary" href="?action=eliminar&cod_routine=<?php echo $r->cod_routine;?>" onclick="return confirm('¿Esta seguro de eliminar este user?')">Eliminar</a> 
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
  <a class="btn btn-primary" href="../fusion.php">Volver</a>
</div>
</body>
</div>
</html>