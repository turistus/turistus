<!-- ONDE BUSCA OS eventos TURISTICOS -->
<?php

$Uid = $_SESSION['user_id'];

?>


         <!-- ONDE BUSCA OS eventos TURISTICOS -->
         <div class="row" style="margin: 10px;">
                <!-- Titulo-->
                <div class="row" style="padding-left: 50px;  margin-bottom: 50px; background: url(../images/bussola.jpg) repeat-x top center;">
                        <h1 style="padding-top: 10px;">Pedidos Completos</h1>

                </div>
</br>
                <p> Seus pedidos realizados por turistas e seus comentarios </p>

             <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" style=" min-height: 50px;">
                  <?php
                        $query_products =
                        "SELECT
                        pay.id AS idagendado,
                            pay.first_name,
                            pay.phone AS celular,
                            pay.guiaId,
                            payments_statu_Id,
                            pay.product_id,
                            pay.last_name AS last_name,
                            phone,
                            pay.custoPedido AS valor,
                        eventos.id AS idE,
                            eventos.nome AS nE,
                            eventos.idPt AS idPt,

                            eventos.idGuia,
                        pontosturisticos.id,
                            pontosturisticos.image AS i
                        FROM payments_picpays AS pay

                            INNER JOIN eventos ON eventos.id = pay.product_id
                            INNER JOIN pontosturisticos ON pontosturisticos.id = eventos.idPt
                            INNER JOIN servicos ON servicos.id = pay.guiaId

                            WHERE pay.guiaId = $Uid AND pay.payments_statu_Id >= 5";

                         $result_products = $conn->prepare($query_products);
                         $result_products->execute();
                   ?>
                    <div class="row row-cols-12 row-cols-md-12">
                        <?php
                            while ($row_product = $result_products->fetch(PDO::FETCH_ASSOC)) {
                                extract($row_product);


                        ?>

                        <div class="col mb-2 text-center" >
                            <div class="card ">
                                <div class="card-body">
                                    <p>AG: <?php echo $idagendado; ?></p>
                                    <h6 class="card-title">Evento: <?php echo $idE; ?> Ponto: <?php echo $id; ?>
                                    Nome: <?php echo $nE; ?>
                                    R$ <?php echo number_format($valor, 2, ",", ".") ?>
                                    Turista: <?php echo $first_name ." ". $last_name ?>
                                    Contato: <?php echo $phone ?>
                                </h6>

                                    <a href="#" class="btn btn text-dark " style="border: 1px solid green;">Ver comentarios</a>
                                    <!-- Ao clicar Confirmar, o GUIA lança uma movimentação para
                                     OUTRA tabela guardando que foi confirmado esse Agendamento do turista,
                                    para eu enviar o email ao turista com o PDF de ingresso.  -->

                                </div>
                            </div>
                        </div>
                                                    <?php
                                                    }
                                                    ?>
                 </div>
             </div>
         </div>
             <!-- FINAL ONDE BUSCA OS eventoS -->
