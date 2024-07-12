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
  $idpedido = $_SESSION["idusuario"];
  $numpedido = $_POST['numpedido'];
  $fechapedido = $_POST['fechapedido'];
  $idcliente = $idpedido;
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
  
  /*primer ITEM--------------------------*/

  $item = $archivoXML->createElement("Item");
  $item = $raiz->appendChild($item);

  $elementoXML = $archivoXML->createElement("idpedido", $idpedido);
  $elementoXML = $item->appendChild($elementoXML);

  $elementoXML = $archivoXML->createElement("numpedido", $numpedido);
  $elementoXML = $item->appendChild($elementoXML);

  $elementoXML = $archivoXML->createElement("fechapedido", $fechapedido);
  $elementoXML = $item->appendChild($elementoXML);

  $elementoXML = $archivoXML->createElement("idcliente", $idcliente);
  $elementoXML = $item->appendChild($elementoXML);

  $elementoXML = $archivoXML->createElement("cliente", $cliente);
  $elementoXML = $item->appendChild($elementoXML);

  $elementoXML = $archivoXML->createElement("idproducto", $idproducto);
  $elementoXML = $item->appendChild($elementoXML);

  $elementoXML = $archivoXML->createElement("producto", $producto);
  $elementoXML = $item->appendChild($elementoXML);

  $elementoXML = $archivoXML->createElement("cantidad", $cantidad);
  $elementoXML = $item->appendChild($elementoXML);

  $elementoXML = $archivoXML->createElement("importe", $importe);
  $elementoXML = $item->appendChild($elementoXML);
  
  /*guardar xml--------------------------------*/  
  $archivoXML->formatOut = true;

  if($archivoXML->save("pedidos.xml")){
    echo '<script language="javascript">alert("Se creado exitosamente el archivo xml.");</script>';
    echo '<script language="javascript">window.location="cargarinfo.php";</script>';
  }else{
    echo '<script language="javascript">alert("No se pudo guardar el archivo xml.");</script>';
  }
}
?>