<!DOCTYPE html>
<html lang="es"  >

<head>
  <meta charset="UTF-8">
  <title>RYN Gimnasio</title>
  
  
  
      <style>

body{
	margin: 0;
	padding: 0;
	background: #fff;

	color: #fff;
	font-family: Arial;
	font-size: 12px;

}

.body{
	position: absolute;
	top: -20px;
	left: -20px;
	right: -40px;
	bottom: -40px;
	width: auto;
	height: auto;
	background-image: url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSqRWOJNWknKJ0abeNvp6MofpSnZfKTyQXSmuSLVUa3ADoHenwU);
	background-size: cover;
	-webkit-filter: blur(10px);
	z-index: 0;
}

.header{
	position: absolute;
	top: calc(50% - 35px);
	left: calc(50% - 255px);
	z-index: 2;
}

.header div{
	float: left;
	color: #fff;
	font-family: 'Exo', sans-serif;
	font-size: 35px;
	font-weight: 200;
}

.header div span{
	color: 	#0B2161 !important;
}

.login{
	position: absolute;
	top: calc(50% - 75px);
	left: calc(55% - 50px);
	height: 150px;
	width: 350px;
	padding: 10px;
	z-index: 2;
}

.login input[type=text]{
	width: 250px;
	height: 30px;
	background: transparent;
	border: 1px solid rgba(255,255,255,0.6);
	border-radius: 2px;
	color: #fff;
	font-family: 'Exo', sans-serif;
	font-size: 16px;
	font-weight: 400;
	padding: 4px;
}

.login input[type=password]{
	width: 250px;
	height: 30px;
	background: transparent;
	border: 1px solid rgba(255,255,255,0.6);
	border-radius: 2px;
	color: #fff;
	font-family: 'Exo', sans-serif;
	font-size: 16px;
	font-weight: 400;
	padding: 4px;
	margin-top: 10px;
}

.login input[type=button]{
	width: 260px;
	height: 35px;
	background: #fff;
	border: 1px solid #fff;
	cursor: pointer;
	border-radius: 2px;
	color: #a18d6c;
	font-family: 'Exo', sans-serif;
	font-size: 16px;
	font-weight: 400;
	padding: 6px;
	margin-top: 10px;
}

.login input[type=button]:hover{
	opacity: 0.8;
}

.login input[type=button]:active{
	opacity: 0.6;
}

.login input[type=text]:focus{
	outline: none;
	border: 1px solid rgba(255,255,255,0.9);
}

.login input[type=password]:focus{
	outline: none;
	border: 1px solid rgba(255,255,255,0.9);
}

.login input[type=button]:focus{
	outline: none;
}

::-webkit-input-placeholder{
   color: rgba(255,255,255,0.6);
}

::-moz-input-placeholder{
   color: rgba(255,255,255,0.6);
}
    </style>

</head>
<link rel="stylesheet" href="css/bootstrap.min.css">
<body>
<form id="form1" name="form1" method="post" action="login/login.php">
  <div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div>RYN<span>Gimnasio</span></div>
		</div>
		<br>
		<div class="login">
				<input type="text" placeholder="Digite su nombre" name="usuario" id="doc"><br>
				<input type="password" placeholder="Digite su cedula" name="password" id="pass"><br>
				<br>
				<input type="submit" class="btn btn-dark" value="Ingresar"/>
				<!-- <input type="button" value="Ingresar"> -->
		</div>

  
</form>
</body>

</html>
