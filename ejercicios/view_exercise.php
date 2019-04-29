<?php 

require_once '../control.php';
require_once 'model_exercise.php';
require_once '../conexion.php';
//Logica
$ejercicio = new type_exercise();
$model = new exerciseModel();
$db = database::conectar();

if(isset($_REQUEST['action']))
{
	switch ($_REQUEST['action']) {
	
		case 'actualizar':
			$ejercicio->__SET('name_ejr',   $_REQUEST['name_ejr']);
			$ejercicio->__SET('state_ejr',	 $_REQUEST['state_ejr']);
			$ejercicio->__SET('machines_maqac',	 $_REQUEST['machines_maqac']);
			$ejercicio->__SET('name_ejr2',	 $_REQUEST['name_ejr2']);

			$model->Actualizar_ejercicio($ejercicio);
			print "<script>alert(\"Registro Actualizado Exitosamente.\");window.location='view_exercise.php';</script>";
			break;
		
		case 'registrar':
			$ejercicio->__SET('name_ejr',   $_REQUEST['name_ejr']);
			$ejercicio->__SET('state_ejr',	 $_REQUEST['state_ejr']);
			$ejercicio->__SET('machines_maqac',	 $_REQUEST['machines_maqac']);

			$model->Registrar_ejercicio($ejercicio);
			// print "<script>alert(\"Resgistro Agregado Exitosamente.\");window.location='view_exercise.php';</script>";
			break;

		case 'eliminar':
			$model->Eliminar_ejercicio($_REQUEST['name_ejr']);
			print"<script>alert(\"Registro Eliminado Exitosamente.\");window.location='view_exercise.php';</script>";
			break;

		case 'editar':
			$name_ejr = $model->Obtener_ejercicio($_REQUEST['name_ejr']);
			$state_ejr = $model->Obtener_ejercicio($_REQUEST["name_ejr"]);
			$machines_maqac = $model->Obtener_ejercicio($_REQUEST["name_ejr"]);
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
	<title>CRUD ejercicio</title>
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
     <span class="input-group-text" id="inputGroup-sizing-default">nombre ejercicio:</span>
    </div>
   <input type="text" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" class="form-control" name="name_ejr" required>
  </div>
 </div>
</div> 

<form action="#" method="post">
<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">estado del ejercicio:</span>
    </div>
   <input type="text" name="state_ejr" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default"  required>
  </div>
 </div>
</div> 

<form action="#" method="post">
<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">maquina:</span>
    </div>
   <select name="machines_maqac">
      <?php  
         foreach ($db->query('SELECT * FROM machines_accessories WHERE name_maq=name_maq') as $row) {
          echo '<option>'.$row['name_maq'].'</option>';
         }
      ?>
    </select>
  </div>
  <br><input class="btn btn-primary" type="submit" value="Guardar" onclick="this.form.action = '?action=registrar';"/>
 </div>
</div> 
    
</form> 
</div>
<?php } ?>
<div id="div_form">

<?php if(!empty($_GET['name_ejr']) && (!empty($_GET['action']))){ ?>

<form action="#" method="post">

<br><label>ejercicio por Modificar</label>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">Nombre ejercicio:</span>
    </div>
   <br><input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="name_ejr2" id="user_login" value="<?php echo $name_ejr->__GET('name_ejr'); ?>" required>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">Estado:</span>
    </div>
   <br><input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="state_ejr" id="user_login" value="<?php echo $name_ejr->__GET('state_ejr'); ?>" required>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">Maquinas:</span>
    </div>
   <br><input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="machines_maqac" id="user_login" value="<?php echo $name_ejr->__GET('machines_maqac'); ?>" required>
  </div>
  <br><input class="btn btn-primary" type="submit" value="Actualizar" onclick="this.form.action = '?action=actualizar';" />
 </div>
</div>
<br><input type="text" name="name_ejr" value="<?php echo $name_ejr->__GET('name_ejr'); ?>" style="display:none" required>
</form>
</div>

<?php } ?> 
<?php
$sql1= "SELECT * FROM exercise";

$query = $db->query($sql1);
if($query->rowCount()>0):?> 

  <div class="container-fluid">
    <br><h1 style="color:#fff">CONSULTA - REGISTRO</h1><br>
  </div>
    <table id="customers">  
<?php  
foreach ($model->Listar_ejercicio() as $r):?>

  <div class="container">
   <ul class="list-group">
    <nav aria-label="breadcrumb">
     <ol style="background-color:#BBBBBB" class="breadcrumb">
      <li style="color:black" class="breadcrumb-item active" aria-current="page">
        Nombre del ejercicio: <?php echo $r->__GET('name_ejr');?><br> 
        Estado del ejercicio: <?php echo $r->__GET('state_ejr');?><br> 
        Maquina: <?php echo $r->__GET('machines_maqac');?><br> 
    
        <a class="btn btn-primary" href="?action=editar&name_ejr=<?php echo $r->name_ejr;?>">Editar</a> <a class="btn btn-primary" href="?action=eliminar&name_ejr=<?php echo $r->name_ejr;?>" onclick="return confirm('¿Esta seguro de eliminar este user?')">Eliminar</a> 
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