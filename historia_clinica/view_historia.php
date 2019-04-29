<?php 

require_once '../control.php';
require_once 'model_historia.php';
require_once '../conexion.php';
//Logica
$historia = new type_history();
$model = new historyModel();
$db = database::conectar();

if(isset($_REQUEST['action']))
{
	switch ($_REQUEST['action']) {
	
		case 'actualizar':
			// $historia->__SET('cod_history',   				$_REQUEST['cod_history']);
			// $historia->__SET('date_history',				$_REQUEST['date_history']);
			$historia->__SET('user_n_document',  			$_REQUEST['user_n_document']);
			$historia->__SET('user_type_document',	$_REQUEST['user_type_document']);
			$historia->__SET('cod_history2',				$_REQUEST['cod_history2']);
			

			$model->Actualizar_historia($historia);
			print "<script>alert(\"registro Actualizado Exitosamente.\");window.location='view_historia.php';</script>";
			break;
		
		case 'registrar':

			// $historia->__SET('cod_history', 	       			 $_REQUEST['cod_history']);
			// $historia->__SET('date_history',	       			 $_REQUEST['date_history']);
			$historia->__SET('user_n_document', 	        	 $_REQUEST['user_n_document']);
			$historia->__SET('user_type_document',	     $_REQUEST['user_type_document']);
	
			$model->Registrar_historia($historia);
			print "<script>alert(\"Resgistro Agregado Exitosamente.\");window.location='view_historia.php';</script>";
			break;

		case 'eliminar':
			$model->Eliminar_historia($_REQUEST['cod_history']);
			print"<script>alert(\"registro Eliminado Exitosamente.\");window.location='view_historia.php';</script>";
			break;

		case 'editar':
			// $cod_history = $model->Obtener_historia($_REQUEST['cod_history']);
			// $date_history = $model->Obtener_historia($_REQUEST["cod_history"]);
			$user_n_document = $model->Obtener_historia($_REQUEST['cod_history']);
			$user_type_document = $model->Obtener_historia($_REQUEST["cod_history"]);
			$disease = $model->Obtener_historia($_REQUEST["cod_history"]);
			break;	
	}
}
?>
<?php 
$adm=$_SESSION['admin'];
if ($adm!='1') {
  header("location: index.html");
}

 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>CRUD historia</title>
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
     <span class="input-group-text" id="inputGroup-sizing-default">numero documento:</span>
    </div>
   <select class="form-control" aria-label="large" aria-describedby="inputGroup-sizing-large" name="user_n_document">
      <?php  
         foreach ($db->query("SELECT * FROM people WHERE n_document=n_document") as $row) {
          echo '<option>'.$row['n_document'].'</option>';
         }
      ?>
     </select>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">tipo documento:</span>
    </div>
    <select class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="user_type_document">
      <?php  
         foreach ($db->query("SELECT * FROM people WHERE type_document_people=type_document_people") as $row) {
          echo '<option>'.$row['type_document_people'].'</option>';
         }
      ?>
     </select>
  </div>
 </div>
</div>

<div class="container-fluid">
  <div class="input-group mb-3">
  <div class="input-group-prepend">
    <div class="input-group-text">
      <?php  
         foreach ($db->query("SELECT * FROM disease ") as $row) {?>
          <br>
          <input  type="checkbox" aria-label="Checkbox for following text input" name="<?php echo $row['name_disease']; ?>">
          <?php echo $row['name_disease']; ?>
       <?php   }?>
    </div>
    <br><input class="btn btn-primary" type="submit" value="Guardar" onclick="this.form.action = '?action=registrar';"/>
  </div>
</div>
</div>     
     
            
</form> 
</div>
<?php } ?>
<div id="div_form">

<?php if(!empty($_GET['cod_history']) && (!empty($_GET['action']))){ ?>

<form action="#" method="post">

<br><input type="text" name="cod_history" value="<?php echo $cod_history->__GET('cod_history'); ?>" style="display:none" placeholder="cod_history" required> 

<div class="col-md-3">
 <div class="container-fluid">
  <span><h1>Modificar historia</h1></span>
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">Identificacion:</span>
    </div>
   <input type="text" name="cod_history2" id="user_login" value="<?php echo $cod_history->__GET('cod_history'); ?>" placeholder="cod_history" required disabled>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">fecha:</span>
    </div>
   <input type="text" name="date_history" id="user_login" value="<?php echo $cod_history->__GET('date_history'); ?>" placeholder="date_history" required disabled>
  </div>
 </div>
</div>
  
<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">documento:</span>
    </div>
   <input type="text" name="user_n_document" id="user_login" value="<?php echo $cod_history->__GET('user_n_document'); ?>" placeholder="user_n_document" required>
  </div>
 </div>
</div>

<div class="col-md-3">
 <div class="container-fluid">
  <div class="input-group mb-3">
   <div class="input-group-prepend">
     <span class="input-group-text" id="inputGroup-sizing-default">tipo documento:</span>
    </div>
    <input type="text" name="user_type_document" id="user_login" value="<?php echo $cod_history->__GET('user_type_document'); ?>" placeholder="user_type_document" required>
  </div>
  <br><input class="btn btn-primary" type="submit" value="Actualizar" onclick="this.form.action = '?action=actualizar';" />
 </div>
</div>



</form>
</div>

<?php } ?> 
<?php  
//FIN -> FORMULARIO ACTUALIZAR registro-->
$sql1= "SELECT * FROM history_clinic";

$query = $db->query($sql1);

if($query->rowCount()>0):?> 
  
  <div class="container-fluid">
    <br><h1>CONSULTA REGISTRO</h1><br>
  </div>
    <table id="customers">
    
<?php  

foreach ($model->Listar_historia() as $r):?>
<div class="container">
  <ul class="list-group">
<nav aria-label="breadcrumb">
  <ol style="background-color:#BBBBBB" class="breadcrumb">
    <li style="color:black " class="breadcrumb-item active" aria-current="page">
       Codigo: <?php echo $r->__GET('cod_history');?><br> 
       Fecha: <?php echo $r->__GET('date_history');?><br>
       identificacion: <?php echo $r->__GET('user_n_document');?><br> 
       Tipo de documento: <?php echo $r->__GET('user_type_document');?><br>
       <!-- Patologia: <?php echo $r->__GET('disease');?><br>  -->
       <a class="btn btn-primary" href="?action=eliminar&cod_history=<?php echo $r->cod_history;?>" onclick="return confirm('¿Esta seguro de eliminar este user?')">Eliminar</a> 
        </li>
      </ol>
    </nav>
  </ul>
</div>
<?php endforeach; ?>
</table>
<?php else: ?>
<div class="container-fluid">
  <h4 class="alert alert-danger">Señor user no se Encuentran registro</h4>
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