<?php
//<!--  O K PAGINA ESTA Funcional apresentando apenas os EVENTOs do GUIA LOGADO -->
//echo $_SESSION['user_id'];
$Uid = $_SESSION['user_id'];

?>

<!-- Primeira LINHA Principal CONTEINER -->
<main class="container">
    <div class="shadow-lg p-3 mb-5 bg-white rounded"  >
        <div class="row">

    <div class="row">
        <!-- Titulo-->
        <div class="row" style=" padding-left: 50px;  margin-bottom: 50px; background: url(../images/bussola.jpg) repeat-x top center;">
            <div class="col-12">
              <h1 style="padding-top: 10px; ">Eventos Criados</h1>
            </div>
        </div>
      <div class="col-md-12">
        <!-- Aqui Busca os eventos criado pelo Guia -->
        <?php
        $query_products = "SELECT *,
        eventos.id AS id,
        eventos.nome AS nome,
        eventos.valor AS valor,
        eventos.idGuia AS idGuia,

        idPt,
        dataUp,

        pontosturisticos.id AS pontoId,
        pontosturisticos.image AS img,

        servicos.id AS IDdoGUIA


        FROM eventos INNER JOIN pontosturisticos ON pontosturisticos.id = eventos.idPt
        INNER JOIN servicos ON servicos.id = eventos.idGuia WHERE eventos.idGuia = $Uid ORDER BY eventos.id DESC";

        $result_products = $conn->prepare($query_products);
        $result_products->execute();
        ?>
        <div class="row row-cols-1 row-cols-md-3">
          <?php
          while ($row_product = $result_products->fetch(PDO::FETCH_ASSOC)) {
            extract($row_product);
          ?>
            <div class="col mb-2 text-center">
              <div class="card">
                  <div class="card-body" style="padding: 15px;">
                    <img style="height: 100px; width: 180px; " src= <?php echo "'../images/pontosturisticos/$idPt/$img";?>'><br><br>
                    <h5 class="card-title"><?php echo $nome;  ?></h5>
                    <h5 class="card-title">R$ <?php echo number_format($valor, 2, ",", ".") ?></h5>
                    <h5 class="card-title"><?php echo date('d/m/Y',  strtotime($dataUp)); ?></h5><br>
                    <a href="../processaEditarEvento.php?id=<?php echo $id?>" id="editar" class="btn btn-primary" > Editar </a>

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






