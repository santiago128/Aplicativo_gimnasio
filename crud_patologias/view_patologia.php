<?php 

require_once '../control.php';
require_once 'model_patologia.php';
require_once '../conexion.php';
//Logica
$patologia = new type_disease();
$model = new diseaseModel();
$db = database::conectar();

if(isset($_REQUEST['action']))
{
	switch ($_REQUEST['action']) {
	
		case 'actualizar':
			$patologia->__SET('name_disease',   $_REQUEST['name_disease']);
			$patologia->__SET('state_disease',	$_REQUEST['state_disease']);
			$patologia->__SET('name_disease2',	$_REQUEST['name_disease2']);

			$model->Actualizar_patologia($patologia);
			print "<script>alert(\"Registro Actualizado Exitosamente.\");window.location='view_patologia.php';</script>";
			break;
		
		case 'registrar':
			$patologia->__SET('name_disease', 	$_REQUEST['name_disease']);
			$patologia->__SET('state_disease',	$_REQUEST['state_disease']);

			$model->Registrar_patologia($patologia);
			print "<script>alert(\"Resgistro Agregado Exitosamente.\");window.location='view_patologia.php';</script>";
			break;

		case 'eliminar':
			$model->Eliminar_patologia($_REQUEST['name_disease']);
			print"<script>alert(\"Registro Eliminado Exitosamente.\");window.location='view_patologia.php';</script>";
			break;

		case 'editar':
			$name_disease = $model->Obtener_patologia($_REQUEST['name_disease']);
			$state_disease = $model->Obtener_patologia($_REQUEST["name_disease"]);
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
	<title>CRUD patologia</title>
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
     <span class="input-group-text" id="inputGroup-sizing-default">Patologia:</span>
    </div>
   <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" class="form-control" name="name_disease" required>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">Estado:</span>
    </div>
   <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" class="form-control" name="state_disease" required>
  </div>
   <br><input class="btn btn-primary" type="submit" value="Guardar" onclick="this.form.action = '?action=registrar';"/>
 </div>
</div>   

  
</form> 
</div>
<?php } ?>
<div id="div_form">

<?php if(!empty($_GET['name_disease']) && (!empty($_GET['action']))){ ?>

<form action="#" method="post">

<div class="col-md-3">
 <div class="container-fluid">
  <br><label>Patologia por Modificar</label>
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">Patologia:</span>
    </div>
   <br><input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="name_disease2" id="user_login" value="<?php echo $name_disease->__GET('name_disease'); ?>" placeholder="name_disease" required>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">Estado:</span>
    </div>
   <br><input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="state_disease" id="user_login" value="<?php echo $name_disease->__GET('state_disease'); ?>" placeholder="state_disease" required>
  </div>
  <br><input class="btn btn-primary" type="submit" value="Actualizar" onclick="this.form.action = '?action=actualizar';" />
 </div>
</div>

<br><input type="text" name="name_disease" value="<?php echo $name_disease->__GET('name_disease'); ?>" style="display:none" placeholder="name_disease" required>
</form>
</div>

<?php } ?> 
<?php  
//FIN -> FORMULARIO ACTUALIZAR REGISTRO
$sql1= "SELECT * FROM type_document";

$query = $db->query($sql1);

if($query->rowCount()>0):?> 
  
  <div class="container-fluid">
    <br><h1>CONSULTA - REGISTRO</h1><br>
  </div>
    <table id="customers">  
<?php  

foreach ($model->Listar_patologia() as $r):?>
  <div class="container">
  <ul class="list-group">

<nav aria-label="breadcrumb">
  <ol style="background-color:#BBBBBB " class="breadcrumb">
    <li style="color:black " class="breadcrumb-item active" aria-current="page">
       Patologia: <?php echo $r->__GET('name_disease');?><br> 
       Estado: <?php echo $r->__GET('state_disease');?><br>
      <a class="btn btn-primary" href="?action=editar&name_disease=<?php echo $r->name_disease;?>">Editar</a> <a class="btn btn-primary" href="?action=eliminar&name_disease=<?php echo $r->name_disease;?>" onclick="return confirm('¿Esta seguro de eliminar este user?')">Eliminar</a> 
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










<!-- <div class="container">
  <ul class="list-group">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">
    	 Codigo: <?php echo $r->__GET('cod_history');?><br> 
  		 Fecha: <?php echo $r->__GET('date_history');?><br>
  		 identificacion: <?php echo $r->__GET('people_n_document');?><br> 
  		 Tipo de documento: <?php echo $r->__GET('people_type_document_people');?><br>
  		 Patologia: <?php echo $r->__GET('disease');?><br> 
  		<a class="btn btn-primary" href="?action=editar&cod_history=<?php echo $r->cod_history;?>">Editar</a> <a class="btn btn-primary" href="?action=eliminar&cod_history=<?php echo $r->cod_history;?>" onclick="return confirm('¿Esta seguro de eliminar este user?')">Eliminar</a> 
        </li>
      </ol>
    </nav>
  </ul>
</div> -->