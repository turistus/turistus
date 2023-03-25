<?php
define('ACCESS', true);
include_once '../connection.php';
session_start();
ob_start();

//$Uid = $_SESSION['user_id'];
$Tuid = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
echo $Tuid;

if (empty($Tuid)) {
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Perfil não encontrado!</p>";
    header("Location: PainelTurista.php");
    exit();
}
$query_busca_turista = "SELECT * FROM turistas WHERE turistas.id = $Tuid";
$turista_selecionado = $conn->prepare($query_busca_turista);
$turista_selecionado->execute();



if (($turista_selecionado) and ($turista_selecionado->rowCount() != 0)) {
    $row_turista = $turista_selecionado->fetch(PDO::FETCH_ASSOC);
    //echo $row_guia['nome'];
} else {
    header("Location: ../usuarios/PainelTurista.php");
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
    <link rel="shortcut icon" href="../images/icon/favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Editar Perfil</title>
    <link rel="shortcut icon" type="imagex/png" href="../../images/icon/LG.jpg">
</head>



<body>
    <main class="content">
        <div class="shadow-lg p-3 mb-5 bg-white rounded" style="border: solid 1px black;">
            <!-- PRIMEIRA LINHA -->
            <div class="row">

                <div class="conteiner form-group col-12">

                    <h3> Editar Perfil </h3>
                    <?php
                    //Receber os dados do formulário
                    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                    //var_dump($dados);

                    // A variável recebe a mensagem de erro
                    $msg = "";

                    try {
                        if (!empty($dados['SendAddMsg'])) {
                            $attachment = $_FILES['attachment'];
                            echo $attachment['name'] ."AAAAA";
                            var_dump($attachment);
                            //Salvar os dados no bd

                            $result_markers = "UPDATE turistas SET
                        image = :image, apelido = :apelido, name = :name, uf = :uf, cidade = :cidade,  email = :email, password = :password,
                        celular = :celular, cpf = :cpf, dtnascimento = :dtnascimento, aceite = 1
                        WHERE turistas.id = :id ";
                            $add_pay = $conn->prepare($result_markers);

                            $add_pay->bindParam(':image', $attachment['name'], PDO::PARAM_STR);
                            $add_pay->bindParam(':apelido', $dados['apelido'], PDO::PARAM_STR);
                            $add_pay->bindParam(':name', $dados['name'], PDO::PARAM_STR);
                            $add_pay->bindParam(':uf', $dados['uf'], PDO::PARAM_STR);
                            $add_pay->bindParam(':cidade', $dados['cidade'], PDO::PARAM_STR);
                            $add_pay->bindParam(':email', $dados['email'], PDO::PARAM_STR);
                            $add_pay->bindParam(':password', $dados['password'], PDO::PARAM_STR);
                            $add_pay->bindParam(':celular', $dados['celular'], PDO::PARAM_STR);
                            $add_pay->bindParam(':cpf', $dados['cpf'], PDO::PARAM_STR);
                            $add_pay->bindParam(':dtnascimento', $dados['dtnascimento'], PDO::PARAM_STR);
                            $add_pay->bindParam(':id', $Tuid);
                            $add_pay->execute();

                            unset($dados);
                            //echo $attachment['name'];
                            //echo "AAAA ".$Uid;
                            if ((isset($attachment['name'])) and (!empty($attachment['name']))) {
                                ///Recuperar último ID inserido no banco de dados
                                //$last_id = $conn->lastInsertId();
                                //echo "$last_id";
                                //Diretório onde o arquivo será salvo

                                $directory = '../images/turistas/' . $Tuid . "/";

                                //Criar o diretório
                                mkdir($directory, 0755);
                                //echo $directory;

                                //Upload do arquivo
                                $file = $attachment['name'];
                                move_uploaded_file($attachment['tmp_name'], $directory . $file);
                                echo " OK Imagem enviada com sucesso ! <br>";
                                header("Location: ../usuarios/PainelTurista.php");
                            }
                            echo " Imagem nao enviada ! <br>";
                            echo "";
                        }
                    } catch (Exception $e) {
                        echo "Erro: Mensagem de contato não enviada com sucesso 1 !<br>" . $e;
                    }


                    ?>


                    <!-- Linha ROW de tudo -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" style="min-height: 400px; padding: 20px; ">
                            <!-- Deve ser possivel alterar alguns dados do Perfil do Usuario GUIA -->

                            <form name="add_msg" method="POST" enctype="multipart/form-data" action="">
                                <div class="row">
                                    <br>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" style="padding: 10px; border: 0.5px dotted gray;">
                                        <label style="font-size: larger; color: black;"> Foto </label>

                                        <div class="card">

                                                    <img style="max-height: 200px; max-width: 200px; background-color: gray;"
                                                                src='<?php echo "../images/turistas/$Tuid/$image"; ?>'
                                                                value="
                                                                <?php if(isset($dados['image']))
                                                                { echo $dados['image']; }elseif(isset($row_turista['image']))
                                                                { echo $row_turista['image']; }?>" class="card-img-top" alt="Carregar Foto..." >
                                            <input type="file" name="attachment" id="attachment" onchange="previewImagem()">
                                        </div>

                                    </div>

                                    <br>

                <div class="col-xl-12 col-lg-8 col-md-12 col-sm-12">
                    <label>Apelido</label>
                    <h6><input class="form-control" type="text" name="apelido" id="apelido"
                                value="<?php if (isset($dados['apelido'])) {
                            echo $dados['apelido'];
                        } elseif (isset($row_turista['apelido'])) {
                            echo $row_turista['apelido'];
                        } ?>"required> <br>
                    </h6>
                </div>

                <div class="col-xl-12 col-lg-8 col-md-12 col-sm-12">
                    <label>Nome</label>
                    <h6><input class="form-control" type="text" name="name" id="name"
                                value="<?php if (isset($dados['name'])) {
                            echo $dados['name'];
                        } elseif (isset($row_turista['name'])) {
                            echo $row_turista['name'];
                        } ?>">
                    </h6>
                </div>

                <div class="col-xl-12 col-lg-8 col-md-12 col-sm-12">
                    <label>UF</label>
                    <h6><input class="form-control" type="text" name="uf" id="uf"
                                value="<?php if (isset($dados['uf'])) {
                            echo $dados['uf'];
                        } elseif (isset($row_turista['uf'])) {
                            echo $row_turista['uf'];
                        } ?>">
                    </h6>
                </div>

                <div class="col-xl-12 col-lg-8 col-md-12 col-sm-12">
                    <label>Cidade</label>
                    <h6><input class="form-control" type="text" name="cidade" id="cidade"
                                value="<?php if (isset($dados['cidade'])) {
                            echo $dados['cidade'];
                        } elseif (isset($row_turista['cidade'])) {
                            echo $row_turista['cidade'];
                        } ?>">
                    </h6>
                </div>

                <div class="col-xl-12 col-lg-8 col-md-12 col-sm-12">
                    <label>Celular</label>
                    <h6><input class="form-control" type="text" name="celular" id="celular"
                                value="<?php if (isset($dados['celular'])) {
                            echo $dados['celular'];
                        } elseif (isset($row_turista['celular'])) {
                            echo $row_turista['celular'];
                        } ?>">
                    </h6>
                </div>

                <div class="col-xl-12 col-lg-8 col-md-12 col-sm-12">
                    <label>CPF</label>
                    <h6><input class="form-control" type="text" name="cpf" id="cpf"
                                value="<?php if (isset($dados['cpf'])) {
                            echo $dados['cpf'];
                        } elseif (isset($row_turista['cpf'])) {
                            echo $row_turista['cpf'];
                        } ?>">
                    </h6>
                </div>

                <div class="col-xl-12 col-lg-8 col-md-12 col-sm-12">
                    <label>Email</label>
                    <h6><input class="form-control" type="text" name="email" id="email"
                                value="<?php if (isset($dados['email'])) {
                            echo $dados['email'];
                        } elseif (isset($row_turista['email'])) {
                            echo $row_turista['email'];
                        } ?>">
                    </h6>
                </div>

                <div class="col-xl-12 col-lg-8 col-md-12 col-sm-12">
                    <label>Senha</label>
                    <h6><input class="form-control" type="text" name="password" id="password"
                                value="<?php if (isset($dados['password'])) {
                            echo $dados['password'];
                        } elseif (isset($row_turista['password'])) {
                            echo $row_turista['password'];
                        } ?>">
                    </h6>
                </div>

                <div class="col-xl-12 col-lg-8 col-md-12 col-sm-12">
                    <label>Data Nascimento</label>
                    <h6><input class="form-control" type="text" name="dtnascimento" id="dtnascimento"
                                value="<?php if (isset($dados['dtnascimento'])) {
                            echo $dados['dtnascimento'];
                        } elseif (isset($row_turista['dtnascimento'])) {
                            echo $row_turista['dtnascimento'];
                        } ?>">
                    </h6>
                </div>
                                </div><!-- Fim da ROW -->

                            </div><!-- Fim da ROW -->

                        <!-- BOTAO CADASTRAR  -->
                        <div class="row" style="padding-left: 20px; ">
                            <div class="col-12">
                                <h5><input type="submit" value="Atualizar" name="SendAddMsg" class="btn btn text-dark" style="border: 1px solid black;"></h5><br><br>
                            </div>

                        </div>


                        </form>

                    </div>

                </div>

            </div><!-- Fim da DIV Conteiner -->
        </div>
        </div>
    </main>


</body>
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

</html>