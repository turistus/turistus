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
    <title>GUIA</title>
	</head>
	<body>

  <?php
  include_once 'menuFora.php';
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
    <!-- esse ROOUNDed arredonda as bordas-->
<div class="shadow-lg p-3 mb-5 bg-white rounded" style="border: solid 1px black;">
    <!-- Primeira LINHA Principal-->
    <div class="row">
<!-- Titulo-->
        <div class="row" style="padding-left: 100px;  margin-bottom: 50px; background: url(../images/bussola.jpg) repeat-x top center;">
            <div class="col-12">
            <h1>Cadastro de Guia Nativo</h1>
            </div>
        </div>




<!-- Div inicial abaixo do Titulo -->
<div class="col-10" style=" margin: auto; padding-top: 20px; border: solid 1px black;">
    <div class="col-md-8 order-md-1">

        <form method="POST" action="processa-cad.php">


                    <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12">
                        <label >Nome </label>
                        <input type="text" class="form-control" id="nome" placeholder="" name="nome" value="<?php
                            if (isset($dados['nome'])) {
                                echo $dados['nome'];
                            }?>">
                        <small class="text-muted">Nome completo.</small>
                    </div>


                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-9">
                        <label >CPF</label>
                        <input type="text" class="form-control" id="cpf" placeholder="" name="cpf" value="<?php
                            if (isset($dados['cpf'])) {
                                echo $dados['cpf'];
                            }?>">
                        <small class="text-muted">*</small>

                    </div>

                    <hr>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <label >Email</label>
                        <input type="email" class="form-control" id="email" placeholder="" name="email" value="<?php
                            if (isset($dados['email'])) {
                                echo $dados['email'];
                            }?>" required>

                      </div>

                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                        <label >Senha</label>
                        <input type="password" class="form-control" id="senha" placeholder="****" name="senha"
                        value="<?php
                            if (isset($dados['senha'])) {
                                echo $dados['senha'];
                            }?>" required>

                    </div>

                    <hr>



<!-- SEGUNDA PARTE DO FORMULARIO DE CADASTRO DE GUIA NATIVO -->


        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
            <label >Celular </label>
                <input type="text" class="form-control" id="celular" placeholder="" name="celular" value="<?php
                            if (isset($dados['celular'])) {
                                echo $dados['celular'];
                            }?>
                ">
                        <small class="text-muted">*</small>

        </div>


        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-5">
            <label >Data nascimento</label>
                <input type="text" class="form-control" id="dtnascimento" placeholder="##/##/####" name="dtnascimento"
                        value="<?php
                            if (isset($dados['dtnascimento'])) {
                                echo $dados['dtnascimento'];
                            }?>"required>

        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12" style="padding: 10px;">

            <label class="uf">Estado UF</label>
            <select name="uf" class="custom-select d-block w-100 uf" id="uf">
                <option value="">Selecione</option>
                <option value="AC">AC</option>
                <option value="AL">AL</option>
                <option value="AP">AP</option>
                <option value="AM">AM</option>
                <option value="BA">BA</option>
                <option value="CE">CE</option>
                <option value="DF">DF</option>
                <option value="ES">ES</option>
                <option value="GO">GO</option>
                <option value="MA">MA</option>
                <option value="MT">MT</option>
                <option value="MS">MS</option>
                <option value="MG">MG</option>
                <option value="PA">PA</option>
                <option value="PB">PB</option>
                <option value="PR">PR</option>
                <option value="PE">PE</option>
                <option value="PI">PI</option>
                <option value="RJ">RJ</option>
                <option value="RN">RN</option>
                <option value="RS">RS</option>
                <option value="RO">RO</option>
                <option value="RR">RR</option>
                <option value="SC">SC</option>
                <option value="SP">SP</option>
                <option value="SE">SE</option>
                <option value="TO">TO</option>
            </select>
</div>



        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
            <label >Valor Guia </label>
                <input type="text" class="form-control" id="valor" placeholder="R$.." name="valor" value="<?php
                            if (isset($dados['valor'])) {
                                  echo $dados['valor'];
                            }?>">
                        <small class="text-muted">*</small>
        </div>

        <div class="col-auto my-1">
            <div class="custom-control custom-checkbox mr-sm-2">
                <input type="checkbox" class="custom-control-input" id="aceite" name="aceite" value="1">
                <label class="custom-control-label" for="aceite">Aceito e concordo com os termos de uso</label>
                <a href="../TERMOS DE USO.pdf" class="btn btn-primary">Detalhes</a>
            </div>
        </div>

<!-- BOTAO CADASTRAR  -->

                      <div class="row" style="padding-left: 20px; margin-top:30px;">
                          <div class="col-12">
                           <input class="btn btn-primary" type="submit" value="Cadastrar"><br><br>
                          </div>
                      </div>
    	</form>
    </div>
    <div class="col-10" style=" margin: auto; padding-top: 20px; border: solid 1px black;">
        <h5>Todos os guias devem respeitar as normas e orientações descritas no termo de uso.</h5>
    </div>

<!-- Busca PT   -->

    </div>
<!-- FIM DA DIV do CADASTRO do GUIA -->



    </div><!-- fim Div ROW  -->


      </div><!-- Fim da DIV SHADOWN-->

</div>
</main><!-- Fim da div CONTEINER  -->
 <?php
  include_once '../rodape.php';
  ?>
	</body>
</html>
