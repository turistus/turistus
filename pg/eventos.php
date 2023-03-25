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

        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <!-- icone da aba no navegador-->
        <link rel="shortcut icon" type="imagex/png" href="../images/logooriginal.png">
  <style>
        .star-ratings {
            unicode-bidi: bidi-override;
            color: #ccc;
            font-size: 25px;
            position: relative;
            margin: 0;
            padding: 0;
            }
        .fill-ratings {
                color: #e7711b;
                padding: 0;
                position: absolute;
                z-index: 1;
                display: block;
                top: 0;
                left: 0;
                overflow: hidden;
            }
        .empty-ratings {
                padding: 0;
                display: block;
                z-index: 0;
            }

</style>
</head>

<body>

<?php
  include_once 'menu.php';
  ?>


<div class="row">
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
            <h2 class="display-4 mt-5 mb-5">Aproveite os eventos </h2>

                <!-- Aqui Inclui a busca de todos os EVENTOS-->
              <?php
                include_once 'funcoes/buscaEventosGeral.php';
              ?>

        </div>
      </main>

    <?php
      include_once '../rodape.php';
    ?>
  </body>
  <script>
        var search = document.getElementById('pesquisar');

        search.addEventListener("keydown", function(event){
            if(event.key === "Enter"){
                searchData();
            }
        });


        function searchData(){
            window.location = 'eventos.php?search='+search.value;
        }


        $(document).ready(function() {
                        // Gets the span width of the filled-ratings span
                        // this will be the same for each rating
                        var star_rating_width = $('.fill-ratings span').width();
                        // Sets the container of the ratings to span width
                        // thus the percentages in mobile will never be wrong
                        $('.star-ratings').width(star_rating_width);

                        });

    </script>
</html>