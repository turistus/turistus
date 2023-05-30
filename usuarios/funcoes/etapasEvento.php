<?php

$query_busca_Pedido = "SELECT *, email, dataagendada, payments_statu_Id FROM payments_picpays WHERE payments_picpays.email = $emailUsuario" ;
$pedido_selecionado = $conn->prepare($query_busca_Pedido);
$pedido_selecionado->execute();

echo  "etapaaa: " . $dataagendada;
if(($pedido_selecionado) AND ($pedido_selecionado->rowCount() != 0) ){
    $row_Pedido = $pedido_selecionado->fetch(PDO::FETCH_ASSOC);

            echo "Eeeeetapa: ".$row_Pedido['payments_statu_Id'];


    }else {
        echo "ENTROU NO ELSE";
        header("Location: ../index.php");
        exit();
    }

echo "Passou por fora do IF";

?>


<div class="container" style="display:inline;">
    <h2>Pedido #<?php echo $row_Pedido['id']; ?></h2>
    <h2>Data Agendada: <?php echo $row_Pedido['dataagendada']; ?></h2>
    <h2>Etapa #<?php echo $row_Pedido['payments_statu_Id']; ?></h2>

</div>