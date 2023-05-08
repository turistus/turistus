<?php
session_start();
define('ACCESS', true);
include_once '../connection.php';
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);


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
        <link rel="shortcut icon" href="../images/logooriginal.png" >
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
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

        <div class="container">
            <?php
            $query_products = "SELECT eventos.id AS id,
             eventos.nome AS nome,
             eventos.descricao AS descricao,
             eventos.valor AS valor,
             eventos.idGuia AS idDoGuia,
             eventos.pontos AS pontos,
             dataUp,
             alimentacao,
             transporte,
             datai,
             dataf,
             encontro,

             idPt,
             prod.cidade AS cidade,
             prod.uf AS uf,


             guias.id AS idGuia,
             guias.nome AS nomeGuia,
             guias.uf AS estadoGuia,

             val.idEvento,
             val.total,

             ftEventos.foto AS img,
             ftEventos.idEv AS idEv


             FROM eventos
             LEFT JOIN pontosturisticos AS prod ON prod.id=eventos.idPt
             LEFT JOIN servicos AS guias ON guias.id=eventos.idGuia
             LEFT JOIN valores AS val ON val.idEvento=eventos.id
             INNER JOIN foto_Eventos AS ftEventos ON ftEventos.idEv=eventos.id
             WHERE eventos.id =:id ";



            $result_products = $conn->prepare($query_products);
            $result_products->bindParam(':id', $id, PDO::PARAM_INT);
            $result_products->execute();
            $row_product = $result_products->fetch(PDO::FETCH_ASSOC);
            extract($row_product);
            //$valor_rise = ($valor * 0.50) + $valor;
            ?>


            <h1 class="display-3 mt-5 mb-3"><?php echo $nome; ?></h1>

            <!-- LINHA PRINCIPAL -->
            <div class="row" >

                    <!-- Lado Esquerdo limite 5 fotos  -->
                    <div class="col-md-6 " >
                        <div class="row-12" >
                            <div class="col-md-12 " >
                                <div class="carousel form-inline" style="border:1px solid black; " >
                                    <?php

                                    // Busque as imagens na tabela "fotos"
                                    $busca_Fotos = mysqli_query($conex, "SELECT * FROM foto_Eventos WHERE foto_Eventos.idEv = $id");
                                    $imagens = array();
                                        while ($row = mysqli_fetch_assoc($busca_Fotos)) {
                                        $imagens[] = $row['foto'];
                                    }
                                    foreach ($imagens as $imagem) { ?>

                                            <div ><img src="../images/eventos/<?php echo $id.'/'.$imagem; ?>" style="margin:auto; height: 300px; text-align: center;"> </div>

                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lado Direito -->
                        <div class="col-md-6" style="border: 0,5px solid black;">

                            <div class="col-md-12 ">
                                <h5>Profissional organizador:  <a href="../guias/perfilG.php?idguia=<?php echo $idGuia;?>"><?php echo $nomeGuia;?></h5></a>
                                <h3 style="text-align: center;"><?php echo $cidade?> - <?php echo $uf?></h3>
                                <p style="text-align: center;"><?php echo "Ponto de encontro ".$encontro?></p>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-3 " >
                                    <br>
                                    <h5 style="margin-left: 15px;"> Classificação: </h5>
                                </div>
                                <div class="col-4 " >
                                    <div class="star-ratings" style="margin-left:30px;">
                                        <div class="fill-ratings" style="width: <?php echo $pontos . '%'?>;">
                                            <span>★★★★★</span>
                                        </div>
                                        <div class="empty-ratings">
                                            <span>★★★★★</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" style="padding: 10px;">

                                <h5 class="card-title" style="margin-left: 5px;" > Inicio: <?php echo date('d/m/Y',  strtotime($datai)) . " - Final: ". date('d/m/Y',  strtotime($dataf)); ?></h5>

                                <ul class="form-inline">
                                    <?php //esse Busca as opções de Transporte e refeiçao inclusos
                                        include_once './funcoes/separarListaValores.php';
                                    ?>
                                </ul>
                            </div>
                            <div class="col-12" >

                                <label for="idVal">  Quantidade Pessoas </label>

                                    <select class="form-select" name="idVal" id="idVal" style="border: 1px solid blue; border-radius: 10;" > <!-- importante esse NAME aqui pelo oque entendi levou o dado par o form idPT -->

                                        <?php
                                        $buscaValores = "SELECT valores.id AS idVal, idEvento, vagas, total FROM valores WHERE idEvento = $id ORDER BY idVal ASC";
                                        $result = $conn->prepare($buscaValores);
                                        $result->execute();
                                        $res = $result->fetchAll(PDO::FETCH_ASSOC);

                                            foreach($res as $ln ){

                                        ?>

                                        <option value="<?php echo $ln['idVal'];?>">
                                        <?php echo $ln['idVal'];?><?php echo " - ". $ln['vagas'] . ' Pessoas R$ ' . number_format($ln['total'], 2, ",", ".") ?>
                                        <?php
                                            }
                                        ?>
                                        </option>
                                    </select>
                            </div>

                            <!-- botao -->
                            <div class="col-md-12 mt-2" >
                                <div class="row">

                                        <?php
                                        if($emailSessaoAberta == true){

                                        ?>
                                        <div class="col-4 mt-1" >
                                            <p>
                                                <a href="pagamentoEventoForm.php?id=<?php echo $id;?>&idGuia=<?php echo $idGuia;?>&email=<?php echo $emailSessaoAberta;?>&idVal=<?php echo $ln['idVal'];?>" class="btn btn" >
                                                <input id="BotaoPagamento" type="image" src="../icones/logopicpay.png" name="submit" alt="" style="width: 80px; height: 30px;"/> </a>
                                            </p>
                                            </form>

                                        </div>

                                        <div class="col-8 mt-2"  >


                                            <form name="FormPagSeg" id="FormPagSeg" action="../inserirPs.php" method="POST">
                                                <input type="hidden" name="titulo" id="titulo" value="<?php echo $nome;?>" />
                                                <input type="hidden" name="idEv" id="idEv" value="<?php echo $id;?>" />
                                                <input type="hidden" name="descricao" id="descricao" value="<?php echo $descricao;?>" />
                                                <input type="hidden" name="custoEvento" id="custoEvento" value="<?php echo $ln['valor']['0'];?>" />
                                                <input type="hidden" name="idGuia" id="idGuia" value="<?php echo $idDoGuia;?>" />
                                                <input id="BotaoPagar" type="image" src="https://stc.pagseguro.uol.com.br/public/img/botoes/pagamentos/209x48-pagar-azul-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
                                            </form>

<br>
                                            <a href="pagarPagSeguro/EnviaFormPag.php?id=<?php echo $id;?>" class="btn " >
                                            <input type="hidden" src="https://stc.pagseguro.uol.com.br/public/img/botoes/pagamentos/209x48-pagar-azul-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
                                            </a>



                                        </div>

                                    <?php
                                        }else{ //SE NAOxxsx TIVER EMAIL DE USUARIO LOGADO FAÇA;;
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
                        </div>
                    </div>
                </div>
            </div>


                                        <div class="col-4 mt-2"  >
                                            <p>
                                                <button type='button' class='btn btn' data-bs-toggle='modal' data-bs-target='#loginModal'>

                                                <input id="BotaoPagamento" type="image" src="../icones/picpaylogo.png" name="submit" alt="picpaay" style="width: 80px; height: 40px;" />

                                                </button>
                                            </p>
                                        </div>
                                        <div class="col-8 mt-2"  >
                                            <button type='button' class='btn btn-outline' data-bs-toggle='modal' data-bs-target='#loginModal'>
                                                <input type="image" src="https://stc.pagseguro.uol.com.br/public/img/botoes/pagamentos/209x48-pagar-azul-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" ></script>

        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    </body>
    <?php
        include_once '../rodape.php';
    ?>

<script>
  $(document).ready(function(){

    $("#acessaTurista").hide();
    $("#formPrimeiro").show();

  $("#turista").click(function () {
    $("#acessaTurista").show(1000);
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


    $(document).ready(function(){
    $('.carousel').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 3000,
      arrows: false,
      prevArrow: '<button type="button" class="slick-prev btn btn-primary">Anterior</button><br>',
      nextArrow: '<button type="button" class="slick-next btn btn-primary">Proximo</button>',
      responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1
          }
        }
      ]

    });
  });

</script>


</html>