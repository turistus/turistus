<?php

$query_busca_Pedido = "SELECT *, email, dataagendada, payments_statu_Id FROM payments_picpays WHERE payments_picpays.email = '$emailUsuario'" ;
$pedido_selecionado = $conn->prepare($query_busca_Pedido);
$pedido_selecionado->execute();


if(($pedido_selecionado) AND ($pedido_selecionado->rowCount() != 0) ){

    while ($row_Pedido = $pedido_selecionado->fetch(PDO::FETCH_ASSOC)) {
    extract($row_Pedido);
    ?>

    <div class="container" style="display:inline;">
        <h6>Pedido #<?php echo $row_Pedido['id']; ?></h6>
        <h6>Data Agendada: <?php echo $row_Pedido['dataagendada']; ?></h6>
        <h6>Etapa #<?php echo $row_Pedido['payments_statu_Id']; ?></h6>
        <hr>

    </div>
<?php
         }


    }else {
        echo "ENTROU NO ELSE";
        header("Location: ../index.php");
        exit();
    }

?>

