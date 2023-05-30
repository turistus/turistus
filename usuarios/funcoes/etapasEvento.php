<?php

$query_busca_Pedido = "SELECT *, email, dataagendada, payments_statu_Id FROM payments_picpays WHERE payments_picpays.email = '$emailUsuario'" ;
$pedido_selecionado = $conn->prepare($query_busca_Pedido);
$pedido_selecionado->execute();


if(($pedido_selecionado) AND ($pedido_selecionado->rowCount() != 0) ){

    while ($row_Pedido = $pedido_selecionado->fetch(PDO::FETCH_ASSOC)) {
    extract($row_Pedido);
    ?>

    <div class="col-12" style="display:inline;">
        <h6>Pedido #<?php echo $row_Pedido['id']; ?>
        Data Agendada: <?php echo date('d/m/Y',  strtotime($row_Pedido['dataagendada'])); ?>
        <br>
        Etapa #<?php echo $row_Pedido['payments_statu_Id']; ?>
        <?php if($row_Pedido['confirmado'] == 1){echo "<p style='background:green;'>Evento Confirmado </p>"; }else{ echo "Aguarde o guia aceitar !"; }; ?></h6>
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

