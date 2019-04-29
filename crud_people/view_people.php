<?php 

require_once '../control.php';
require_once 'model_people.php';
require_once '../conexion.php';

$persona = new type_people();
$model = new modelpeople();
$db = database::conectar();

if(isset($_REQUEST['action']))
{
	switch ($_REQUEST['action']) {
	
		case 'actualizar':
			$persona->__SET('n_document',     				$_REQUEST['n_document']);
			$persona->__SET('type_document_people',			$_REQUEST['type_document_people']);
			$persona->__SET('first_name',					$_REQUEST['first_name']);
			$persona->__SET('second_name',					$_REQUEST['second_name']);
			$persona->__SET('first_lastname',				$_REQUEST['first_lastname']);
			$persona->__SET('second_lastname',    			$_REQUEST['second_lastname']);
			$persona->__SET('birth_date',					$_REQUEST['birth_date']);
			$persona->__SET('age',							$_REQUEST['age']);
			$persona->__SET('address',     					$_REQUEST['address']);
			$persona->__SET('number_phone',					$_REQUEST['number_phone']);
			$persona->__SET('email',						$_REQUEST['email']);
			$persona->__SET('rol_user',     				$_REQUEST['rol_user']);
			$persona->__SET('routines_user',    			$_REQUEST['routines_user']);
			$persona->__SET('n_document2',					$_REQUEST['n_document2']);
			$persona->__SET('type_document_people2',     	$_REQUEST['type_document_people2']);
			
			$model->Actualizar_personas($persona);
			// print "<script>alert(\"Registro Actualizado Exitosamente.\");window.location='view_people.php';</script>";
			break;
		
		case 'registrar':
			$persona->__SET('n_document',     				$_REQUEST['n_document']);
			$persona->__SET('type_document_people',			$_REQUEST['type_document_people']);
			$persona->__SET('first_name',					$_REQUEST['first_name']);
			$persona->__SET('second_name',					$_REQUEST['second_name']);
			$persona->__SET('first_lastname',				$_REQUEST['first_lastname']);
			$persona->__SET('second_lastname',    			$_REQUEST['second_lastname']);
			$persona->__SET('birth_date',					$_REQUEST['birth_date']);
			$persona->__SET('age',							$_REQUEST['age']);
			$persona->__SET('address',     					$_REQUEST['address']);
			$persona->__SET('number_phone',					$_REQUEST['number_phone']);
			$persona->__SET('email',						$_REQUEST['email']);
			$persona->__SET('rol_user',     				$_REQUEST['rol_user']);
			$persona->__SET('routines_user',    			$_REQUEST['routines_user']);

			$model->Registrar_personas($persona);
			print "<script>alert(\"Resgistro Agregado Exitosamente.\");window.location='view_people.php';</script>";
			break;

		case 'eliminar':
			$model->Eliminar_personas($_REQUEST['n_document']);
			print"<script>alert(\"Registro Eliminado Exitosamente.\");window.location='view_people.php';</script>";
			break;

		case 'editar':
			$n_document = $model->Obtener_personas($_REQUEST['n_document']);
			$type_document_people = $model->Obtener_personas($_REQUEST['n_document']);
			$first_name = $model->Obtener_personas($_REQUEST['n_document']);
			$second_name = $model->Obtener_personas($_REQUEST['n_document']);
			$first_lastname = $model->Obtener_personas($_REQUEST['n_document']);
			$second_lastname = $model->Obtener_personas($_REQUEST['n_document']);
			$birth_date = $model->Obtener_personas($_REQUEST['n_document']);
			$age = $model->Obtener_personas($_REQUEST['n_document']);
			$address = $model->Obtener_personas($_REQUEST['n_document']);
			$number_phone = $model->Obtener_personas($_REQUEST['n_document']);
			$email = $model->Obtener_personas($_REQUEST['n_document']);
			$rol_user = $model->Obtener_personas($_REQUEST['n_document']);
			$routines_user = $model->Obtener_personas($_REQUEST['n_document']);
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
	<title>CRUD persona</title>
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
     <span class="input-group-text" id="inputGroup-sizing-lg">numero:</span>
    </div>
   <input type="text" type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="n_document" placeholder="n_document" required><br>
  </div>
 </div>
</div> 

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-lg">tipo documento:</span>
    </div>
   <select name="type_document_people">
  <?php  
    foreach ($db->query('SELECT * FROM type_document WHERE code_document=code_document') as $row) {
      echo '<option>'.$row['desc_document'].'</option>';
    }
  ?>
  </select requiered><br>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-lg">p nombre:</span>
     </div>
      <input type="text" type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="first_name" placeholder="first_name" required><br>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-lg">s nombre:</span>
     </div>
      <input type="text" type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="second_name" placeholder="second_name"><br>
  </div>
 </div>
</div>     

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-lg">p apellido:</span>
     </div>
      <input type="text" type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="first_lastname" placeholder="first_lastname" required><br>
  </div>
 </div>
</div>  

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-lg">s apellido:</span>
     </div>
      <input type="text" type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="second_lastname" placeholder="second_lastname"><br>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-lg">fecha nacimiento:</span>
     </div>
      <input type="date" type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="birth_date" required><br>
  </div>
 </div>
</div>    
  
<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-lg">edad:</span>
     </div>
      <input type="text" type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="age" placeholder="age" required><br>
  </div>
 </div>
</div>  
  
<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-lg">direccion:</span>
     </div>
      <input type="text" type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="address" placeholder="address"><br>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-lg">telefono:</span>
     </div>
      <input type="text" type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="number_phone" placeholder="number_phone" required><br>
  </div>
 </div>
</div>  
  
<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-lg">email:</span>
     </div>
      <input type="text" type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="email" placeholder="email" required=""><br>
  </div>
 </div>
</div> 

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-lg">rol del usuario:</span>
     </div>
      <select name="rol_user">
  <?php  
    foreach ($db->query('SELECT * FROM role WHERE name_rol=name_rol') as $row) {
      echo '<option>'.$row['name_rol'].'</option>';
    }
  ?>
  </select><br>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-lg">rutina:</span>
     </div>
      <select name="routines_user">
  <?php  
    foreach ($db->query('SELECT * FROM routine WHERE cod_routine=cod_routine') as $row) {
      echo '<option>'.$row['desc_routine'].'</option>';
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

<?php if(!empty($_GET['n_document']) && (!empty($_GET['action']))){ ?>

<form action="#" method="post">

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-lg">Numero:</span>
    </div>
   <br><input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="n_document2" id="user_login" value="<?php echo $n_document->__GET('n_document'); ?>" placeholder="n_document" required>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-lg">tipo documento:</span>
    </div>
   <br><input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="type_document_people2" value="<?php echo $n_document->__GET('type_document_people'); ?>"  placeholder="type_document" required>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-lg">p nombre:</span>
    </div>
   <br><input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="first_name" value="<?php echo $n_document->__GET('first_name'); ?>"  placeholder="first_name" required>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-lg">s nombre:</span>
    </div>
   <br><input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="second_name" value="<?php echo $n_document->__GET('second_name'); ?>"  placeholder="second_name">
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-lg">p apellido:</span>
    </div>
   <br><input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="first_lastname" value="<?php echo $n_document->__GET('first_lastname'); ?>"  placeholder="first_lastname" required>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-lg">s apellido:</span>
    </div>
   <br><input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="second_lastname" value="<?php echo $n_document->__GET('second_lastname'); ?>"  placeholder="second_lastname">
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-lg">nacimiento:</span>
    </div>
   <br><input type="date" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="birth_date" value="<?php echo $n_document->__GET('birth_date'); ?>"  placeholder="birth_date" required>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-lg">edad:</span>
    </div>
   <br><input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="age" value="<?php echo $n_document->__GET('age'); ?>"  placeholder="age" required>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-lg">direccion:</span>
    </div>
   <br><input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="address" value="<?php echo $n_document->__GET('address'); ?>"  placeholder="address">
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-lg">telefono:</span>
    </div>
   <br><input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="number_phone" value="<?php echo $n_document->__GET('number_phone'); ?>"  placeholder="number_phone">
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-lg">email:</span>
    </div>
   <br><input type="email" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="email" value="<?php echo $n_document->__GET('email'); ?>"  placeholder="email">
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-lg">rol:</span>
    </div>
   <br><input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="rol_user" value="<?php echo $n_document->__GET('rol_user'); ?>"  placeholder="rol_user" required>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-lg">rutina:</span>
    </div>
   <br><input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="routines_user" value="<?php echo $n_document->__GET('routines_user'); ?>"  placeholder="routines_user" required>
  </div>
   <br><input class="btn-outline-secondary" type="submit" value="Actualizar" onclick="this.form.action = '?action=actualizar';" />
 </div>
</div>

<br><input type="text" name="n_document" value="<?php echo $n_document->__GET('n_document'); ?>" style="display:none" placeholder="n_document" required>
<br><input type="text" name="type_document_people" value="<?php echo $n_document->__GET('type_document_people'); ?>" style="display:none" placeholder="type_document" required>

</form>
</div>

<?php } ?> 
<?php  
$sql1= "SELECT * FROM people";

$query = $db->query($sql1);

if($query->rowCount()>0):?> 
  
  <div class="container-fluid">
    <br><h1>CONSULTA - REGISTRO</h1><br>
  </div>
  
<?php  

foreach ($model->Listar_personas() as $r):?>
  <br><br>
<div class="container">
  <ul class="list-group">
    <nav aria-label="breadcrumb">
  <ol style="background-color:#BBBBBB" class="breadcrumb">
    <li style="color:black" class="breadcrumb-item active" aria-current="page">
       Documento: <?php echo $r->__GET('n_document');?><br> 
      Tipo de documento: <?php echo $r->__GET('type_document_people');?><br> 
      Primer nombre: <?php echo $r->__GET('first_name');?><br> 
      Segundo nombre: <?php echo $r->__GET('second_name');?><br> 
      Primer apellido: <?php echo $r->__GET('first_lastname');?><br> 
      Segundo apellido: <?php echo $r->__GET('second_lastname');?><br> 
      Fecha de nacimiento: <?php echo $r->__GET('birth_date');?><br> 
      Edad: <?php echo $r->__GET('age');?><br> 
      Direccion: <?php echo $r->__GET('address');?><br> 
      Numero de telefono: <?php echo $r->__GET('number_phone');?><br> 
      Email: <?php echo $r->__GET('email');?><br> 
      Rol: <?php echo $r->__GET('rol_user');?><br> 
      Rutina: <?php echo $r->__GET('routines_user');?><br><br>
      <a class="btn btn-primary" href="?action=editar&n_document=<?php echo $r->n_document;?>">Editar</a> <a class="btn btn-primary" href="?action=eliminar&n_document=<?php echo $r->n_document;?>" onclick="return confirm('¿Esta seguro de eliminar este user?')">Eliminar</a> 
    </li>
  </ol>
</nav>
</ul>
</div>
<?php endforeach; ?>

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