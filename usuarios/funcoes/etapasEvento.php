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

        Etapa #<?php if($row_Pedido['payments_statu_Id'] == 1){
            echo " 1";
         } elseif($row_Pedido['payments_statu_Id'] == 2){
            echo "Pague o evento";
         }
         elseif($row_Pedido['payments_statu_Id'] == 3){
            echo "Cancelado";
         }
         elseif($row_Pedido['payments_statu_Id'] == 4){
            echo "Pagamento em Analise !";
         }
         elseif($row_Pedido['payments_statu_Id'] == 5){
            echo "Pago !";
         }
         elseif($row_Pedido['payments_statu_Id'] == 6){
            echo "Pago, Aguarde confirmaçao do guia";
         }
         elseif($row_Pedido['payments_statu_Id'] == 7){
            echo "Estornado o pagamento";
         }?>
        <?php if($row_Pedido['confirmado'] == 1){echo "<p style='background:green;'>Evento Confirmado </p>"; }else{ echo " e aguarde confirmação !"; }; ?></h6>
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

