<?php
include_once "pedidos.php";
include_once "login.php";
session_start();

initGenerarXML();

function initGenerarXML (){
  if (loggeado()) {
      header("location:index.php");
  }else{
      generarXML();
  }
}

function generarXML(){
  $numpedido = $_POST['numpedido'];
  $fechapedido = $_POST['fechapedido'];
  $cliente = $_POST['cliente'];
  $producto = $_POST['producto'];
  $cantidad = $_POST['cantidad'];
  $importe = $_POST['importe'];

  $xml=new DomDocument("1.0","UTF-8");
  
  $raiz=$xml->createElement("pedidos");
  $raiz=$xml->appendChild($raiz);
  
  /*primer ITEM--------------------------*/  
  
  $oc=$xml->createElement("Item");
  $oc=$raiz->appendChild($oc);
  $proveedor=$xml->createElement("numpedido", $numpedido);
  $proveedor=$oc->appendChild($proveedor);
  
  $proveedor=$xml->createElement("idcliente", $idcliente);
  $proveedor=$oc->appendChild($proveedor);
  
  $numeroOC=$xml->createElement("cliente", $cliente);
  $numeroOC=$oc->appendChild($numeroOC);

$proveedor=$xml->createElement("idproducto", $idproducto);
$proveedor=$oc->appendChild($proveedor);

$numeroOC=$xml->createElement("producto", $producto);
$numeroOC=$oc->appendChild($numeroOC);

$proveedor=$xml->createElement("cantidad", $cantidad);
$proveedor=$oc->appendChild($proveedor);

$proveedor=$xml->createElement("importe", $importe);
$proveedor=$oc->appendChild($proveedor);

/*guardar xml--------------------------------*/  
$xml->formatOut=true;

$strings_xml=$xml->saveXML();

if($xml->save("pedidos.xml")){
  echo '<script language="javascript">alert("Se creado exitosamente el archivo xml.");</script>'; 
  echo '<script language="javascript">window.location="cargarinfo.php";</script>'; 
  
  //header('location: cargarinfo.php'); 
}else{
  echo '<script language="javascript">alert("No se pudo guardar el archivo xml.");</script>'; 
}
}
?>