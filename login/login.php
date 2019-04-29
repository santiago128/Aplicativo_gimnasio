<!DOCTYPE html>
<html">
<head>
<meta charset="UTF-8"/>
<title>Validacion_login</title>
</head>
<body>

<?php

class Login{
		
		public function Login_user($doc, $pass){


require_once '../conexion.php';

// Logica

$db = database::conectar();

$documento=$_POST["usuario"];
$pass=$_POST["password"];

$cont=0;

$sql2="SELECT * FROM admon WHERE usuario='$documento' AND password='$pass'";
if(!$result2 = $db->query($sql2)){
  die('Hay un error corriendo en la consulta o datos no encontrados!!! [' . $db->error . ']');
}

while ($row2=$result2->fetch(PDO::FETCH_ASSOC))
// while($row2 = $result2->fetch_assoc())
{
	$ddocumentoev=stripslashes($row2["usuario"]);
	$ccontrasenaev=stripslashes($row2["password"]);

	$cont=$cont+1;
		
}

if ($cont==0)
{

print "<script>alert(\"Usuario y/o Password Incorrectas.\");window.location='../index.php';</script>";

}

if ($cont!=0)
{
$_SESSION['usuario']=$ddocumentoev;
$_SESSION['password']=$ccontrasenaev;


$_SESSION['admin']=1;
print "<script>alert(\"Ingreso Exitoso.\");window.location='../fusion.php';</script>";
} //fin if conteo		
			
}// finalizando el método

}//cerrando la clase
		
	$Nuevo=new login();
    $Nuevo->Login_user($_POST["usuario"],$_POST["password"]);
	
?>

</body>
</html>