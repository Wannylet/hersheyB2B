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

			$nombreArchivo = $_FILES['archivoProcesar']['name'];
			$direccionArchivo = __DIR__ . "\\" . $nombreArchivo;

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
				
				//- - - - - - - - - -

				//variables – Nota – hacer una prueba primero en localhost.
				$ftp_server = "31.170.167.212"; // Datos de X10 Hosting
				$ftp_user_name = "u269761573"; // Usuario X10 Hosting
				$ftp_user_pass = "tiendaRoot1"; // // Usuario X10 Hosting "cloudproject.cloud"
				// carpeta destino en X10
				$destination_file = "../Caleb/" . $nombreArchivo;
                //Xml creado
                $source_file = __DIR__ . "\\" . $nombreArchivo;

				// conexión
				$conn_id = ftp_connect($ftp_server);
				
				// login
				$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
				
				// conexión
				if ((!$conn_id) || (!$login_result)) {
					echo '<script language="javascript">alert("Conexión al FTP ' . $ftp_server . ' del usuario ' . $ftp_user_name . ' con errores.");</script>';
				} else {
					echo '<script language="javascript">alert("Conectado a ' . $ftp_server . ' del usuario ' . $ftp_user_name . '.");</script>';
				}

				$upload = ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY);

				// estado de envio
				if ($upload) {
					echo '<script language="javascript">alert("Archivo ' . $source_file . ' se ha subido exitosamente a ' . $ftp_server . ' en ' . $destination_file . '");</script>';
				} else {
					echo '<script language="javascript">alert("Archivo ' . $source_file . ' no se ha podido subir a ' . $ftp_server . ' en ' . $destination_file . '");</script>';
				}

				// cerramos la conexión.
				ftp_close($conn_id);

				//- - - - - - - - - -

				echo '<script language="javascript">window.location="newone.php";</script>';
			}
		} else {
			echo '<script language="javascript">alert("Error al subir el archivo.");</script>'; 
			echo '<script language="javascript">window.location="newone.php";</script>';
		}
	}
?>