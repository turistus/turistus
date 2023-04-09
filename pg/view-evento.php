<?php
define('ACCESS', true);
include_once '../connection.php';
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
session_start();

    if(!isset ($_SESSION['user'])){
        $emailSessaoAberta = $_SESSION['user_email'];
        //echo " VIEWe" . $emailSessaoAberta;

     }else{
        $_SESSION['user_email'] = ['TEste@t.com'];
     }

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="../images/icon/logo.ico" >
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <title>Desconecta - Visualizar eventos</title>
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


            $query_products = "SELECT eventos.id AS id,
             eventos.nome AS nome,
             eventos.descricao AS descricao,
             eventos.valor AS valor,
             eventos.idGuia AS idDoGuia,
             eventos.pontos AS pontos,
             datah,

             idPt,
             prod.cidade AS cidade,
             prod.image AS img,
             prod.uf AS uf,


             guias.id AS idGuia,
             guias.nome AS nomeGuia,
             guias.uf AS estadoGuia
             FROM eventos
             LEFT JOIN pontosturisticos AS prod ON prod.id=eventos.idPt
             LEFT JOIN servicos AS guias ON guias.id=eventos.idGuia
             WHERE eventos.id =:id ";



            $result_products = $conn->prepare($query_products);
            $result_products->bindParam(':id', $id, PDO::PARAM_INT);
            $result_products->execute();
            $row_product = $result_products->fetch(PDO::FETCH_ASSOC);
            extract($row_product);
            $valor_rise = ($valor * 0.50) + $valor;
            ?>


            <h1 class="display-3 mt-5 mb-3"><?php echo $nome; ?></h1>



            <!-- LINHA PRINCIPAL -->
            <div class="row" >

                    <!-- Lado Esquerdo -->
                    <div class="col-md-6" >
                        <img style="height: 300px;" src='<?php echo "../images/pontosturisticos/$idPt/$img"; ?>' class="card-img-top">

                    </div>

                    <!-- Lado Direito -->
                        <div class="col-md-6" style="border: 0,5px solid black;">

                            <div class="col-md-12 ">
                                <h4>Profissional organizador:  <a href="../guias/perfilG.php?idguia=<?php echo $idGuia;?>"><?php echo $nomeGuia;?></h4></a>
                                <h3 style="text-align: center;"><?php echo $cidade?> - <?php echo $uf?></h3>
                            </div>
                            <hr>
                            <div class="row">
                            <div class="col-3 " >
                                <br>
                                <h5>Classificação:</h5>
                            </div>
                            <div class="col-4 " >
                                <div class="star-ratings" style="margin-left:15px;">
                                    <div class="fill-ratings" style="width: <?php echo $pontos . '%'?>;">
                                        <span>★★★★★</span>
                                    </div>
                                    <div class="empty-ratings">
                                        <span>★★★★★</span>
                                    </div>
                                </div>
                            </div>
                            </div>

                            <h5 class="card-title">Abertura: <?php echo date('d/m/Y',  strtotime($datah)); ?></h5>
                            <div class="col-6 " >
                                <h4 style="text-align: center; border:solid 1px green; padding-left: 5px; padding-bottom: 5px; "> por R$ <?php echo number_format($valor, 2, ",", "."); ?></h4>
                            </div>



                            <!-- botao -->
                            <div class="col-md-12 mt-2" >
                                <div class="row">

                                        <?php
                                        if($emailSessaoAberta == true){


                                        ?>

                                        <div class="col-4 mt-1"  >
                                            <p>
                                                <a href="pagamentoEventoForm.php?id=<?php echo $id;?>&idGuia=<?php echo $idGuia;?>&email=<?php echo $emailSessaoAberta;?>" class="btn btn-outline-success" ><input id="BotaoPagamento" type="image" src="../icones/picpaylogo.png" name="submit" alt="" style="width: 80px; height: 40px;"/> </a>
                                            </p>

                                        </div>

                                        <div class="col-8 mt-2"  >
                                                <a href="./p/pagar.php?id=<?php echo $id;?>" class="btn "  >
                                                <input id="BotaoPagamento" type="image" src="https://stc.pagseguro.uol.com.br/public/img/botoes/pagamentos/209x48-pagar-azul-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
                                                </a>
                                        </div>



                                            <?php
                                                }else{
                                                    //SE NAOxxsx TIVER EMAIL DE USUARIO LOGADO FAÇA;;

                                            ?>

<!-- MODAL PARA ABRIR QND NAO TIVER NINGUEM LOGADO e assim LOGAR e CAIR NA EVENTOS NOVAMENTE -->
            <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="loginModalLabel">Área Restrita</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                            <p></p>
                            <button id="turista" type="button" class="btn btn-light text-dark me-2">Turista</button>
                            <button id="guia" type="button" class="btn btn-light text-dark me-2">Guia</button>
                            </div>
                            <br>
                            <!-- form vazio pra abrir limpo-->
                            <div class="modal-content" id=formPrimeiro>


                            </div>

                            <!--o id é acessado pelo JS quando o botao com id turista é clicado e busca o include -->
                            <div class="modal-content" id=acessaTurista>

                                <?php
                                include_once '../lgn/entrarTurista.php';
                                ?>
                            </div>

                            <!--o id é acessado pelo JS quando o botao com id GUIA é clicado e busca o include -->
                            <div class="modal-content" id=acessaGuia>
                                <?php
                                include_once '../lgn/entrarGuia.php';
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


                                        <div class="col-4 mt-2"  >
                                            <p>
                                                <button type='button' class='btn btn-outline-success' data-bs-toggle='modal' data-bs-target='#loginModal'>

                                                <input id="BotaoPagamento" type="image" src="../icones/picpaylogo.png" name="submit" alt="picpaay" style="width: 80px; height: 40px;" />

                                                </button>
                                            </p>
                                        </div>
                                        <div class="col-8 mt-2"  >
                                            <button type='button' class='btn btn-outline' data-bs-toggle='modal' data-bs-target='#loginModal'>
                                                <input id="BotaoPagamento" type="image" src="https://stc.pagseguro.uol.com.br/public/img/botoes/pagamentos/209x48-pagar-azul-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
                                            </button>
                                        </div>

                                            <?php
                                            }
                                            ?>

                                </div>
                            </div>


                        </div>
                        <div class="col-md-10 mt-4 mb-5" style="  padding-bottom:5px; margin-left:10px; margin-right: 10px; border: solid 1px black; border-radius: 10px; ">
                        <h3>Descrição</h3>
                        <p style="border:  padding:10px;"> <?php echo $descricao; ?></p>
                        </div>
            </div>

        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    </body>
    <?php
        include_once '../rodape.php';
    ?>

<script>
  $(document).ready(function(){

    $("#acessaTurista").hide();
    $("#acessaGuia").hide();
    $("#formPrimeiro").show();

  $("#turista").click(function () {
    $("#acessaTurista").show(1000);
    $("#acessaGuia").hide();
    $("#formPrimeiro").hide();

	});

  $("#guia").click(function () {
	$("#acessaGuia").show(1000);
    $("#acessaTurista").hide();
    $("#formPrimeiro").hide();
	});


  });

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