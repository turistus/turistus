<!-- ONDE BUSCA OS eventos TURISTICOS -->
<?php

$Uid = $_SESSION['user_id'];

?>


         <!-- ONDE BUSCA OS eventos TURISTICOS -->
         <div class="row" style="margin: 10px;">
                <!-- Titulo-->
                <div class="row" style="padding-left: 50px;  margin-bottom: 50px; background: url(../images/bussola.jpg) repeat-x top center;">
                    <div class="col-12">
                        <h1 style="padding-top: 10px;">Pedidos Completos</h1>


                    </div>
                </div>

                <p>Seus pedidos são realizados por turistas e seus comentarios</p>

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
                        eventos.id AS idE,
                            eventos.nome AS nE,
                            eventos.idPt AS idPt,
                            eventos.valor AS valor,
                            eventos.idGuia,
                        pontosturisticos.id,
                            pontosturisticos.image AS i
                        FROM payments_picpays AS pay

                            INNER JOIN eventos ON eventos.id = pay.product_id
                            INNER JOIN pontosturisticos ON pontosturisticos.id = eventos.idPt
                            INNER JOIN servicos ON servicos.id = pay.guiaId

                            WHERE pay.guiaId = $Uid AND payments_statu_Id >= '5'";

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
                                    <h5 class="card-title">E 000<?php echo $idE; ?> <?php echo $id; ?></h5>


                                    <h4 class="card-title">
                                        <?php echo "<img style='max-height: 125px; max-width: 260px;' src='../images/pontosturisticos/$idPt/$i'><br>";?>
                                    </h4>
                                    <h3 class="card-title"><?php echo $nE; ?></h3>
                                    <h5 class="card-title">R$ <?php echo number_format($valor, 2, ",", ".") ?></h5>
                                    <h5 class="card-title"><?php echo $first_name ." ". $last_name ?></h5>
                                    <h5 class="card-title"><?php echo $phone ?></h5>
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
