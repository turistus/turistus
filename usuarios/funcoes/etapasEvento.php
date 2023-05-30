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
        Status do pedido <?php if($row_Pedido['payments_statu_Id'] == 1){
            echo "<p style='background:#4169E1;'> 1 - Pedido Gerado !</p> ";

         } elseif($row_Pedido['payments_statu_Id'] == 2){
            echo "<p style='background:#4169E1;'> 2 - Aguardando Pagamento !</p> ";


         }
         elseif($row_Pedido['payments_statu_Id'] == 3){

            echo "<p style='background:red;'> 3 - Cancelado ! </p>";


         }
         elseif($row_Pedido['payments_statu_Id'] == 4){

            echo "<p style='background:#4169E1;'> 4 - Pagamento em Analise !</p>";


         }
         elseif($row_Pedido['payments_statu_Id'] == 5){

            echo "<p style='background:#228B22;'> 5 - Pago !</p>";


         }
         elseif($row_Pedido['payments_statu_Id'] == 6){

            echo "<p style='background:#228B22;'> 6 - Aguarde confirmaçao do guia !</p>";


         }
         elseif($row_Pedido['payments_statu_Id'] == 7){

            echo "<p style='background:orange;'> 7 - Pagamento Estornado !</p>";

         }?>
        <?php if($row_Pedido['confirmado'] == 1){echo "<p style='background:green;'> Pedido Confirmado </p>"; }; ?></h6>
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

