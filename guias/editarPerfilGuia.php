
<?php
define('ACCESS', true);
include_once '../connection.php';
session_start();
ob_start();

//$Uid = $_SESSION['user_id'];
$Aid = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
echo $Aid;
if (empty($Aid)) {
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Perfil não encontrado!</p>";
    header("Location: painelGuia.php");
    exit();
}

$query_busca_guia = "SELECT * FROM servicos WHERE servicos.id = $Aid";
$guia_selecionado = $conn->prepare($query_busca_guia);
$guia_selecionado->execute();



if(($guia_selecionado) AND ($guia_selecionado->rowCount() != 0) ){
    $row_guia = $guia_selecionado->fetch(PDO::FETCH_ASSOC);
    //echo $row_guia['nome'];
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
        <link rel="shortcut icon" href="../images/icon/favicon.ico" >
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <title>Editar Perfil</title>
        <link rel="shortcut icon" type="imagex/png" href="../../images/icon/LG.jpg">
    </head>



    <body>
            <main class="content">
        <div class="shadow-lg p-3 mb-5 bg-white rounded" style="border: solid 1px black;">
            <!-- PRIMEIRA LINHA -->
            <div class="row" >

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
                        //echo $attachment['name'] ."AAAAA";
                        //var_dump($attachment);
                        //Salvar os dados no bd

                        $result_markers = "UPDATE servicos SET
                        image = :image, apelido = :apelido, nome = :nome, cpf = :cpf, email = :email, senha = :senha,
                        celular = :celular, dtnascimento = :dtnascimento, uf = :uf, aceite = 1,
                        banco = :banco, agencia = :agencia, conta = :conta, pix = :pix
                        WHERE servicos.id = :id ";
                        $add_pay = $conn->prepare($result_markers);

                        $add_pay->bindParam(':image', $attachment['name'], PDO::PARAM_STR);
                        $add_pay->bindParam(':apelido', $dados['apelido'], PDO::PARAM_STR);
                        $add_pay->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
                        $add_pay->bindParam(':cpf', $dados['cpf'], PDO::PARAM_STR);
                        $add_pay->bindParam(':email', $dados['email'], PDO::PARAM_STR);
                        $add_pay->bindParam(':senha', $dados['senha'], PDO::PARAM_STR);
                        $add_pay->bindParam(':celular', $dados['celular'], PDO::PARAM_STR);
                        $add_pay->bindParam(':dtnascimento', $dados['dtnascimento'], PDO::PARAM_STR);
                        $add_pay->bindParam(':uf', $dados['uf'], PDO::PARAM_STR);
                        $add_pay->bindParam(':banco', $dados['banco'], PDO::PARAM_STR);
                        $add_pay->bindParam(':agencia', $dados['agencia'], PDO::PARAM_STR);
                        $add_pay->bindParam(':conta', $dados['conta'], PDO::PARAM_STR);
                        $add_pay->bindParam(':pix', $dados['pix'], PDO::PARAM_STR);
                        $add_pay->bindParam(':id', $Aid);
                            $add_pay->execute();
                            unset($dados);
                            //header("Location: painelGuia.php");
                            //echo "AAAA ".$Uid;
                                if ((isset($attachment['name'])) AND (!empty($attachment['name']))) {

                                    $directory = '../images/guias/' . $Aid . "/";

                                    //Criar o diretório
                                    mkdir($directory, 0755);
                                    //echo $directory;

                                    //Upload do arquivo
                                    $file = $attachment['name'];
                                    move_uploaded_file($attachment['tmp_name'], $directory . $file);
                                    echo " OK Imagem enviada com sucesso ! <br>";
                                    header("Location: ../guias/painelGuia.php");
                                }
                                echo " Imagem enviada com sucesso ! <br>";
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
                                    <div class="row" >
                                        <br>
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" style="padding: 10px; border: 0.5px dotted gray;">
                                                        <label style="font-size: larger; color: black;"> Foto </label>

                                                            <div class="card">

                                                                <img style="max-height: 200px; max-width: 200px; background-color: gray;"
                                                                src='<?php echo "../images/guias/$Aid/$image"; ?>'
                                                                value="
                                                                <?php if(isset($dados['image']))
                                                                { echo $dados['image']; }elseif(isset($row_guia['image']))
                                                                { echo $row_guia['image']; }?>" class="card-img-top" alt="Carregar Foto..." >
                                                            <input type="file" name="attachment" id="attachment" onchange="previewImagem()">
                                                            </div>

                                                    </div>

                                                    <br>

                                                        <div class="col-xl-12 col-lg-8 col-md-12 col-sm-12">
                                                                <label style="font-size: larger; color: black;" >Apelido</label>
                                                                <input class="form-control" type="text" name="apelido" id="apelido"
                                    value="<?php if(isset($dados['apelido']))
                                    { echo $dados['apelido'];}elseif(isset($row_guia['apelido']))
                                    { echo $row_guia['apelido']; }?>"required> <br>
                                                        </div>
                                                        <br>
                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                                <label style="font-size: larger; color: black;">Nome Completo</label>

                                    <input class="form-control" type="text" name="nome" id="nome"
                                    value="<?php if(isset($dados['nome']))
                                    { echo $dados['nome'];}elseif(isset($row_guia['nome']))
                                    { echo $row_guia['nome']; }?>"required> <br>
                                                        </div>

                                                        <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12">
                                                            <label style="font-size: larger; color: black;">CPF </label>
                                                            <input class="form-control" type="text" name="cpf" id="cpf"
                                    value="<?php if(isset($dados['cpf']))
                                    { echo $dados['cpf'];}elseif(isset($row_guia['cpf']))
                                    { echo $row_guia['cpf']; }?>"required> <br>
                                                                    <small class="text-muted">999.999.999-99</small>
                                                        </div>

                                                        <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12">
                                                            <label style="font-size: larger; color: black;">Celular</label>
                                                            <input class="form-control" type="text" name="celular" id="celular"
                                    value="<?php if(isset($dados['celular']))
                                    { echo $dados['celular'];}elseif(isset($row_guia['celular']))
                                    { echo $row_guia['celular']; }?>"required> <br>
                                                                    <small class="text-muted">(99) 9.9999-9999</small>
                                                        </div>

                                                        <div class="col-xl-9 col-lg-3 col-md-12 col-sm-12">
                                                            <label style="font-size: larger; color: black;">Data Nascimento</label>
                                                            <input class="form-control" type="date" name="dtnascimento" id="dtnascimento"
                                    value="<?php if(isset($dados['dtnascimento']))
                                    { echo $dados['dtnascimento'];}elseif(isset($row_guia['dtnascimento']))
                                    { echo $row_guia['dtnascimento']; }?>"required> <br>
                                                        </div>

                                                        <div class="col-xl-9 col-lg-1 col-md-12 col-sm-4">
                                                            <label style="font-size: larger; color: black;">UF</label>
                                                            <input class="form-control" type="text" name="uf" id="uf"
                                    value="<?php if(isset($dados['uf']))
                                    { echo $dados['uf'];}elseif(isset($row_guia['uf']))
                                    { echo $row_guia['uf']; }?>"required> <br>
                                                        </div>

                                                        <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12">
                                                            <label style="font-size: larger; color: black;">Email</label>
                                                            <input class="form-control" type="text" name="email" id="email"
                                    value="<?php if(isset($dados['email']))
                                    { echo $dados['email'];}elseif(isset($row_guia['email']))
                                    { echo $row_guia['email']; }?>"required> <br>
                                                        </div>

                                                        <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12">
                                                            <label style="font-size: larger; color: black;">Senha</label>
                                                            <input class="form-control" type="block" name="senha" id="senha"
                                    value="<?php if(isset($dados['senha']))
                                    { echo $dados['senha'];}elseif(isset($row_guia['senha']))
                                    { echo $row_guia['senha']; }?>"required> <br>
                                                        </div>

                                                                    <!-- CONTA BANCARIA -->
                                                        <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12">
                                                            <label style="font-size: larger; color: black;">Banco</label>
                                                            <input class="form-control" type="text" name="banco" id="banco"
                                    value="<?php if(isset($dados['banco']))
                                    { echo $dados['banco'];}elseif(isset($row_guia['banco']))
                                    { echo $row_guia['banco']; }?>"required> <br>
                                                        </div>

                                                        <div class="col-xl-9 col-lg-5 col-md-12 col-sm-12">
                                                            <label style="font-size: larger; color: black;">Agencia</label>
                                                            <input class="form-control" type="text" name="agencia" id="agencia"
                                    value="<?php if(isset($dados['agencia']))
                                    { echo $dados['agencia'];}elseif(isset($row_guia['agencia']))
                                    { echo $row_guia['agencia']; }?>"required> <br>
                                                        </div>

                                                        <div class="col-xl-9 col-lg-6 col-md-12 col-sm-12">
                                                            <label style="font-size: larger; color: black;">Conta</label>
                                                            <input class="form-control" type="text" name="conta" id="conta"
                                    value="<?php if(isset($dados['conta']))
                                    { echo $dados['conta'];}elseif(isset($row_guia['conta']))
                                    { echo $row_guia['conta']; }?>"required> <br>
                                                        </div>

                                                        <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12">
                                                            <label style="font-size: larger; color: black;">Pix</label>
                                                            <input class="form-control" type="text" name="pix" id="pix"
                                    value="<?php if(isset($dados['pix']))
                                    { echo $dados['pix'];}elseif(isset($row_guia['pix']))
                                    { echo $row_guia['pix']; }?>"required> <br>
                                                        </div>

                                            </div>

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

                    </script>
</html>