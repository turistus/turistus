<?php
session_start();
    include_once 'credenciais.php';

    $nE = $_COOKIE['titulo'];
    $custoEvento = $_COOKIE['custoEvento'];
    $descricao = $_COOKIE['descricao'];
    $lid = $_COOKIE['last_insert_id'];
    $idEv = $_COOKIE['id'];



$Data["email"]=EMAIL_PAGSEGURO;
$Data["token"]=TOKEN_PAGSEGURO;
$Data["currency"]="BRL";
//tem que ter ID novo toda vez e CUSTO AMOUNT minimo 1.00 (um real)
$Data["itemId1"]=$lid;//Deve ser gerado um numero ID ao inserir no banco essa venda Agendada
$Data["itemDescription1"]=$nE;
$Data["itemAmount1"]=$custoEvento;
$Data["itemQuantity1"]="1";
$Data["itemWeight1"]="1000";
$Data["reference"]=$idEv;
$Data["senderName"]="João da Silva";
$Data["senderAreaCode"]="44";
$Data["senderPhone"]="99999999";
$Data["senderEmail"]="tanttantest@hotmail.com";
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