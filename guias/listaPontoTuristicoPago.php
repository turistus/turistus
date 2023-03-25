<!-- ONDE BUSCA OS PONTOS TURISTICOS JA PAGOS. no Valor do GUIA as Informações sobre. -->
<?php

$Uid = $_SESSION['user_id'];
?>
        

         <!-- ONDE BUSCA OS PONTOS TURISTICOS -->
         <div class="row" style="margin: 10px;">
                <!-- Titulo-->
                <div class="row" style="padding-left: 50px;  margin-bottom: 50px; background: url(../images/bussola.jpg) repeat-x top center;">
                    <div class="col-12">
                        <h1 style="padding-top: 10px;">Lista Pontos criados</h1>
                    </div>
                </div>

             <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" style=" min-height: 50px;">
                  <?php
                     $query_products = "SELECT *, 

                         pontosturisticos.id AS idpt,
                         pontosturisticos.image AS i,
                         pontosturisticos.name AS nE,
                         servicos.id,
                         servicos.valor AS valor,
                         pontosturisticos.idGuia,
                         pontosturisticos.price
          
                           FROM pontosturisticos INNER JOIN servicos ON pontosturisticos.idGuia = servicos.id

                           WHERE pontosturisticos.idGuia = $Uid  ";

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
                                                                
                                   
                                    <p class="card-title">PT <?php echo $idpt; ?></p>
                                    <h3 class="card-title"><?php echo $nE; ?></h3>
                                    <h4 class="card-title">
                                        <?php echo "<img style='max-height: 125px; max-width: 260px;' src='../images/pontosturisticos/$idpt/$i'><br>";?>
                                    </h4>
                                    <h5 class="card-title">R$ <?php echo number_format($valor, 2, ",", ".") ?></h5>
                                    <h5 class="card-title"><?php echo date('d/m/Y',  strtotime($created)); ?></h5><br>
                                                                
                                    <a href="#" class="btn btn-primary">Editar</a>
                                    <h3 class="card-title">N¹ compras</h3>
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
