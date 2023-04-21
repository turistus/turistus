
<?php
define('ACCESS', true);

include("../connection.php");

$query_pa = "INSERT INTO payments_pagSeg (titulo, idEv, descricao, custoEvento, idGuia, dataGerada) VALUES ('ALOHA', 0545, 'ALoha é Familia', 10.80, 1, '0000-00-00')";
$add_pagSeg = $conn->prepare($query_pa);
$add_pagSeg->execute();
// FIM DA INSERT EM PAYMENTS PICPAY
echo "<h1> ok CHEGOU AQUI DPS DO INSERT </h1>";

?>
