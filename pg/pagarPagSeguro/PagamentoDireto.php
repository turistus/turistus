<?php
session_start();
    include_once 'credenciais.php';

    $nomeGuia = $_POST['nomeGuia'];
    $custoEvento = $_POST['custoEvento'];

$Data["email"]=EMAIL_PAGSEGURO;
$Data["token"]=TOKEN_PAGSEGURO;
$Data["currency"]="BRL";
//tem que ter ID novo toda vez e CUSTO AMOUNT minimo 1.00 (um real)
$Data["itemId1"]="1019";
$Data["itemDescription1"]="TURISMOOO";
$Data["itemAmount1"]="2.00";
$Data["itemQuantity1"]="1";
$Data["itemWeight1"]="1000";
$Data["reference"]="577";
$Data["senderName"]="João da Silva";
$Data["senderAreaCode"]="37";
$Data["senderPhone"]="99999999";
$Data["senderEmail"]="twomonkeys@hotmail.com";
$Data["shippingType"]="1";
$Data["shippingAddressStreet"]="Rua Antonieta";
$Data["shippingAddressNumber"]="10";
$Data["shippingAddressComplement"]="Casa";
$Data["shippingAddressDistrict"]="Jardim Paulistano";
$Data["shippingAddressPostalCode"]="30690090";
$Data["shippingAddressCity"]="Belo Horizonte";
$Data["shippingAddressState"]="MG";
$Data["shippingAddressCountry"]="BRA";

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