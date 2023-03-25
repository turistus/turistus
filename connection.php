<?php

if(!defined('ACCESS')){
    header("Location: /");
    die("Erro: Pagina nao encontrada!<br>");
}

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "empresa";
$port = 3306;

/*

$host = "mysql743.umbler.com";
$user = "turismo2021";
$pass = "turismo123";
$dbname = "bdtur";

*/

try {



 	//$conn = new PDO("mysql:host=$host;dbname=" . $dbname, $user, $pass);

    $conn = new PDO("mysql:host=$host;port=$port;dbname=" . $dbname, $user, $pass);
    $conex = mysqli_connect($host, $user, $pass, $dbname);


    //$conn = mysqli_connect($host, $user, $pass, $dbname);
    //echo "OK BD ";
    //echo "Conexão com banco de dados realizado com sucesso!<br>";
} catch (Exception $ex) {
    //echo "Erro: Conexão com banco de dados não realizada com sucesso.<br>";
    die("Erro: connectionn Por favor tente novamente. Caso o problema persista, entre em contato o administrador: <br>");
}

