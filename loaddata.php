<?php
	//se hace la conexión ha la base de datos
	mysql_connect("localhost","hanselit_admin","123456") or die("Error");
	mysql_select_db("hanselit_mysql") or die("Error en la BD");

	// Se lee el archivo xml desde la ruta FTP
	$fileXML = simplexml_load_file("pedidos.xml") or die("No se encuentra el archivo");
	//print_r($fileXML);

	//Se elabora el query para ir tomando los valores del xml e irlos insertando en la base de datos
	$query = "";
	foreach ($fileXML->children() as $valor) {
		$query= "INSERT INTO bd_pedidos (numpedido, fechapedido, idcliente, cliente, idproducto, producto, cantidad, importe) VALUES ('".$valor->numpedido."',CURRENT_TIMESTAMP,
			'".$valor->idcliente."','".$valor->cliente."',
			'".$valor->idproducto."','".$valor->producto."',

			'".$valor->cantidad."','".$valor->importe."');";
		mysql_query($query) or die("Error en el query");
//
	}
echo '<script language="javascript">alert("Se han insertado los datos exitosamente en la base de datos.");</script>'; 
echo '<script language="javascript">window.location="newone.php";</script>'; 

?>