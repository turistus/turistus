<?php

define('ACCESS', true);
include_once '../connection.php';
session_start();
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

//Editar a compra informado o status da compra no PicPay
$query_deletar_evento = "DELETE eventos SET eventos.id = $id";
$preparandoDelete = $conn->prepare($query_deletar_evento);
$preparandoDelete->execute();

echo "Deletado !";

?>