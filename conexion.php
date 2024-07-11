<?php}
//Datos para la conexion a mysql

$server = "localhost";
$user = "root";
$password = "";

$connection = mysqli_connect($server, $user, $password);

$dataBase = "b2b";
mysqli_select_db($connection, $dataBase);
?>