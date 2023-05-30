<?php
echo "Email".$emailUsuario;



$query_busca_Pedido = "SELECT *, dataagendada, payments_statu_Id FROM payments_picpays WHERE payments_picpays.email = $emailUsuario";
$pedido_selecionado = $conn->prepare($query_busca_Pedido);
$pedido_selecionado->execute();

echo  "etapaaa: " . $payments_statu_Id;

if(($pedido_selecionado) AND ($pedido_selecionado->rowCount() != 0) ){
    $row_Pedido = $pedido_selecionado->fetch(PDO::FETCH_ASSOC);

    $data = $row_Pedido['dataagendada'];

    if($row_Pedido['payments_statu_Id'] === 5){
        echo "Eeeeetapa: ".$row_Pedido['payments_statu_Id'];
    }

}else {
    header("Location: ../index.php");
    exit();
}

?>