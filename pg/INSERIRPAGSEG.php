
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">

        <title>TESTE INSERIR</title>
    </head>
    <body>
        <h1> Testando um insert a</h1>


<?php
define('ACCESS', true);

include("../connection.php");


$titulo = "ALOHA";
$idEv = 0545;
$descricao ="ALoha é Familia";
$custoEvento = 10.80;
$idGuia = 01;


$query_pa = "INSERT INTO payments_pagSeg (titulo, idEv, descricao, custoEvento, idGuia, dataGerada)
                                VALUES ($titulo, $idEv, $descricao, $custoEvento, $idGuia, '0000-00-00')";
$add_pagSeg = $conn->prepare($query_pa);
$add_pagSeg->execute();
// FIM DA INSERT EM PAYMENTS PICPAY
echo "ok CHEGOU AQUI DPS DO INSERT";

?>




    </body>
</html>
