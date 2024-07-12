<?php
include_once "login.php";

initNewOne();

function initNewOne (){
	if (loggeado()) {;
		interfazNuevo();
	}else{
		header("location:index.php");
	}
}

function interfazNuevo (){
?>
	<html lang="MX-es">
		<head>
			<meta charset="utf-8"/>
			<link rel="stylesheet" type="text/css" href="style.css" />
			<title>Pedidos de Venta</title>
		</head>
		<body>
			<a id="a" href="logout.php">Salir</a>
			<h1 id="h1">Sí deseas generar otro pedido, selecciona el botón.</h1>
			<br><br>
			<form name="login-form" class="login-form" action="pedidos.php" method="post">
				<div class="header">
					<span>Se han cargado los datos a la base de datos, ¿desea hacer un nuevo pedido?.</span>
				</div>
				<div class="footer">
					<input type="submit" name="login" value="Cargar Nueva Información" class="button" />
				</div>
			</form>
		</body>
	</html>
<?php
}
?>