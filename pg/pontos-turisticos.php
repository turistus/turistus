<?php
session_start();
define('ACCESS', true);
include_once '../connection.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" type="imagex/png" href="../images/logooriginal.png">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <title>Pontos Turisticos</title>
    </head>
    <body>
            <?php
                include_once '../pg/menu.php';
            ?>
        <main class="container" >
            <div class="container">
                <h2 class="display-4 mt-5 mb-5">Pontos Turisticos</h2>

            <br>
                <div class="box-search" >
                    <div class="row ">
                        <div class=" col-xl-8 col-lg-8 col-md-7 col-sm-7 ">
                            <input style="border: 1px solid black;" type="search" class="form-control " id="pesquisar">
                        </div>
                        <div class=" col-xl-3 col-lg-4 col-md-5 col-sm-5">
                            <button onclick="searchData()"  class="btn btn-primary"> Buscar </button>
                            <button class="btn btn-success " >
                                <a href="../solicitacaoNovoPontoTuristico.php" style="color: white; text-decoration: none;">
                                    +Novo Ponto
                                </a>
                            </button>

                        </div>
                        <div class=" col-xl-1 col-lg-0 col-md-0 col-sm-0">

                        </div>
                    </div>
                    <label>Pesquise por Nome ou cidade</label>
                </div>
            <br>




                <!-- Aqui separa as buscas dos pontos por pesquisa de nome ou cidade ou todos-->
                <?php

                if(!empty($_GET['search'])){
                   // echo "contem algo, no pesquisar";
                    $palavra = $_GET['search'];
                    $query = "SELECT id, name, image, cidade, uf FROM pontosturisticos WHERE pontosturisticos.name LIKE '%$palavra%' OR pontosturisticos.cidade LIKE '%$palavra%' ORDER BY name ASC";

                    $result_products = $conn->prepare($query);
                    $result_products->execute();

                }else{
                    //echo "Nao tem nada no pesquisa, entao tras todos";
                    $query_products = "SELECT id, name, image, cidade, uf FROM pontosturisticos ORDER BY id DESC";
                    $result_products = $conn->prepare($query_products);
                    $result_products->execute();
                }


                ?>
                <div class="row row-cols-1 row-cols-md-3">
                    <?php
                    while ($row_product = $result_products->fetch(PDO::FETCH_ASSOC)) {
                        extract($row_product);

                        ?>
                        <div class="col-6 mb-4 text-center">
                            <div class="card" >
                                <img style="max-height: 200px" src='<?php echo "../images/pontosturisticos/$id/$image"; ?>' class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row_product['name']; ?></h5>
                                    <p class="card-title"><?php echo $row_product['cidade']." - ".$row_product['uf']; ?></p>
                                    <a href="view-products.php?id=<?php echo $id; ?>" class="btn btn-primary">Detalhes</a>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                    ?>
                </div>
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
            window.location = 'pontos-turisticos.php?search='+search.value;
        }
    </script>

</html>
