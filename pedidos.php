<!DOCTYPE html>

<?php
include_once "login.php";
session_start();

initPedidos();

function initPedidos (){
    if (loggeado()) {
        interfazEntrada();
    }else{
        header("location:index.php");
    }
}

function interfazEntrada(){
?>
<html lang="MX-es">
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <title>Pedidos de Venta</title>
    </head>
    
    <body>
        <a id="a" href="logout.php">Salir</a>
        
        <h1 id="h1">Generar Pedido de Venta</h1>
        <br>
        
        <form name="pedidos" class="login-form" action="generarxml.php" method="post">
            <div class="content">
                <br>
                <input name="numpedido" type="number" class="input indata" placeholder="Número de pedido: 5000" required>
                <input name="fechapedido" type="date" class="input indata" required>
                <input name="cliente" type="text" class="input indata" placeholder="Cliente: Bimbo" required>
                <input name="producto" type="text" class="input indata" placeholder="Producto: Mesas" required>
                <input name="cantidad" type="number" class="input indata" placeholder="Cantidad: 10" required>
                <input name="importe" type="number" class="input indata" placeholder="Importe: 1200.00" required step="0.01" mx="9999999999.99">
            </div>
            <div class="footer">
                <input type="submit" name="login" value="Generar XML" class="button"/>
            </div>
        </form>
        <!--input type="submit" name="generar" action="generarxml.php" value="Generar XML" class="generate" /-->
    </body>
</html>
<?php
}
?>