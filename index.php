<?php
//session_start();
define('ACCESS', true);
include_once './connection.php';

ob_start();


?>
<!DOCTYPE html>
<html lang="pt/br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" >
  <link rel="icon" href="images/icon/logo.png">
  <link href='https://fonts.googleapis.com/css?family=EB Garamond' rel='stylesheet'>
  <title>Turist Us</title>

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .rotated {
  transform: rotate(-5deg); /* Equal to rotateZ(45deg) */
  background-color: #008B8B;
}

  </style>


  <!-- Custom styles for this template -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Amiri:wght@400;700&amp;display=swap" rel="stylesheet"> -->
  <!-- Custom styles for this template -->

</head>

<body style="font-family: 'EB Garamond';font-size: 20px;">

  <?php
  include_once 'menuprincipal.php';
  ?>


  <main class="content" style="  padding-top:20px; padding-left: 20px; padding-right: 20px; background-color:#f1f1f3; opacity: .9;">


    <div class="p-4 p-md-5 mb-4 text-white rounded " style="background-image: url(./images/praiaagua.jpg); margin-bottom: 10px;">
      <div class="col-md-12 px-0" style="background-color: #3fe3; ">

          <h1 class="display-4" style="padding: 15px;" > Marketplace Turístico</h1>

          <p id="texto-lento" class="lead my-2" style="padding: 15px;" >

          <br> </p>
          <p class="lead mb-0"><a href="./pg/sobre.php" class="text-white fw-bold" style="padding: 15px;" >Saiba mais</a></p>

          <h3 style="text-align: right; color:black;"><b>Turistus</b></h3><p style="text-align: right; color:white;"> <b> Seu guia de viagem online. </b></p>
        </div>

    </div>


  <div class="row" >
  <!-- Sempre usar conteiner-->


      <!-- Primeiro Gad..wae de CADASTRO DE GUIA AVALIADO -->
        <div class="col-md-6" style="padding-left: 20px;">
          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-400 position-relative"
                  style="margin-bottom: 50px; height: auto; ">

          <div class="col p-4 d-flex flex-column position-static" >
                  <h3 class="mb-0"> Divulgue Atividades </h3>
              <div class="mb-1 text-muted">Somente para maiores de 18 anos devidamente avaliados. </div>






              <p class="card-text mb-auto"> Crie aqui anúncios de seus serviços e atividades turisticas e conquiste mais vendas para o seu negocio. </p>
              <a href="./guias/cadastrarguia.php" class="btn btn-outline-primary"> + Publicar </a>
              </div>

            <div class="col-auto d-none d-lg-block">
              <div class="col-md-12 margin-top ">
                <img src='<?php echo "./images/lagoaLaranja.jpg"; ?>' class="card-img-top" alt="..." style="margin-bottom: 50px;">
              </div>
            </div>



          </div>
        </div>




  <div class="col-md-6">

      <!-- Segundoo GAD..wea de Cadastro ou solicitação de PONTO TURISTICO -->
        <div class="col-md-12">
          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-400 position-relative " style="margin-bottom: 50px; min-height: 100px; padding-top: 20px;">
            <div class="col-10 p-4 d-flex flex-column ">

              <h3 class="mb-0">Crie seu Ponto Turístico</h3>
              <h6><div class="text-muted">Serão aceitos somente informações fieis ao real e verdadeiro. </div></h6>
            </div>

            <div class="col-auto d-none d-lg-block">
              <div class="col-md-12 margin-top ">
                <img src='<?php echo "./images/cachu.jpg"; ?>' class="card-img-top" alt="..." style="margin-bottom: 20px; padding-top: 20px;">
              </div>
            </div>


            <p class="card-text mb-auto " style="margin-left: 20px;">  Aqui você pode divulgar gratuitamente as belezas de sua região para que outras pessoas encontrem. </p>
            <div class="col-12 p-4 d-flex flex-column position-static" style="text-align: center;">
              <a href="solicitacaoNovoPontoTuristico.php"> <button class="btn btn-success" style="color: white; text-decoration: none; ">
              + Cadastrar Novo Ponto </button></a>
            </div>
          </div>
        </div>


        <!-- terceiro GAD..wea de PROPAGANDA PONTO TURISTICO -->


        <div class="col-md-12">
          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-400" style="margin-bottom: 50px; min-height: 50px;">
            <div class="col p-4 d-flex flex-column ">
              <h3 class="mb-0"> Manual do Turismo </h3>
              <p class="card-text mb-auto"> Aqui você se informa sobre turismo e suas novidades.</p>

            </div>
            <div class="col-auto d-none d-lg-block">
              <div class="col-md-12 margin-top ">
                <img src='<?php echo "./images/camping.jpg"; ?>' class="card-img-top" alt="..." style="margin-bottom: 20px;">
              </div>
            </div>
            <p class="card-text " style="margin: 20px;"> Aprenda a ganhar dinheiro com turismo local, e aumente sua renda.
              <a href="./manualdoturismo.php" class="stretched-link"> +Informações </a>
            </p>
          </div>
        </div>
    </div>

  </div>

                <div class="row" style="padding: 20px;" >
                  <h2 style="margin:auto;">Turismo Brasileiro</h2>
                </div>
                <div class="col-12">
                    <hr>
                    <br>
              </div>

    <!-- ONDE BUSCA OS PONTOS TURISTICOS -->
    <div class="row">
      <div class="col-md-12">
        <?php
        $query_products = "SELECT id, name, price, image FROM pontosturisticos ORDER BY price ASC Limit 4";
        $result_products = $conn->prepare($query_products);
        $result_products->execute();
        ?>
        <div class="row row-cols-1 row-cols-md-4">
          <?php
          while ($row_product = $result_products->fetch(PDO::FETCH_ASSOC)) {
            extract($row_product);

          ?>
            <div class="col mb-4 text-center">

              <div class="card" style="padding: 20px; text-align: center; ">
                <div class="row" style="height:60px; ">
                  <h5 class="card-title col-12 text-center"" style=" margin-bottom: 5px;  "><?php echo $name; ?></h5>
                </div>

                <img style="height: 140px; max-height: 200px; max-width: 400px; margin:auto; border:1px solid green; box-shadow: 3px 2px 5px black;" src='<?php echo "./images/pontosturisticos/$id/$image"; ?>' class="card-img-top" alt="...">

                <div class="card-body">
                  <a href="pg/view-products.php?id=<?php echo $id; ?>" class="btn btn-primary">Detalhes</a>
                </div>
              </div>

            </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
    <!-- FINAL ONDE BUSCA OS PONTOS TURISTICOS -->



    <!-- SESSAO DOS EVENTOS MARCADOS COMO ABERTO E LIBERADOS PARA AGENDAR -->

              <div class="col-12">
                    <hr>
                    <br>
              </div>

        <div class="col-12">
                <div class="row" style="padding: 20px;" >
                  <h2 style="margin:auto; "> Atividades disponiveis </h2>
                </div>
<hr>
                <?php
                    $queryEventos = "SELECT *, eventos.id AS id,
                                                 eventos.nome AS nomeE,
                                                    eventos.idGuia AS idGuia,
                                                      prod.image AS img,
                                                        eventos.breveDescricao AS breveDescricao
                                     FROM eventos
                                     LEFT JOIN
                                     pontosturisticos AS prod
                                     ON prod.id=eventos.idPt ORDER BY nomeE ASC LIMIT 3";

                    $result_Eventos = $conn->prepare($queryEventos);
                    $result_Eventos->execute();
                ?>

              <!--  -->
              <div class="col-12" style="padding: 20px; ">
                    <div class="row rounded flex-md-row mb-4 shadow-sm " style="padding: 10px;" >

                            <?php
                              while ($row_product = $result_Eventos->fetch(PDO::FETCH_ASSOC)) {
                              extract($row_product);
                            ?>

                      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-10 rotated"  style="padding: 15px;" >
                        <div class="card flex-md-row sm-12" style="width: 18rem; margin:auto;">
                          <div class="card-body d-flex flex-column ">
                            <strong class="d-inline-block mb-2 text-success">Evento</strong>
                            <h4 class="mb-0 text-center">
                              <p><b><?php echo $nomeE; ?></b></p>
                            </h4>

                            <a href="pg/view-evento.php?id=<?php echo $id;?>" class="text-center">
                              <img style="height:190px; width: 235px; "
                              alt="Ponto Turistico" src="<?php echo "./images/pontosturisticos/$idPt/$img"; ?>">
                            </a>


                            <p class="card-text text-center mb-auto " > Por apenas R$ <?php echo number_format($valor, 2, ",", "."); ?></p>


                            <p class="card-text mb-auto" style="height: 100px; border:1px solid blue; border-radius: 5px; padding-left: 10px;"><?php echo $breveDescricao.'<br>'; ?></p>
                          </div>

                        </div>
                      </div>


                                  <?php
                                  }
                                  ?></br>

                    </div>
              </div>
        </div>


                <div class="row" style="padding: 20px;" >
                  <h2 style="margin:auto;"> Profissionais </h2>
                </div>
                <div class="col-12">
                    <hr>
                    <br>
              </div>

    <!-- ONDE BUSCA OS PONTOS TURISTICOS -->
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
    <!-- FINAL ONDE BUSCA OS PONTOS TURISTICOS -->


  </main><!-- /.container -->
  <?php
  include_once 'rodape.php';
  ?>

<script>
  const texto = "Descubra os melhores destinos, hotéis e atividades para tornar suas viagens inesquecíveis Grupo organizado em desenvolvimento cultural e urbano, trazendo visibilidade ao turismo regional";

  let i = 0;
  setInterval(() => {
    document.getElementById("texto-lento").textContent += texto.charAt(i);
    i++;
    if (i > texto.length) clearInterval();
  }, 50); // tempo em milissegundos entre cada letra aparecer
</script>

</body>

</html>
