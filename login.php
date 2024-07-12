<?php
session_start();

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
    
    $result = consultar($connection, $dataBase, $query);
    $count = 0;
    while (mysqli_fetch_object($result)) {
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
?>