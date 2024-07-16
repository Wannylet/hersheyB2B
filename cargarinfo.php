<?php
include_once "login.php";

initCargarInfo();

function initCargarInfo (){
	if (loggeado()){
		interfazCargar();
	}else{
    	header("location:index.php");
	}
}

function interfazCargar (){
?>
	<html lang="MX-es">
		<head>
			<meta charset="utf-8"/>
			<link rel="stylesheet" type="text/css" href="style.css" />
			<title>Pedidos de Venta</title>
		</head>
		<body>
			<a id="a" href="logout.php">Salir</a>
			<h1 id="h1">Generar Pedido de Venta</h1>
			
			<form name="login-form" class="login-form" action="loaddata.php" method="post" enctype="multipart/form-data">
				<div class="header">
					<span>Se ha creado el archivo XML, ahora puede cargarlo a la base de datos.</span>
				</div>
				<div class="footer">
					<input type="file" name="archivoProcesar" accept=".xml" class="" required/>
					<input type="submit" name="login" value="Cargar Información" class="button"/>
				</div>
			</form>
		</body>
	</html>
<?php
}
?>