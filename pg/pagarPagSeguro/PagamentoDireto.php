<?php

    include_once 'credenciais.php';


$Data["email"]="desconectaprincipal@hotmail.com";
$Data["token"]=TOKEN_PAGSEGURO;
$Data["currency"]="BRL";
$Data["itemId1"]="101";
$Data["itemDescription1"]="Website TURISMOOO";
$Data["itemAmount1"]="100";
$Data["itemQuantity1"]="1";
$Data["itemWeight1"]="1000";
$Data["reference"]="565656";
$Data["senderName"]="João da Silva";
$Data["senderAreaCode"]="37";
$Data["senderPhone"]="99999999";
$Data["senderEmail"]="c67684333726812232825@sandbox.pagseguro.com.br";
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