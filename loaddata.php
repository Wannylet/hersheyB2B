<?php
	//se hace la conexión ha la base de datos
	include_once "login.php";

	initLoadData();
	
	function initLoadData (){
		if (loggeado()) {
			cargar();
		}else{
			header("location:index.php");
		}
	}
	
	function cargar(){
		$connection = conectar();
		$dataBase = "hersheyB2B";
		
		if (isset($_FILES['archivoProcesar']) && $_FILES['archivoProcesar']['error'] == 0) {

			$nombreArchivo = (string) $_FILES['archivoProcesar']['name'];
			$direccionArchivo = (string) __DIR__ . "\\" . $nombreArchivo;

			$archivoXML = simplexml_load_file($direccionArchivo);

			if ($archivoXML === false) {
				echo "Error al cargar el archivo XML.";
			} else {
				$pedido = $archivoXML->children();
				$campos = "INSERT INTO bd_pedidos (numpedido, fechapedido, idcliente, cliente, idproducto, producto, cantidad, importe)";
				$valores = " VALUES ('".$pedido->numpedido."', '".date('Y-m-d')."', '".$pedido->idcliente."', '".$pedido->cliente."', '".$pedido->idproducto."', '".$pedido->producto."', '".$pedido->cantidad."', '".$pedido->importe."')";
				$query = $campos . $valores;
				
				consultar($connection, $dataBase, $query);
				
				echo '<script language="javascript">alert("Se han insertado los datos exitosamente en la base de datos.");</script>';
				
				echo '<script language="javascript">window.location="newone.php";</script>';
			}
		} else {
			echo '<script language="javascript">alert("Error al subir el archivo.");</script>'; 
			echo '<script language="javascript">window.location="newone.php";</script>';
		}
	}
?>