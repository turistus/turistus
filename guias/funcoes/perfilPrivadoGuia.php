
<?php

$Uid = $_SESSION['user_id'];
//echo $Uid;

$query_busca_guia = "SELECT * FROM servicos WHERE servicos.id = $Uid";
$guia_selecionado = $conn->prepare($query_busca_guia);
$guia_selecionado->execute();

if(($guia_selecionado) AND ($guia_selecionado->rowCount() != 0) ){
    $row_guia = $guia_selecionado->fetch(PDO::FETCH_ASSOC);

}else {
    header("Location: ../guias/painelGuia.php");
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <title>Editar Perfil</title>
        <link rel="shortcut icon" type="imagex/png" href="../../images/icon/LG.jpg">

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
            <main class="content">



                <!-- Linha ROW de tudo -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" style="min-height: 400px; padding: 20px; ">

                        <!-- Deve ser possivel alterar alguns dados do Perfil do Usuario GUIA -->
                        <div class="col-xl-4 col-lg-2 col-md-12 col-sm-12 ">

                        </div>

                        <div class="row">
                            <!-- IMAGEM DO PERFIL-->
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 ">
                                <img style="max-height: 200px; max-width: 200px; background-color: gray; padding: auto;"
                                    src='<?php echo "../images/guias/$Uid/$image"; ?>'
                                    value="<?php
                                            if(isset($dados['image']))
                                                { echo $dados['image']; }
                                            elseif(isset($row_guia['image']))
                                                { echo $row_guia['image'];  }?>;" class="card-img-top" alt="Carregar Foto...">
                            </div>


                                <!-- ALTERA SENHA -->

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <label>Email</label>
                                <h4><?php if(isset($dados['email']))
                                { echo $dados['email'];}elseif(isset($row_guia['email']))
                                { echo $row_guia['email']; }?>
                                </h4>
                            </div>
                            <div class="col-xl-8 col-lg-8 col-md-6 col-sm-6">
                                <label>Senha</label>
                                <h4><?php if(isset($dados['senha']))
                                { echo $dados['senha'];}elseif(isset($row_guia['senha']))
                                { echo $row_guia['senha']; }?>
                                </h4>
                            </div>


                        </div>

                        <div class="star-ratings" style="margin-left: 15px;" >
                            <div class="fill-ratings" style="width: <?php echo $pontos . '%'?>;">
                                <span>★★★★★</span>
                            </div>
                            <div class="empty-ratings">
                                <span>★★★★★</span>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-8 col-md-12 col-sm-12">
                            <label>Apelido</label>
                            <h4><?php if(isset($dados['apelido']))
                            { echo $dados['apelido'];}elseif(isset($row_guia['apelido']))
                            { echo $row_guia['apelido']; }?>
                            </h4>
                        </div>
                        <div class="col-xl-12 col-lg-8 col-md-12 col-sm-12">
                            <label>Nome</label>
                            <h4><?php if(isset($dados['nome']))
                            { echo $dados['nome'];}elseif(isset($row_guia['nome']))
                            { echo $row_guia['nome']; }?>
                            </h4>
                        </div>
                        <div class="col-xl-12 col-lg-8 col-md-12 col-sm-12">
                            <label>CPF</label>
                            <h4><?php if(isset($dados['cpf']))
                            { echo $dados['cpf'];}elseif(isset($row_guia['cpf']))
                            { echo $row_guia['cpf']; }?>
                            </h4>
                        </div>
                        <div class="col-xl-12 col-lg-8 col-md-12 col-sm-12">
                            <label>Celular</label>
                            <h4><?php if(isset($dados['celular']))
                            { echo $dados['celular'];}elseif(isset($row_guia['celular']))
                            { echo $row_guia['celular']; }?>
                            </h4>
                        </div>
                        <div class="col-xl-12 col-lg-6 col-md-12 col-sm-12">
                            <label>uf</label>
                            <h4><?php if(isset($dados['uf']))
                            { echo $dados['uf'];}elseif(isset($row_guia['uf']))
                            { echo $row_guia['uf']; }?>
                            </h4>
                        </div>

                        <div class="col-xl-12 col-lg-8 col-md-12 col-sm-12">
                            <label>Banco</label>
                            <h5><?php if(isset($dados['banco']))
                            { echo $dados['banco'];}elseif(isset($row_guia['banco']))
                            { echo $row_guia['banco']; }?>
                            </h5>
                        </div>
                        <div class="col-xl-12 col-lg-8 col-md-12 col-sm-12">
                            <label>Agencia</label>
                            <h5><?php if(isset($dados['agencia']))
                            { echo $dados['agencia'];}elseif(isset($row_guia['agencia']))
                            { echo $row_guia['agencia']; }?>
                            </h5>
                        </div>
                        <div class="col-xl-12 col-lg-8 col-md-12 col-sm-12">
                            <label>Conta</label>
                            <h5><?php if(isset($dados['conta']))
                            { echo $dados['conta'];}elseif(isset($row_guia['conta']))
                            { echo $row_guia['conta']; }?>
                            </h5>
                        </div>
                        <div class="col-xl-12 col-lg-8 col-md-12 col-sm-12">
                            <label>Pix</label>
                            <h5><?php if(isset($dados['pix']))
                            { echo $dados['pix'];}elseif(isset($row_guia['pix']))
                            { echo $row_guia['pix']; }?>
                            </h5>
                        </div>


                            <div class="row" style="padding-left: 10px; margin-top:30px;">
                                <div class="col-12">
                                    <h5><a href="../guias/editarPerfilGuia.php?id=<?php echo $row_guia['id']?>" class="btn btn text-dark" style="border: 1px solid black;"> Editar </a></h5>
                                </div>
                            </div>


                    </div>
                </div><!-- Fim da DIV Conteiner -->

        </main>


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

