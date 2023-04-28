
<!--  O K PAGINA ESTA Funcional apresentando apenas os EVENTOs do GUIA LOGADO -->
<?php

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
        datah,

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
                    <h5 class="card-title"><?php echo date('d/m/Y',  strtotime($datah)); ?></h5><br>
                    <a href="../guias/processaEditarEvento.php?id=<?php echo $id?>" class="btn btn text-dark" id='primeiroForm'> Editar </a>

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

                        <div class="modal-content" id=formPrimeiro style="padding: 10px;">
                          <?php
                            include_once '../guias/processaEditarEvento.php';
                          ?>
                      </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    $("#formPrimeiro").hide();

  $("#primeiroForm").click(function () {
    $("#formPrimeiro").show(1000);
	});

  });

</script>
</main>






