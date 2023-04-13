<?php
session_start();
include '../pagarPagSeguro/credenciais.php';
$idEvento = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

$Data["email"]=EMAIL_PAGSEGURO;
$Data["token"]=TOKEN_PAGSEGURO;
$Data["currency"]="BRL";
$Data["itemId1"]=$idEvento;
$Data["itemDescription1"]="WebsiteTURISMOOO";
$Data["itemAmount1"]=$valor_rise;
$Data["itemQuantity1"]="1";
$Data["itemWeight1"]="1000";
$Data["reference"]="0009";
$Data["senderName"]="João da Silva";
$Data["senderAreaCode"]="37";
$Data["senderPhone"]="99999999";
$Data["senderEmail"]=$emailSessaoAberta;


$BuildQuery=http_build_query($Data);
$Url="https://ws.sandbox.pagseguro.uol.com.br/v2/checkout";

$Curl=curl_init($Url);
curl_setopt($Curl,CURLOPT_HTTPHEADER,Array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
curl_setopt($Curl,CURLOPT_POST,true);
curl_setopt($Curl,CURLOPT_SSL_VERIFYPEER,true);
curl_setopt($Curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($Curl,CURLOPT_POSTFIELDS,$BuildQuery);
$Retorno=curl_exec($Curl);
curl_close($Curl);

$Xml=simplexml_load_string($Retorno);
echo $Xml->code;


?>