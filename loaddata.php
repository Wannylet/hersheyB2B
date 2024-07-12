<?php
	//se hace la conexión ha la base de datos
	include_once "login.php";

	initLoadData();

	function initLoadData (){
		if (loggeado()) {;
			cargar();
		}else{
			header("location:index.php");
		}
	}
	
	function cargar(){
		$connection = conectar();
		$dataBase = "hersheyB2B";
		
		// Se lee el archivo xml desde la ruta directorio
		$archivoXML = simplexml_load_file("pedidos.xml");

		//Se elabora el query para ir tomando los valores del xml e irlos insertando en la base de datos
		foreach ($archivoXML->children() as $valor) {
			$campos = "INSERT INTO bd_pedidos (numpedido, fechapedido, idcliente, cliente, idproducto, producto, cantidad, importe)";
			$valores = " VALUES ('".$valor->numpedido."','".date('Y-m-d')."','".$valor->idcliente."','".$valor->cliente."','".$valor->idproducto."','".$valor->producto."','".$valor->cantidad."','".$valor->importe."');";
			$query = $campos . $valores;
			
			consultar($connection, $dataBase, $query);
		}

	echo '<script language="javascript">alert("Se han insertado los datos exitosamente en la base de datos.");</script>'; 
	echo '<script language="javascript">window.location="newone.php";</script>';
	}
?>