
<!--  O K PAGINA ESTA Funcional apresentando apenas os EVENTOs do GUIA LOGADO -->
<?php

//echo $_SESSION['user_id'];
$Uid = filter_input(INPUT_GET, "idguia", FILTER_SANITIZE_NUMBER_INT);

?>

<!-- Primeira LINHA Principal CONTEINER -->
<main class="container">
    <div class="shadow-lg p-3 mb-5 bg-white rounded"  >
        <div class="row">

<div class="row">

      <div class="col-md-8">
        <!-- Aqui Busca os eventos criado pelo Guia -->
        <?php
        $query_products = "SELECT *,
        eventos.id AS id,
        eventos.nome AS nome,
        eventos.valor AS valor,
        eventos.idGuia AS idGuia,

        idPt,
        datah,

        pontosturisticos.id AS pontoId,
        pontosturisticos.image AS img,

        servicos.id AS IDdoGUIA


        FROM eventos INNER JOIN pontosturisticos ON pontosturisticos.id = eventos.idPt
        INNER JOIN servicos ON servicos.id = eventos.idGuia WHERE eventos.idGuia = $Uid ORDER BY eventos.id DESC";

        $result_products = $conn->prepare($query_products);
        $result_products->execute();
        ?>
        <div class="row row-cols-1 row-cols-md-1">
          <?php
          while ($row_product = $result_products->fetch(PDO::FETCH_ASSOC)) {
            extract($row_product);
          ?>
            <div class="mb-2 text-center" >
              <div class="card">
                  <div class="card-body" style="padding: 10px;">
                  <a href="../../pg/view-evento.php?id=<?php echo $id?>" class="btn btn text-dark">
                    <img style="height: 100px; width: 180px; " src= <?php echo "'../images/pontosturisticos/$idPt/$img";?>'>
                  </a><br><br>
                    <h5 class="card-title"><?php echo $nome;  ?></h5>



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
        </div>
    </div>
  </main>