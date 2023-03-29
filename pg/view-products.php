<?php
define('ACCESS', true);
include_once '../connection.php';
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="../images/icon/logo.ico" >
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <title>Desconecta - Visualizar Pontos Turisticos</title>
        <style>
        .star-ratings {
            unicode-bidi: bidi-override;
            color: #ccc;
            font-size: 35px;
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
 <!--  Precisa ser feito a busca dos guias disponiveis e os dias e valores do evento todo -->
 <!--  Para finalizar a compra do servico com ponto turistico -->

        <div class="container">

            <?php


            $query_products = "SELECT *,
            pontosturisticos.id AS id,
            name,
            descricao,
            pontosturisticos.cidade AS cidade,
             pontosturisticos.uf AS uf,
               pontosturisticos.image AS image,
               pontos = ( SELECT SUM(valorVoto) / Count(idEvento) FROM classificacao)

            FROM pontosturisticos WHERE pontosturisticos.id =:id ";
            $result_products = $conn->prepare($query_products);
            $result_products->bindParam(':id', $id, PDO::PARAM_INT);
            $result_products->execute();
            $row_product = $result_products->fetch(PDO::FETCH_ASSOC);
            extract($row_product);
            //$price_rise = ($price * 0.50) + $price;
            ?>

            <h1 class="display-3 mt-5 mb-3"><?php echo $name; ?></h1>
            <!-- LINHA PRINCIPAL -->
            <div class="row" style=" background-image: src='../images/bg22.jpg';">

                    <!-- Lado Esquerdo -->
                <div class="col-md-6" style="padding-top:20px;" >
                    <img style="height: 300px;" src='<?php echo "../images/pontosturisticos/$id/$image"; ?>' class="card-img-top">
                </div>

                    <!-- Lado Direito -->
                <div class="col-md-4" >

                            <div class="col-4 " >
                            <label>Classificação: </label>
                                <div class="star-ratings" style="margin-left:5px;">
                                    <div class="fill-ratings" style="width: <?php echo $pontos . '%'?>;">
                                        <span>★★★★★</span>
                                    </div>
                                    <div class="empty-ratings">
                                        <span>★★★★★</span>
                                    </div>
                                </div>
                            </div>

                        </br>

                            <h5>Cidade: <?php echo $cidade?> - <?php echo $uf?></h5>
                </div>

                <div class="col-md-10 mt-5 mb-5" style=" padding-bottom:5px; margin-left:10px; margin-right: 10px; border: solid 1px black; border-radius: 10px; ">
                    <h3>Descrição</h3>
                    <p style=" padding:10px;"> <?php echo $descricao; ?></p>
                </div>

                <div class="col-md-10  mb-5" style=" padding-bottom:5px; margin-left:10px; margin-right: 10px; border: solid 1px black; border-radius: 10px; ">
                    <!-- Aqui Inclui a busca de todos os EVENTOS-->
                    <?php
                        include_once 'funcoes/buscaEventosAnuncios.php';
                    ?>

                </div>






            </div>
            <!-- Fim da linha principal -->




        </div>
        <!-- Fim do conteiner -->

    </body>
<?php
  include_once '../rodape.php';
  ?>

<script>

  $(document).ready(function() {
                        // Gets the span width of the filled-ratings span
                        // this will be the same for each rating
                        var star_rating_width = $('.fill-ratings span').width();
                        // Sets the container of the ratings to span width
                        // thus the percentages in mobile will never be wrong
                        $('.star-ratings').width(star_rating_width);

                        });


</script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</html>