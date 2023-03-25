                                  <div class="conteiner" style="border-top: 4px solid red; margin: auto;">
                                    <h2>Pontos Liberados</h2>
                        
                                    <!-- ONDE BUSCA OS eventos TURISTICOS -->
                                      <div class="row">
                                        <div class="col-md-12">
                                          <?php
                                          $query_products = 
                                          "SELECT *,
                                                        pontosturisticos.id AS id,
                                                          pontosturisticos.image as i,
                                                            pontosturisticos.name as nPt,
                                                                    servicos.nome as nomeGuia,
                                                                        servicos.celular AS celularG,
                                                                          payments_picpays.payments_statu_Id
                                                                    
                                          FROM 
                          
                                          payments_picpays
                                          
                                          INNER JOIN 
                                                      ( pontosturisticos, servicos ) ON 
                                          payments_picpays.product_id = pontosturisticos.id AND
                                          payments_picpays.guiaId = servicos.id
                                          WHERE payments_picpays.email = '$email'  
                                          AND payments_picpays.payments_statu_Id = '5' ORDER BY payments_picpays.payments_statu_Id ASC ";

                                          $result_products = $conn->prepare($query_products);
                                          $result_products->execute();
                                          ?>
                                                  <div class="row row-cols-1 row-cols-md-3">
                                                      <?php
                                                        while ($row_product = $result_products->fetch(PDO::FETCH_ASSOC)) {
                                                        extract($row_product);
                                                      ?>
                                                      <div class="col mb-4 text-center" >
                                                        <div class="card ">
                                                            <div class="card-body">
                                                            <h5 class="card-title"><?php echo $id; ?></h5>
                                                            <h4 class="card-title" ><?php echo "<img style='max-height: 175px; max-width: 260px;' src='../images/pontosturisticos/$id/$i'><br>";?></h4>
                                                            <h4 class="card-title" style="color: white; background-color: #F04B35; padding: 15px;"> Ponto: <?php echo $nPt; ?></h4>
                                                            <h4 class="card-title" style="background-color: black; color: white; padding: 10px; border-radius: 5px;"> Nome do Guia: <?php echo $nomeGuia;?></h4>
                                                            <h4>Contato: <?php echo $celularG="(".substr($celularG,0,2).") ".substr($celularG,2,-4)." - ".substr($celularG,-4);?></h4>
                                                            
                                                          
                                                            <p>  </p>
                                                            
                                                            <a href="usuarios/detalhesAgendado.php?id=<?php echo $id; ?>" class="btn btn-primary">Detalhes</a>

                                                          </div>
                                                        </div>
                                                      </div>
                                                        <?php
                                                        }
                                                        ?>
                                                  </div>
                                        </div>
                                    </div>
                                  </div><!-- FINAL ONDE BUSCA OS pontos LIBERADOS -->