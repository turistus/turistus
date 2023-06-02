<?php
define('ACCESS', true);

include_once '../connection.php';

?>
<html lang="pt/br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="shortcut icon" type="imagex/png" href="../images/logooriginal.png">
    <title>Cadastro de Turista</title>
	</head>
	<body>

  <?php
  include_once '../pg/menu.php';
  ?>


		<?php
		if(isset($_SESSION['msg'])){
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}
		?>

<br>
<!-- Primeira LINHA Principal CONTEINER -->
<main class="container">
    <div class="shadow-lg p-3 mb-5 bg-white rounded" style=" border:solid 1px black; " >
        <div class="row">

            <!-- Titulo-->
        <div class="row" style="padding-left: 50px;  margin-bottom: 50px; background: url(../images/bussola.jpg) repeat-x top center;">
            <div class="col-12">
            <h1>Cadastro de Turista</h1>
            </div>
        </div>

<!-- Div inicial abaixo do Titulo -->
<div class="col-10" style=" margin: auto; padding-top: 20px;">
    <div class="col-md-8 order-md-1">
    <!-- Aqui abaixo tenho um exemplo de como usar a
    função cadastrar Turista processado em outra pagina php -->
            <form method="POST" action="processa-cad-turista.php">

                        <div class="row" >



                                        <div class="col-12 mb-3">
                                            <label >Nome </label>
                                            <input type="text" class="form-control" id="nome" placeholder="" name="name" value="<?php
                                                if (isset($dados['name'])) {
                                                    echo $dados['name'];
                                                }?>">
                                            <small class="text-muted">Nome completo.</small>

                                        </div>
                                        <div class="col-10 mb-3">
                                            <label >Email</label>
                                            <input type="email" class="form-control" id="email" placeholder="" name="email" value="<?php
                                                if (isset($dados['email'])) {
                                                    echo $dados['email'];
                                                }?>" required>

                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label >Senha</label>
                                            <input type="password" class="form-control" id="senha" placeholder="****" name="password"
                                            value="<?php
                                                if (isset($dados['password'])) {
                                                    echo $dados['password'];
                                                }?>" required>

                                        </div>

                                    <!-- SEGUNDA PARTE DO FORMULARIO DE CADASTRO DE  -->

                                <div class="col-md-9 mb-3">
                                        <label >Celular </label>
                                        <input type="text" class="form-control" id="celular" placeholder="" name="celular" value="<?php
                                            if (isset($dados['celular'])) {
                                                echo $dados['celular'];
                                            }?>">

                                </div>
                                <div class="col-md-9 mb-3">
                                        <label >Data nascimento</label>
                                        <input type="date" class="form-control" id="dtnascimento" style="width: 150px;" name="dtnascimento"
                                        value="<?php
                                            if (isset($dados['dtnascimento'])) {
                                                echo $dados['dtnascimento'];
                                            }?>" required>
                                </div>

                                <div class="col-auto my-1">
                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input type="checkbox" class="custom-control-input" id="aceite" name="aceite" value="1">
                                        <label class="custom-control-label" for="aceite">Aceito e concordo com os termos de uso</label>
                                        <p><a href="../TERMOS DE USO.pdf">Detalhes</a></p>
                                    </div>
                                </div>
                                     <!-- BOTAO CADASTRAR  -->

                                <div class="row" style="padding-left: 20px; margin-top:30px;">
                                    <div class="col-12">
                                    <input type="submit" class="btn btn-primary" value="Cadastrar"><br><br>
                                    </div>
                                </div>
            </form>
                </div>
            </div>
        </div><!-- Fim da linha ROW GERAL -->
    </div><!-- Fim da class Redonda -->
</main>
 <?php
  include_once '../rodape.php';
  ?>
	</body>
</html>

