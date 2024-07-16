<?php
include_once "pedidos.php";
include_once "login.php";

initGenerarXML();

function initGenerarXML (){
  if (loggeado()) {
      generarXML();
  }else{
      header("location:index.php");
  }
}

function generarXML(){
  $idpedido = mysqli_fetch_assoc(consultar(conectar(), "hersheyB2B", "SELECT idpedido FROM bd_pedidos ORDER BY idpedido DESC LIMIT 1"))['idpedido'];
  if ($idpedido == null) {
    $idpedido = 0;
  }

  $idpedido++;

  $numpedido = $_POST['numpedido'];
  $fechapedido = $_POST['fechapedido'];
  $idcliente = $_SESSION['idusuario'];
  $cliente = $_POST['cliente'];
  $idproducto = $idpedido;
  $producto = $_POST['producto'];
  $cantidad = $_POST['cantidad'];
  $importe = $_POST['importe'];

  //Creación del documento XML
  $archivoXML = new DomDocument("1.0","UTF-8");
  
  //Crea elemento y se agrega
  $raiz = $archivoXML->createElement("pedidos");
  $raiz = $archivoXML->appendChild($raiz);

  $elementoXML = $archivoXML->createElement("idpedido", $idpedido);
  $elementoXML = $raiz->appendChild($elementoXML);

  $elementoXML = $archivoXML->createElement("numpedido", $numpedido);
  $elementoXML = $raiz->appendChild($elementoXML);

  $elementoXML = $archivoXML->createElement("fechapedido", $fechapedido);
  $elementoXML = $raiz->appendChild($elementoXML);

  $elementoXML = $archivoXML->createElement("idcliente", $idcliente);
  $elementoXML = $raiz->appendChild($elementoXML);

  $elementoXML = $archivoXML->createElement("cliente", $cliente);
  $elementoXML = $raiz->appendChild($elementoXML);

  $elementoXML = $archivoXML->createElement("idproducto", $idproducto);
  $elementoXML = $raiz->appendChild($elementoXML);

  $elementoXML = $archivoXML->createElement("producto", $producto);
  $elementoXML = $raiz->appendChild($elementoXML);

  $elementoXML = $archivoXML->createElement("cantidad", $cantidad);
  $elementoXML = $raiz->appendChild($elementoXML);

  $elementoXML = $archivoXML->createElement("importe", $importe);
  $elementoXML = $raiz->appendChild($elementoXML);
  
  /*guardar xml--------------------------------*/  
  $archivoXML->formatOut = true;

  $nombreArchivo = "pedidos-" . date('Y-m-d-H-i-s') . ".xml";
  
  if($archivoXML->save($nombreArchivo)){
    echo '<script language="javascript">alert("Se creado exitosamente el archivo xml.");</script>';
    echo '<script language="javascript">window.location="cargarinfo.php";</script>';
  }else{
    echo '<script language="javascript">alert("No se pudo guardar el archivo xml.");</script>';
  }
}
?>