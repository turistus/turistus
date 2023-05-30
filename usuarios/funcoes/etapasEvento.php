<?php
echo "Email".$emailUsuario;



$query_busca_Pedido = "SELECT *, dataagendada, payments_statu_Id FROM payments_picpays WHERE payments_picpays.email = $emailUsuario";
$pedido_selecionado = $conn->prepare($query_busca_Pedido);
$pedido_selecionado->execute();

echo  "etapaaa: " . $payments_statu_Id;


?>