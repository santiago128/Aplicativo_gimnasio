<?php 

require_once '../control.php';
require_once 'model_medida.php';
require_once '../conexion.php';

$medida = new type_measurement();
$model = new modelmeasurement();
$db = database::conectar();

if(isset($_REQUEST['action']))
{
	switch ($_REQUEST['action']) {
	
		case 'actualizar':
			$medida->__SET('cod_measurement',     		$_REQUEST['cod_measurement']);
			$medida->__SET('back',						$_REQUEST['back']);
			$medida->__SET('chest',						$_REQUEST['chest']);
			$medida->__SET('abdomen',					$_REQUEST['abdomen']);
			$medida->__SET('leg',						$_REQUEST['leg']);
			$medida->__SET('calf_muscle',    			$_REQUEST['calf_muscle']);
			$medida->__SET('arm',						$_REQUEST['arm']);
			$medida->__SET('forearm',					$_REQUEST['forearm']);
			$medida->__SET('weight',     				$_REQUEST['weight']);
			$medida->__SET('cod_measurement2',     		$_REQUEST['cod_measurement2']);
			
			$model->Actualizar_medidas($medida);
		    print "<script>alert(\"Registro Actualizado Exitosamente.\");window.location='view_medida.php';</script>";
			break;
		
		case 'registrar':
			$medida->__SET('cod_measurement',     		$_REQUEST['cod_measurement']);
			$medida->__SET('back',						$_REQUEST['back']);
			$medida->__SET('chest',						$_REQUEST['chest']);
			$medida->__SET('abdomen',					$_REQUEST['abdomen']);
			$medida->__SET('leg',						$_REQUEST['leg']);
			$medida->__SET('calf_muscle',    			$_REQUEST['calf_muscle']);
			$medida->__SET('arm',						$_REQUEST['arm']);
			$medida->__SET('forearm',					$_REQUEST['forearm']);
			$medida->__SET('weight',     				$_REQUEST['weight']);

			$model->Registrar_medidas($medida);
			// print "<script>alert(\"Resgistro Agregado Exitosamente.\");window.location='view_medida.php';</script>";
			break;

		case 'eliminar':
			$model->Eliminar_medidas($_REQUEST['cod_measurement']);
			print"<script>alert(\"Registro Eliminado Exitosamente.\");window.location='view_medida.php';</script>";
			break;

		case 'editar':
			$cod_measurement = $model->Obtener_medidas($_REQUEST['cod_measurement']);
			$back = $model->Obtener_medidas($_REQUEST['cod_measurement']);
			$chest = $model->Obtener_medidas($_REQUEST['cod_measurement']);
			$abdomen = $model->Obtener_medidas($_REQUEST['cod_measurement']);
			$leg = $model->Obtener_medidas($_REQUEST['cod_measurement']);
			$calf_muscle = $model->Obtener_medidas($_REQUEST['cod_measurement']);
			$arm = $model->Obtener_medidas($_REQUEST['cod_measurement']);
			$forearm = $model->Obtener_medidas($_REQUEST['cod_measurement']);
			$weight = $model->Obtener_medidas($_REQUEST['cod_measurement']);
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
	<title>CRUD medida</title>
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
  
<div class="col-md-3">
 <div class="container-fluid">
  <label>Medidas</label>
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">codigo:</span>
    </div>
   <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="cod_measurement" placeholder="cod_measurement" required><br>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">espalda:</span>
    </div>
   <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="back" placeholder="back" required><br>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">pecho:</span>
    </div>
   <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="chest" placeholder="chest"><br>
  </div>
 </div>
</div>
  
<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">abdomen:</span>
    </div>
   <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="abdomen" placeholder="abdomen" required><br>
  </div>
 </div>
</div>
  
<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">leg:</span>
    </div>
   <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="leg" placeholder="leg"><br>
  </div>
 </div>
</div>
  
<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">gemelos:</span>
    </div>
  <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="calf_muscle" required><br>
  </div>
 </div>
</div>
  
<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">brazo:</span>
    </div>
  <input type="text" name="arm" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required><br>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">antebrazo:</span>
    </div>
  <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="forearm" placeholder="forearm"><br>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">peso:</span>
    </div>
  <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="weight" placeholder="weight" required><br>
  </div>
 </div>
</div>

<div class="container-fluid">
 <div class="input-group mb-3">
  <div class="input-group-prepend">
    <div class="input-group-text">
      <?php  
         foreach ($db->query("SELECT * FROM history_clinic ") as $row) {?>
          <br>
          <input type="checkbox" aria-label="Checkbox for following text input" name="<?php echo $row['cod_history']; ?>" request>
          <?php echo "codigo: ".$row['cod_history']."---- fecha: ".$row['date_history']; ?>
       <?php   }?>
       <br>
   </div>
  </div>
 </div>
</div>  
  
<div class="container-fluid">
  <br><input class="btn btn-primary" type="submit" value="Guardar" onclick="this.form.action = '?action=registrar';"/>
</div>

</form> 
</div>
<?php } ?>
<div id="div_form">

<?php if(!empty($_GET['cod_measurement']) && (!empty($_GET['action']))){ ?>

<form action="#" method="post">
<br>
<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">codigo:</span>
    </div>
   
   <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="cod_measurement2" id="user_login" value="<?php echo $cod_measurement->__GET('cod_measurement'); ?>" placeholder="cod_measurement" required>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">espalda:</span>
    </div>
   
   <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="back" value="<?php echo $cod_measurement->__GET('back'); ?>"  placeholder="back" required>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">pecho:</span>
    </div>
   
   <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="chest" value="<?php echo $cod_measurement->__GET('chest'); ?>"  placeholder="chest">
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">abdomen:</span>
    </div>
   
   <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="abdomen" value="<?php echo $cod_measurement->__GET('abdomen'); ?>"  placeholder="abdomen" required>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">pierna:</span>
    </div>
   
   <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="leg" value="<?php echo $cod_measurement->__GET('leg'); ?>"  placeholder="leg">
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">gemelos:</span>
    </div>
   <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="calf_muscle" value="<?php echo $cod_measurement->__GET('calf_muscle'); ?>"  placeholder="calf_muscle" required>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">brazo:</span>
    </div>
   
   <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" class="form-control" name="arm" value="<?php echo $cod_measurement->__GET('arm'); ?>"  placeholder="arm" required>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">antebrazo:</span>
    </div>
   
   <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="forearm" value="<?php echo $cod_measurement->__GET('forearm'); ?>"  placeholder="forearm">
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">peso:</span>
    </div>
   
   <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="weight" value="<?php echo $cod_measurement->__GET('weight'); ?>"  placeholder="weight">
  </div>
 </div>
</div>


<input type="text" name="cod_measurement" value="<?php echo $cod_measurement->__GET('cod_measurement'); ?>" style="display:none" placeholder="cod_measurement" required>

<div class="container-fluid">
  <br><input class="btn btn-primary" type="submit" value="Actualizar" onclick="this.form.action = '?action=actualizar';" />
</div>

</form>
</div>

<?php } ?> 
<?php  
$sql1= "SELECT * FROM measurement";

$query = $db->query($sql1);

if($query->rowCount()>0):?> 
  
  <div class="container-fluid">
    <br><h1>CONSULTA - REGISTRO</h1><br>
  </div>
    <table id="customers">

<?php  

foreach ($model->Listar_medidas() as $r):?>
<div class="container">
  <ul class="list-group">
<nav aria-label="breadcrumb">
  <ol style="background-color:#BBBBBB" class="breadcrumb">
    <li style="color:black" class="breadcrumb-item active" aria-current="page">
       codigo medida: <?php echo $r->__GET('cod_measurement');?><br> 
       espalda: <?php echo $r->__GET('back');?><br>
       pecho: <?php echo $r->__GET('chest');?><br> 
       abdomen: <?php echo $r->__GET('abdomen');?><br>
       pierna: <?php echo $r->__GET('leg');?><br> 
       gemelos: <?php echo $r->__GET('calf_muscle');?><br>
       brazo: <?php echo $r->__GET('arm');?><br> 
       antebrazo: <?php echo $r->__GET('forearm');?><br>
       peso: <?php echo $r->__GET('weight');?><br> 
 
       <a class="btn btn-primary" href="?action=editar&cod_measurement=<?php echo $r->cod_measurement;?>">Editar</a> <a class="btn btn-primary" href="?action=eliminar&cod_measurement=<?php echo $r->cod_measurement;?>" onclick="return confirm('¿Esta seguro de eliminar este user?')">Eliminar</a>
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

