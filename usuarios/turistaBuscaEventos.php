<?php
define('ACCESS', true);
include_once '../connection.php';
session_start();
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

?>

<!doctype html>
<html lang="pt/br">

<head>
  <title>EVENTOS</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

</head>

<body>

<?php
  include_once 'menuPainelTurista.php';
  ?>


<div class="row">a
<!--            só espaço mesmo   PRECISO manter uma SESSAO aberta com email e senha ou oque eu precisar para liberar as outras coisas como pontos pagos

            PRECISA SER ATUALIZADO AUTOMATICAMENTE QUANDO TURISTA ESTIVER FEITO O
            PAGAMENTO, O STATUS DO PEDIDO VAI ESTAR ID 5 entao pode aparecer no

            PAINEL DE AGENDAMENTO DO USUARIO TURISTA


            // a Mesma coisa se repete para a AGENDA de TURISTA
//por DATA
// para quando houver INSERT da tabela payments_picpays O STATUS DO PEDIDO VAI ESTAR ID 5
// deve se ser pesquisado a ultima transação  e descobrir de que GUIA é
// e a data para mostrar no PAINEL DO TURISTA pela tabela AGENDATuristaGuia
-->
</div>

<div class="content ">
  
    
</div>
      <main class="content">
        <div class="container">
            <h2 class="display-4 mt-5 mb-5">Busque seus Eventos </h2>

            <h3> Pesquisar </h3>
            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                <input type="search" class="form-control" placeholder="">
            </form>
          <div class="row">
            <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12" style=" text-align: center; padding: 20px;">
              
                <!-- Aqui Inclui a busca de todos os EVENTOS ***** POR ENQUANTO FICA ASSIM Mas logo vou mudar a funcao de listagem de eventos PESQUISANDO nome do evento -->  
              <?php
                include_once '../funcoes/buscaEventos.php';
              ?>

            </div>
          </div>
        </div>
      </main>

    <?php
      include_once '../rodape.php';
    ?>
  </body>
</html>