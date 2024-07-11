<!DOCTYPE html>

<html lang="MX-es">
    <head>
        <meta charset="utf-8"/>
        <title>Pedidos de Venta</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
    </head>
</html>

<?php
session_start();

init();

function conectar() {
    $serverDB = "localhost";
    $userDB = "root";
    $passwordDB = "";
    return mysqli_connect($serverDB, $userDB, $passwordDB);
}

//Ejecutar consulta
function consultar($connection, $dataBase, $query){
    mysqli_select_db($connection, $dataBase);
    return mysqli_query($connection, $query);
}

//Verificar login
function verificar_login($user, $password) {
    $connection = conectar();
    
    $dataBase = "hersheyB2B";
    $query = "SELECT * FROM usuarios WHERE usuario = '$user' AND clave = '$password'";
    
    $rec = consultar($connection, $dataBase, $query);
    $count = 0;
    while ($row = mysqli_fetch_object($rec)) {
        $count++;
    }
    
    if ($count == 1) {
        return 1;
    } else {
        return 0;
    }
}

//Extraer registro
function extraer_registro($user, $password) {
    $connection = conectar();
    
    $dataBase = "hersheyB2B";
    $query = "SELECT * FROM usuarios WHERE usuario = '$user' AND clave = '$password'";
    
    return mysqli_fetch_array(consultar($connection, $dataBase, $query));
}

function iniciar_sesion($result){
    $_SESSION['idusuario'] = $result['idusuario'];
    $_SESSION['usuario'] = $result['usuario'];
    $_SESSION['clave'] = $result['clave'];
}

function init (){
    if (loggeado()) {
        header("location:pedidos.php");
    }else{
        interfazLogin();
    }
}

function loggeado(){
    //Verificar el loggin
    if (!isset($_SESSION['idusuario'])) {
        if (isset($_POST['login'])) {
            $user = $_POST['user'];
            $password = $_POST['password'];
            if (verificar_login($user, $password) == 1) {
                $result = extraer_registro($user, $password);
                iniciar_sesion($result);
                return true;
            }else{
                echo '<script language="javascript">alert("Su usuario es incorrecto, intente nuevamente.");</script>';
            }
        }else{
            return false;
        }
    }else{
        return true;
    }
}

function interfazLogin(){
?>
    <div id="wrapper">
        <form name="login-form" class="login-form" action="index.php" method="post">
            <div class="header">
                <br><h1>Inicio de Sesión</h1>
                <span>Favor de ingresar tu usuario y contraseña.<br></span>
            </div>
            
            <div class="content">
                <input name="user" type="text" class="input user" placeholder="Nombre de usuario" required/>
                <div class="user-icon"></div>
                <input name="password" type="password" class="input password" placeholder="Contraseña" required/>
                <div class="pass-icon"></div>
            </div>
            
            <div class="footer">
                <input type="submit" name="login" value="Ingresar" class="button"/>
            </div>
        </form>
    </div>
<?php
}
/*
    //Conexion a BD
    $connection = $connectionBD;
    
    if (!$connection) {
        die('No se ha podido conectar a la base de datos: ' . mysqli_error());
    }else{
        echo "Conexión a bases de datos creada";
    }
    
    //Seleccionar la BD
    
    $dataBase = "b2b";
    
    mysqli_select_db($connection, $dataBase);
    
    $query = "SELECT * FROM oc";
    $result = mysqli_query($connection, $query);
    
    //Creamos el objecto del elemento de SimpleXML que vimos anteriormente.
    
    $xml = new SimpleXMLElement('<xml/>');
    
    //Sugerencia de creacion
    //Añadimos el valor de cada columna del nodo de XML que vamos a crear.
    while($row = mysqli_fetch_assoc($result)) {
        $dato = $xml->addChild('dato');
        $dato->addChild('OC',$row['id_oc']);
        $dato->addChild('Proveedor',$row['proveedor']);
        $dato->addChild('Producto',$row['producto']);
        $dato->addChild('Descripcion',$row['descproducto']);
        $dato->addChild('Cantidad',$row['cantidad']);
        $dato->addChild('FechaEntrega',$row['fechaentrega']);
        $dato->addChild('Precio',$row['precio']);
    }
    
    //Cerrar conexión
    mysqli_close($connection);

    //Validar directorio, y crear en caso que no exista
    $directory = "data";
    if (!is_dir($directory)) {
        mkdir($directory, 0755, true);
    }
    
    //Ruta completa del archivo
    $filePath = $directory . "/employeeData.xml";
    
    //Crear el archivo XML
    $fileOpen = fopen("employeeData.xml","wb");
    
    //Escribimos el XML con sus nodos
    fwrite($fileOpen,$xml->asXML());
    
    // - - - - - - -
    
    //Variables – Nota – hacer una prueba primero en localhost.
    $ftp_server = "127.0.0.1"; // Datos de X10 Hosting
    $ftp_user_name = "<username>"; // Usuario X10 Hosting
    $ftp_user_pass = "<password>"; // // Usuario X10 Hosting
    
    //Carpeta destino en X10
    $destination_file = "ruta/enservidor/remoto/archivo.zip"; 
    
    //Xml creado
    $source_file = "oc.xml";
     
    //conexión
    $conn_id = ftp_connect($ftp_server);
     
    //Login
    $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
     
    //Conexión
    if ((!$conn_id) || (!$login_result)) {
           echo "Conexión al FTP con errores!";
           echo "Intentando conectar a $ftp_server for user $ftp_user_name";
           exit;
       } else {
           echo "Conectado a $ftp_server, for user $ftp_user_name";
       }
     
    //Archivo a enviar --- en realidad es una subida al Server con el comando Put.
    $upload = ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY);
     
    //Estado de envio
    if (!$upload) {
        echo "Error al subir el archivo!";
    } else {
        echo "Archivo $source_file se ha subido exitosamente a $ftp_server en $destination_file";
    }
     
    //Cerramos la conexión.
    ftp_close($conn_id);
    
    // - - - - - - -
    
    //Cierra el archivo XML
    fclose($fileOpen);
    // incluir codigo para enviar por ftp el xml creado, revisar el archivo “FTP con PHP”
    // Enviarlo a la carpeta Out.

    */
?>