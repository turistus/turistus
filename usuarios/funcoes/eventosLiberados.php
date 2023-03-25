<?php

$email = $_SESSION['user_email'];
?>
                                <div class="conteiner" style="border-top: 4px solid green; margin: auto; padding:20px;">
                                    <h2> Eventos Liberados </h2>

                                    <!-- ONDE BUSCA OS eventos TURISTICOS -->
                                      <div class="row">
                                        <div class="col-12">
                                          <?php
                                          $query_products =
                                          "SELECT *, eventos.nome as nE,
                                                      eventos.id as id,
                                                        eventos.idPt as idPt,
                                                          pontosturisticos.image as i,
                                                            pontosturisticos.name as nPt,
                                                                    servicos.nome as nomeGuia,
                                                                      payments_picpays.id as idPag

                                          FROM

                                            eventos

                                          INNER JOIN
                                                      ( pontosturisticos, payments_picpays, servicos ) ON
                                          eventos.idPt = pontosturisticos.id AND
                                          payments_picpays.product_id = eventos.id AND
                                          payments_picpays.guiaId = servicos.id
                                          WHERE payments_picpays.email = '$email'
                                          AND payments_picpays.payments_statu_Id = '5'";

                                          $result_products = $conn->prepare($query_products);
                                          $result_products->execute();
                                          ?>
                                                  <div class="row row-cols-1 row-cols-md-12">
                                                      <?php
                                                        while ($row_product = $result_products->fetch(PDO::FETCH_ASSOC)) {
                                                        extract($row_product);
                                                      ?>
                                                      <div class="text-center" >
                                                        <div class="">
                                                            <div class="card-body pl-1">
                                                            <h5 class="card-title">Nº <?php echo $idPag; ?></h5>
                                                            <h4 class="card-title" ><?php echo "<img style='max-height: 120px; max-width: 180px;' src='../images/pontosturisticos/$idPt/$i'><br>";?></h4>
                                                            <h3 class="card-title" style="background-color: black; color: white; border-radius: 5px;"> Evento: <?php echo $nE; ?></h3>
                                                              <div class="card" style="background-color: #F04B35; padding: 15px;" >
                                                                <h4 class="card-title" style="color: white;"> Ponto Turistico: <?php echo $nPt; ?></h4>


                                                              </div>
                                                            <h4 class="card-title" style="background-color: black; color: white;"> Nome do Guia: <?php echo $nomeGuia;?></h4>
                                                            <h4>Contato: <?php echo $celular="(".substr($celular,0,2).") ".substr($celular,2,-4)." - ".substr($celular,-4);?></h4>


                                                            <p>  </p>

                                                            <a href="./funcoes/avaliarEvento.php?id=<?php echo $id; ?>" class="btn btn-success">Avaliar</a>

                                                          </div>
                                                        </div>
                                                        <hr>
                                                      </div>
                                                        <?php
                                                        }
                                                        ?>
                                                  </div>
                                        </div>
                                    </div>
                                  </div><!-- FINAL ONDE BUSCA OS eventoS -->