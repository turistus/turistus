
<?php
define('ACCESS', true);
include_once '../connection.php';
$Uid = filter_input(INPUT_GET, "idguia", FILTER_SANITIZE_NUMBER_INT);

$query_busca_guia = "SELECT *, image AS fotoGuia, apelido, nome, celular FROM servicos WHERE servicos.id = $Uid";
$guia_selecionado = $conn->prepare($query_busca_guia);
$guia_selecionado->execute();

if(($guia_selecionado) AND ($guia_selecionado->rowCount() != 0) ){
    $row_guia = $guia_selecionado->fetch(PDO::FETCH_ASSOC);
    $apelido = $row_guia['apelido'];
    $fotoGuia = $row_guia['fotoGuia'];
}else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <!-- Fonts and icons -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
        <title>Perfil P. Guia</title>
        <link rel="shortcut icon" type="imagex/png" href="../images/logooriginal.png">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            include_once './menuFora.php';
        ?>
            <main class="container">
                <!-- Linha ROW de tudo -->
                <div class="row" >
                    <div class="col-12"
                        style="min-height: 400px;

                        border: 1px solid black;
                        margin-top: 50px;
                        ">
                        <div class="row" >
                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 " style=" margin-top: 20px;" >
                                    <p><img style="max-height: 200px; max-width: 200px; background-color: gray; "
                                        src='<?php echo "../images/guias/$Uid/$fotoGuia"; ?>'></p>

                                    <div class="star-ratings text-center" style="margin-left: 15px; text-align: center;" >
                                        <div class="fill-ratings" style="width: <?php echo $row_guia['pontos'] . '%'?>;">
                                            <span>★★★★★</span>
                                        </div>
                                        <div class="empty-ratings">
                                            <span>★★★★★</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-xl-10 col-lg-10 col-md-10 col-sm-8" style="transform: scale(0.8); ">
                                        <div class="row">
                                        <label>Apelido</label>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 ">
                                                <h4><? echo $row_guia['apelido'];?> <?php if(isset($dados['apelido']))
                                                { echo $dados['apelido'];}elseif(isset($row_guia['apelido']))
                                                { echo $row_guia['apelido']; }?>
                                                </h4>
                                            </div>

                                            <label>Nome</label>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 ">
                                                <h4><?php if(isset($dados['nome']))
                                                { echo $dados['nome'];}elseif(isset($row_guia['nome']))
                                                { echo $row_guia['nome']; }?>
                                                </h4>
                                            </div>

                                            <label>Celular</label>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 ">
                                                <h4><?php if(isset($dados['celular']))
                                                { echo $dados['celular'];}elseif(isset($row_guia['celular']))
                                                { echo $row_guia['celular']; }?>
                                                </h4>
                                            </div>

                                            <label>uf</label>
                                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 ">
                                                <h4><?php if(isset($dados['uf']))
                                                { echo $dados['uf'];}elseif(isset($row_guia['uf']))
                                                { echo $row_guia['uf']; }?>
                                                </h4>
                                            </div>
            <br>
            <!--
                                                <div class="col-12">
                                                    <h5><a href="../usuarios/funcoes/avaliarGuia.php?id=<?php echo $Uid?>" class="btn btn text-dark" style="border: 1px solid black;"> Avaliar </a></h5>
                                                </div>
            -->
                                        </div><!-- Fim da ROW dos DAOS DO GUIA -->
                                </div><!-- Fim da DIV dos DAOS DO GUIA -->
                        </div><!-- FIM DA 2 ROW -->


                        <div class="row">
                            <div class="col-12" >
                                <h3> Eventos </h3>
                                <?php
                                    include_once '../guias/funcoes/buscaEventosPerfilG.php';
                                ?>
                            </div>
                        </div><!-- Fim da DIV  -->

                    </div>
                </div><!-- ROW TOTAL vermelhona  -->


        </main>
        <?php
            include_once '../rodape.php';
        ?>


    </body>
</html>
    <!-- Para buscar a foto na pasta-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                    <script>
                        function previewImagem(){
                            var imagem = document.querySelector('input[name=attachment]').files[0];
                            var preview = document.querySelector('img');

                            var reader = new FileReader();

                            reader.onloadend = function(){
                                preview.src = reader.result;
                            }
                            if(imagem){
                                reader.readAsDataURL(imagem);
                            }else{
                                preview.src = "";
                            }
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

