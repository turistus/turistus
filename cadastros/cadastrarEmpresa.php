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
    <title>Serviços e Hospedagens·1.0</title>
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
    <!-- esse ROOUNDed arredonda as bordas-->
<div class="shadow-lg p-3 mb-5 bg-white rounded" style="border: solid 1px black;">
    <!-- Primeira LINHA Principal-->
    <div class="row" >
<!-- Titulo-->
        <div class="row" style="padding-left: 100px;  margin-bottom: 50px; background: url(../images/bussola.jpg) repeat-x top center;">
            <div class="col-12">
            <h1>Cadastro de Serviços e Hospedagens</h1>
            </div>
        </div>


<!-- Div inicial abaixo do Titulo -->
<div class="col-10" style=" margin: auto; padding-top: 20px; border: solid 1px black;">
    <div class="col-md-8 order-md-1">
<!-- Aqui abaixo tenho um exemplo de como usar a
    função cadastrar Turista processado em outra pagina php -->
        <form method="POST" action="processa-cad.php">
              
                
                    <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12">
                        <label >Empresa </label>
                        <input type="text" class="form-control" id="nome" placeholder="" name="nome" value="<?php
                            if (isset($dados['nome'])) {
                                echo $dados['nome'];
                            }?>">
                        <small class="text-muted">Nome completo.</small>
                    </div>


                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-9">
                        <label >CNPJ</label>
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
            <label >Contato </label>
                <input type="text" class="form-control" id="celular" placeholder="" name="celular" value="<?php
                            if (isset($dados['celular'])) {
                                echo $dados['celular'];
                            }?>
                ">
                        <small class="text-muted">*</small>
                        
        </div>
                    

        <div class="col-xl-3 col-lg-3 col-md-5 col-sm-5">
            <label >Região</label>
                <input type="text" class="form-control" id="regiao" placeholder="Norte..." name="regiao" value="<?php
                            if (isset($dados['regiao'])) {
                                echo $dados['regiao'];
                            }?>" required>

                    <!-- <select class="form-control">
                        <option value="one">SP</option>
                        <option value="two">PR</option>
                        <option value="three">SC</option>
                        <option value="four">CE</option>
                        <option value="five">MT</option>
                    </select>
                         -->               
        </div>
         
<!-- BOTAO CADASTRAR  -->

                      <div class="row" style="padding-left: 20px; margin-top:30px;">
                          <div class="col-12">
                            <input type="submit" value="Cadastrar"><br><br>
                          </div>
                      </div>
    	</form> 
            </div><!-- Busca PT   -->       
        </div>
    </div><!-- fim Div ROW  -->
</div><!-- Fim da DIV SHADOWN-->


</div>
</main><!-- Fim da div CONTEINER  -->
 <?php
  include_once '../rodape.php';
  ?>
	</body>
</html>
