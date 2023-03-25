

<!-- Primeira LINHA Principal CONTEINER -->
<main class="container">
    <div class="shadow-sm p-3 mb-5 bg-white rounded"  >
        <div class="row">

<div class="row">
        <!-- Titulo-->
        <div class="row" style=" padding-left: 20px;  margin-bottom: 10px; ">
            <div class="col-12">
            <h1 style="padding-top: 10px;">Eventos </h1>
            </div>
        </div>
      <div class="col-md-12 ">
        <!-- Aqui Busca os eventos criado pelo Guia -->
        <?php
        $query_products = "SELECT *,
        eventos.id AS idE, 
        eventos.nome AS nome, 
        eventos.valor AS valor, 
        eventos.idGuia AS idGuia,

        idPt, 
        datah,

        pontosturisticos.id,
        pontosturisticos.image AS img,

        servicos.id,
        servicos.nome AS nomeGuia

        
        FROM eventos INNER JOIN pontosturisticos ON pontosturisticos.id = eventos.idPt 
        INNER JOIN servicos ON servicos.id = eventos.idGuia WHERE pontosturisticos.id = $id ORDER BY $id DESC";

        $result_products = $conn->prepare($query_products);
        $result_products->execute();
        ?>
        <div class="row row-cols-1 row-cols-md-3">
          <?php
          while ($row_product = $result_products->fetch(PDO::FETCH_ASSOC)) {
            extract($row_product);
          ?>
            <div class="text-center" >
              <div class="card " >
              
              <a href="view-evento.php?id=<?php echo $idE;?>" class="btn ">
                <div class="card-body " style="padding: 10px;  ">
                  <img style="height: 80px; width: 100px; " src= <?php echo "'../images/pontosturisticos/$idPt/$img";?>'><br>
                    <h6 class="card-title"><?php echo $nome; ?></h6>
                    <p class="card-title">R$ <?php echo number_format($valor, 2, ",", ".") ?></p>
                    <p class="card-title"><?php echo $nomeGuia; ?></p>
                    

                </div>
              </a>

              </div>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
    <!-- FINAL ONDE BUSCA OS eventoS -->
        </div>
    </div>
  </main>