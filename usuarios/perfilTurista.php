<?php
define('ACCESS', true);
include_once '../connection.php';
session_start();
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

?>

<!doctype html>
<html lang="pt/br">

 <head>
  <title>Perfil</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

 </head>

 <body>
        <!-- Menu do Painel do Turista -->
        <?php
            include_once 'menuPainelTurista.php';
        ?>
     <main class="content" >
             <div class="container" style="border: 1px solid black;">
                     <h2 class="display-4 mt-5 mb-5"> Perfil </h2>
                     <!-- Linha ROW de tudo -->                    
                     <div class="row">
                            <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12" style="height: 700px; text-align: center; padding: 20px; ">
                            <h2>Dados Pessoais</h2>
                            
                            <label>Nome:</label><br>
                            <label>Data Nascimento:</label><br>
                            <label>Região:</label>

                            <h2>Contato e endereço</h2>

                            <label>Celular:</label>
                            <label>Cidade:</label>
                            <label>Rua:</label>

                            </div>
                      </div>
             </div>
     </main>

        <?php
        include_once '../rodape.php';
        ?>
 </body>
</html>