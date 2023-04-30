<?php
define('ACCESS', true);
include_once '../connection.php';

//Receber os dados do formulário
$dados_CadEvento = filter_input_array(INPUT_POST, FILTER_DEFAULT);
var_dump($dados_CadEvento."VAAAR");
echo $dados_CadEvento;
$novaData = date("Y/m/d");
echo $novaData;
?>