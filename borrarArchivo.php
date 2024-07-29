<?php
include_once "login.php";

$archivoBorrar = $_SESSION['archivoBorrar'];

if (file_exists($archivoBorrar) && is_file($archivoBorrar)) {
    unlink($archivoBorrar);
}

echo '<script language="javascript">alert("Se ha borrado el archivo procesado");</script>';
echo '<script language="javascript">window.location="newone.php";</script>';