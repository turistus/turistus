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
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
</head>

<body>

<?php
  include_once 'menuPainelTurista.php';
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
<div class="content " style="border: solid 1px black;">
  
    
</div>
    


      <main class="content">




        <div class="container">
           

            <h2 class="display-4 mt-5 mb-5">Bem Vindo, <?$_SESSION['user_name']?></h2>
            
          <div class="row">
            <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12" style="border:solid 1px black;">
              <h2>Lista de Eventos Agendados</h2>
              
                  <!-- ONDE BUSCA OS eventos TURISTICOS -->
    <div class="row">
      <div class="col-md-12">
        <?php
        $query_products = "SELECT id, nome, datah, valor, descricao FROM eventos ORDER BY id ASC";
        $result_products = $conn->prepare($query_products);
        $result_products->execute();
        ?>
        <div class="row row-cols-1 row-cols-md-3">
          <?php
          while ($row_product = $result_products->fetch(PDO::FETCH_ASSOC)) {
            extract($row_product);
            /* echo "<img src='./images/$id/$image'><br>";
                      echo "ID: $id<br>";
                      echo "Nome: $name<br>";
                      echo "Preço: R$ " . number_format($price, 2, ",", ".") . "<br>";
                      echo "<hr>"; */
          ?>
            <div class="col mb-4 text-center">
              <div class="card">

                  <div class="card-body">
                  <h5 class="card-title"><?php echo $nome; ?></h5><h5 class="card-title"><?php echo $valor; ?></h5><br>
                  <h5 class="card-title"><?php echo $datah; ?></h5><br>
                  <h5 class="card-title"><?php echo $descricao; ?></h5><br>
                  
                  <h3><? echo "ID:. $id";?></h3>
                  <p>  </p>
                  
                  <a href="pg/view-eventos.php?id=<?php echo $id; ?>" class="btn btn-primary">Detalhes</a>

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

        </div>
</main>

<?php
  include_once '../rodape.php';
  ?>
</body>

</html>