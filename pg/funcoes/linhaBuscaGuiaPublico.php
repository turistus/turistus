 <!-- ONDE BUSCA OS Guias TURISTICOS -->
 <div class="row">
      <div class="col-md-12">
        <?php
        $query_products = "SELECT *, id AS idProfi, image FROM servicos ORDER BY id Limit 4";
        $result_products = $conn->prepare($query_products);
        $result_products->execute();
        ?>
        <div class="row row-cols-1 row-cols-md-4">
          <?php
          while ($row_product = $result_products->fetch(PDO::FETCH_ASSOC)) {
            extract($row_product);

          ?>
            <div class="col mb-4 text-center">

              <div class="card" style="padding: 20px; text-align: center; background-color: #f1f1f3;">
                <div class="row " style="height:60px; ">
                  <div class="col-12 text-center">
                  <h5 class="card-title" style=" margin-bottom: 12px;  "><?php echo $nome; ?></h5>
                  </div>
                </div>

                <a href="./guias/perfilG.php?idguia=<?php echo $idProfi?>"> <img style="height: 140px; max-height: 200px; max-width: 400px; margin:auto; border:1px solid green; box-shadow: 3px 2px 5px black;" src='<?php echo "./images/guias/$id/$image"; ?>' class="card-img-top" alt="..."></a>

              </div>

            </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>