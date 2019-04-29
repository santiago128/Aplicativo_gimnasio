<?php 

require_once '../control.php';
require_once 'model_document.php';
require_once '../conexion.php';
//Logica
$documento = new type_document();
$model = new documentModel();
$db = database::conectar();

if(isset($_REQUEST['action']))
{
	switch ($_REQUEST['action']) {
	
		case 'actualizar':
			$documento->__SET('code_document',   $_REQUEST['code_document']);
			$documento->__SET('desc_document',	$_REQUEST['desc_document']);
			$documento->__SET('code_document2',	$_REQUEST['code_document2']);

			$model->Actualizar_documento($documento);
			print "<script>alert(\"Registro Actualizado Exitosamente.\");window.location='view_document.php';</script>";
			break;
		
		case 'registrar':
			$documento->__SET('code_document', 	$_REQUEST['code_document']);
			$documento->__SET('desc_document',	$_REQUEST['desc_document']);

			$model->Registrar_documento($documento);
			print "<script>alert(\"Resgistro Agregado Exitosamente.\");window.location='view_document.php';</script>";
			break;

		case 'eliminar':
			$model->Eliminar_documento($_REQUEST['code_document']);
			print"<script>alert(\"Registro Eliminado Exitosamente.\");window.location='view_document.php';</script>";
			break;

		case 'editar':
			$code_document = $model->Obtener_documento($_REQUEST['code_document']);
			$desc_document = $model->Obtener_documento($_REQUEST["code_document"]);
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
    <br><a class="btn btn-primary" href="?action=ver&m=1">NUEVO REGISTRO</a><br>	
   </div>



<div id="div_form">
<?php if((!empty($_GET['m'])) && (!empty($_GET['action']))){ ?>

<form action="#" method="post">
	<br>	
<div class="col-md-3">
  <div class="container-fluid">
	<div class="input-group mb-3">
      <div class="input-group-prepend">
         <span class="input-group-text" id="inputGroup-sizing-default">Tipo doc:</span>
      </div>
    <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" class="form-control" name="code_document" required>
   </div>
 </div>
</div> 
 


<div class="col-md-3">
  <div class="container-fluid">
	<div class="input-group mb-3">
<div class="input-group-prepend">
  <span class="input-group-text" id="inputGroup-sizing-default">Descripcion:</span>
    </div>
      <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" class="form-control" name="desc_document" required>
    </div>
    <input type="submit" class="btn btn-primary" value="Guardar" onclick="this.form.action = '?action=registrar';"/>
  </div>
</div>
</form>	
   </div>
</div> 

	
</div>
<?php } ?>
<div id="div_form">

<?php if(!empty($_GET['code_document']) && (!empty($_GET['action']))){ ?>

<form action="#" method="post">

<div class="col-md-3">
	<div class="container-fluid">
<br><label>documento por Modificar</label>

	<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">Tipo doc:</span>
  </div>
   <br><input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="code_document2" id="user_login" value="<?php echo $code_document->__GET('code_document'); ?>" placeholder="code_document" required>
</div>
   </div>
</div> 


<div class="col-md-3">
	<div class="container-fluid">
	<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">Desc doc:</span>
  </div>
  <br><input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="desc_document" id="user_login" value="<?php echo $code_document->__GET('desc_document'); ?>" placeholder="desc_document" required>
</div>
<br><input class="btn btn-primary" type="submit" value="Actualizar" onclick="this.form.action = '?action=actualizar';" />
   </div>
</div> 

    <br><input type="text" name="code_document" value="<?php echo $code_document->__GET('code_document'); ?>" style="display:none" placeholder="code_document" required>
	
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
		<table id="customers">

	</div>
		
<?php  

foreach ($model->Listar_documento() as $r):?>
<div class="container">
	<ul class="list-group">
<nav aria-label="breadcrumb">
  <ol style="background-color:#BBBBBB" class="breadcrumb">
    <li style="color:black" class="breadcrumb-item active" aria-current="page">
    	 Tipo de documento: <?php echo $r->__GET('code_document');?><br> 
  		 Descripcion del documento: <?php echo $r->__GET('desc_document');?><br>
  		<a class="btn btn-primary" href="?action=editar&code_document=<?php echo $r->code_document;?>">Editar</a> <a class="btn btn-primary" href="?action=eliminar&code_document=<?php echo $r->code_document;?>" onclick="return confirm('¿Esta seguro de eliminar este user?')">Eliminar</a> 
    </li>
  </ol>
</nav>
</ul>
</div>
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