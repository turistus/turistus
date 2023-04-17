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
      <div class="col-md-12 px-0" style="background-color: #3fe3; padding: 15px;">

          <h1 class="display-4" > Marketplace Turístico</h1>

          <p class="lead my-2" >

          <br> Descubra os melhores destinos, hotéis e atividades para tornar suas viagens inesquecíveis.
          <br> Grupo organizado em desenvolvimento cultural e urbano, trazendo visibilidade ao turismo regional.</p>
          <p class="lead mb-0"><a href="./pg/sobre.php" class="text-white fw-bold">Saiba mais</a></p>

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
                <h3 class="mb-0">Serviços </h3>
            <div class="mb-1 text-muted">Somente para maiores de 18 anos devidamente avaliados. </div>

            <p class="card-text mb-auto">Morador da localidade aproveite a plataforma para divulgar seu trabalho e sua região.</p>
            <a href="./guias/cadastrarguia.php" class="btn btn-outline-primary">Trabalhe conosco !</a>
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
          <div class="col-10 p-4 d-flex flex-column " style="padding: 15px;">

            <h3 class="mb-0">Crie seu Ponto Turístico</h3>
            <h6><div class="text-muted">Serão aceitos somente informações fieis ao real e verdadeiro. </div></h6>
          </div>

          <div class="col-auto d-none d-lg-block">
            <div class="col-md-12 margin-top ">
              <img src='<?php echo "./images/cachu.jpg"; ?>' class="card-img-top" alt="..." style="margin-bottom: 20px; padding-top: 20px;">
            </div>
          </div>

          <div class="col-12 p-4 d-flex flex-column position-static">
            <a href="solicitacaoNovoPontoTuristico.php"> <strong class="btn btn-outline-success">Envie seus dados</strong></a>
          </div>
        </div>
      </div>


      <!-- terceiro GAD..wea de PROPAGANDA PONTO TURISTICO -->


      <div class="col-md-12">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-400" style="margin-bottom: 50px; min-height: 50px;">
          <div class="col p-4 d-flex flex-column ">
            <h3 class="mb-0">Hospedagem</h3>
            <p class="card-text mb-auto">Cadastre seu hostel, camping ou acampamento para conhecermos !</p>
            <a href="./cadastroParceiro.php" class="stretched-link"> Fale conosco</a>
          </div>
          <div class="col-auto d-none d-lg-block">
            <div class="col-md-12 margin-top ">
              <img src='<?php echo "./images/camping.jpg"; ?>' class="card-img-top" alt="..." style="margin-bottom: 50px;">
            </div>
          </div>
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
        $query_products = "SELECT id, name, price, image FROM pontosturisticos ORDER BY id ASC Limit 8";
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
                <div class="row text-center">
                  <h5 class="card-title" style=" margin:auto; "><?php echo $name; ?></h5>
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
                  <h2 style="margin:auto;">Eventos </h2>
                </div>

                <?php
                    $queryEventos = "SELECT *, eventos.id AS id,
                                                 eventos.nome AS nomeE,
                                                    eventos.idGuia AS idGuia,
                                                      prod.image AS img,
                                                        eventos.breveDescricao AS breveDescricao
                                     FROM eventos
                                     LEFT JOIN
                                     pontosturisticos AS prod
                                     ON prod.id=eventos.idPt ORDER BY nomeE ASC LIMIT 6";

                    $result_Eventos = $conn->prepare($queryEventos);
                    $result_Eventos->execute();
                ?>

              <!--  -->
              <div class="col-md-12" style="padding: 20px; ">
                    <div class="row rounded flex-md-row mb-4 shadow-sm " style="padding: 10px;" >

                            <?php
                              while ($row_product = $result_Eventos->fetch(PDO::FETCH_ASSOC)) {
                              extract($row_product);
                            ?>

                      <div class="col-auto mr-auto col-xl-4 col-lg-6 col-md-5 col-sm-12 col-mb-12 ">
                        <div class="card flex-md-row mb-4 sm-12" style="width: 18rem; margin:auto;">
                          <div class="card-body d-flex flex-column ">
                            <strong class="d-inline-block mb-2 text-success">Evento</strong>
                            <h4 class="mb-0">
                              <p><?php echo $nomeE; ?></p>
                            </h4>

                            <img style="height:190px; width: 235px; margin-left:5px; padding:10px;"   alt="..." src="<?php echo "./images/pontosturisticos/$idPt/$img"; ?>">



                            <p class="card-text mb-auto" style="margin-left: 20px;" >Por apenas R$ <?php echo number_format($valor, 2, ",", "."); ?></p>
                            <br>
                            <h6><a href="pg/view-evento.php?id=<?php echo $id;?>" class="btn btn-primary">Visitar <ion-icon name="pencil-outline"></ion-icon></a></h6>
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
                  <h2 style="margin:auto;">Pontos Turísticos mais acessados</h2>
                </div>
                <div class="col-12">
                    <hr>
                    <br>
              </div>

    <!-- ONDE BUSCA OS PONTOS TURISTICOS -->
    <div class="row">
      <div class="col-md-12">
        <?php
        $query_products = "SELECT id, name, price, image FROM pontosturisticos ORDER BY price < 50 Limit 4";
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
                <div class="row text-center">
                  <h5 class="card-title" style=" margin:auto; "><?php echo $name; ?></h5>
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


  </main><!-- /.container -->
  <?php
  include_once 'rodape.php';
  ?>

</body>

</html>
