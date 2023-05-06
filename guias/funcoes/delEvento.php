<?php

define('ACCESS', true);
include_once '../../connection.php';

$id = $_GET['id'];
echo "VE" . $id;
//Editar a compra informado o status da compra no PicPay
$query_deletar_evento = "DELETE FROM eventos WHERE eventos.id = $id";
$preparandoDelete = $conn->prepare($query_deletar_evento);
$preparandoDelete->execute();

echo "Deletado !";
header("Location: ../painelGuia.php");

?>