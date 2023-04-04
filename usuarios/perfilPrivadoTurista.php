

<?php

$Tid = $_SESSION['user_id'];
//echo $Tid;

$query_busca_turista = "SELECT *, image AS foto FROM turistas WHERE turistas.id = $Tid";
$turista_selecionado = $conn->prepare($query_busca_turista);
$turista_selecionado->execute();

if(($turista_selecionado) AND ($turista_selecionado->rowCount() != 0) ){
    $row_turista = $turista_selecionado->fetch(PDO::FETCH_ASSOC);

}else {
    header("Location: ../index.php");
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" >
        <title>Editar Perfil</title>
        <link rel="shortcut icon" type="imagex/png" href="../../images/icon/LG.jpg">
    </head>

<body>
    <main class="content">
        <!-- Linha ROW de tudo -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" style="min-height: 350px; padding: 20px; ">
                <!-- Deve ser possivel alterar alguns dados do Perfil do Usuario Turistaa -->
                <div class="col-xl-4 col-lg-2 col-md-12 col-sm-12 ">

                </div>
            <h4> Perfil </h4>
                <div class="col-xl-12 col-lg-8 col-md-12 col-sm-12">
                    <label>Foto</label>
                            <img style="max-height: 200px; max-width: 200px; background-color: gray; padding: auto;"
                            src='<?php echo "./images/turistas/$Tid/$foto"; ?>'
                            value="<?php if(isset($dados['foto']))
                                        { echo $dados['foto']; }
                                    elseif(isset($row_turista['foto']))
                                        { echo $row_turista['foto']; }?>;" >

                </div>

                <div class="col-xl-12 col-lg-8 col-md-12 col-sm-12">
                    <label>Apelido</label>
                    <h6><?php if (isset($dados['apelido'])) {
                            echo $dados['apelido'];
                        } elseif (isset($row_turista['apelido'])) {
                            echo $row_turista['apelido'];
                        } ?>
                    </h6>
                </div>

                <div class="col-xl-12 col-lg-8 col-md-12 col-sm-12">
                    <label>Nome</label>
                    <h6><?php if (isset($dados['name'])) {
                            echo $dados['name'];
                        } elseif (isset($row_turista['name'])) {
                            echo $row_turista['name'];
                        } ?>
                    </h6>
                </div>

                <div class="col-xl-12 col-lg-8 col-md-12 col-sm-12">
                    <label>Cidade</label>
                    <h6><?php if (isset($dados['cidade'])) {
                            echo $dados['cidade'];
                        } elseif (isset($row_turista['cidade'])) {
                            echo $row_turista['cidade'];
                        } ?>
                    </h6>
                </div>

                <div class="col-xl-12 col-lg-8 col-md-12 col-sm-12">
                    <label>Celular</label>
                    <h6><?php if (isset($dados['celular'])) {
                            echo $dados['celular'];
                        } elseif (isset($row_turista['celular'])) {
                            echo $row_turista['celular'];
                        } ?>
                    </h6>
                </div>

                <div class="col-xl-12 col-lg-8 col-md-12 col-sm-12">
                    <label>Email</label>
                    <h6><?php if (isset($dados['email'])) {
                            echo $dados['email'];
                        } elseif (isset($row_turista['email'])) {
                            echo $row_turista['email'];
                        } ?>
                    </h6>
                </div>


                        <div class="row" style="padding-left: 10px; margin-top:30px;">
                            <div class="col-12">
                                <h5><a href="../usuarios/editarPerfilTurista.php?id=<?php echo $row_turista['id']?>" class="btn btn text-dark" style="border: 1px solid black;"> Editar </a></h5>
                            </div>
                        </div>

            </div>
        </div>
    </main>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- Para buscar a foto na pasta-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    function previewImagem() {
        var imagem = document.querySelector('input[name=attachment]').files[0];
        var preview = document.querySelector('img');

        var reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
        }
        if (imagem) {
            reader.readAsDataURL(imagem);
        } else {
            preview.src = "";
        }
    }
</script>

