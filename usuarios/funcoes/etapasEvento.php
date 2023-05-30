<?php



$query_busca_Pedido = "SELECT *,  FROM payments_picpays WHERE payments_picpays.email = $emailUsuario";
$pedido_selecionado = $conn->prepare($query_busca_Pedido);
$pedido_selecionado->execute();

if(($pedido_selecionado) AND ($pedido_selecionado->rowCount() != 0) ){
    $row_Pedido = $pedido_selecionado->fetch(PDO::FETCH_ASSOC);

    $etapa = $row_Pedido['payments_statu_Id'];
    $data = $row_Pedido['dataagendada'];

    if($etapa == 5){
        echo "Eeeeetapa: ".$etapa;
    }

}else {
    header("Location: ../index.php");
    exit();
}

?>