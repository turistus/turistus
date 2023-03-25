<?php
define('ACCESS', true);

include_once '../connection.php';
session_start();
ob_start();

//$sv = "SELECT * FROM servicos WHERE id = '$Uid' ORDER BY id ASC";

//echo $_SESSION['user_id'];
$Uid = $_SESSION['user_id'];
$nome = $_SESSION['user_name'];
$email = $_SESSION['user_email'];
echo $nome;

?>
<html lang="pt/br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Cadastro de Eventos</title>
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
            <h1>Cadastro de Eventos</h1>
            </div>
        </div>

<!-- Div inicial abaixo do Titulo -->
<div class="col-10" style=" margin: auto; padding-top: 20px; border: solid 1px black;">
    <div class="col-md-8 order-md-1">
    <!-- Aqui abaixo tenho um exemplo de como usar a
    função cadastrar Turista processado em outra pagina php -->
            <form method="POST" action="processa-cad-evento.php">
                    
                        <div class="row" >
                        <!-- as melhores colunas organizadas da maior para menor -->    
                                    <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12 mb-12">
                                    
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-mb-12">
                                            <label >Nome do turismo</label>
                                            <input type="text" class="form-control" id="nome" placeholder="" name="nome"
                                            value="<?php
                                                if (isset($dados['nome'])) {
                                                    echo $dados['nome'];
                                                }?>" required>
                                        </div>

                                        <div class="col-xl-6 col-lg-6  col-md-9 col-sm-7 col-mb-3">
                                            <label >Data e Hora </label>
                                            <input type="dateHour" class="form-control" id="datah" placeholder="" name="datah" value="<?php
                                                if (isset($dados['datah'])) {
                                                    echo $dados['datah'];
                                                }?>">
                                            
                                            
                                        </div>
                                        <div class="col-xl-12 col-lg-12  col-md-12 col-sm-12 col-mb-12">
                                            <label >descricao</label>
                                            <input style=" height:100px;" type="textarea" class="form-control" id="descricao" placeholder="" name="descricao" value="<?php
                                                if (isset($dados['descricao'])) {
                                                    echo $dados['descricao'];
                                                }?>" required>
                                            <small class="text-muted">*</small>
                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-mb-12">
                                            <label >valor</label>
                                            <input type="text" class="form-control" id="valor" placeholder="" name="valor" 
                                            value="<?php
                                                if (isset($dados['valor'])) {
                                                    echo $dados['valor'];
                                                }?>" required>
                                            <small class="text-muted">*</small>
                                        </div>
                                    </div>
                        </div><!-- Fim da ROW -->
                        
                <!-- SEGUNDA PARTE DO FORMULARIO DE CADASTRO DE EVENTO -->


                            
                <div class="col-md-6">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-mb-12">

                        <label >Ponto Turistico</label> 
                            <select name="idPt"><!-- importante esse NAME aqui pelo oque entendi levou o dado par o form idPT -->
                                <option>Selecioneee</option>
                                


                                        <?php
                                           
                                            $result = $conn->prepare("SELECT * FROM pontosturisticos ORDER BY name ASC;");
                                            $result->execute();
                                            $res = $result->fetchAll(PDO::FETCH_ASSOC);
                                        ?>
                                        <?php   
                                            foreach($res as $ln ){
                                        ?>
                                                <option value="<?php echo $ln['id'];?>" name="idPt" id="idPt" >

                                                    <?php 
                                                       // echo $ln['id'].' - <br/>';
                                                        echo $ln['name'].' | $:';
                                                        echo $ln['price'];
                                                    
                                                        if (isset($ln['id'])) {
                                                            //echo $ln['id'];
                                                        }


                                            }       ?>
                                                </option> 
				            </select>
<!-- Aqui Busca CERTINHO o nome e o ID do ponto turistico para o EVENTO ser cadastrado -->
                            
                                       
                                            
                                        <small class="text-muted">*</small>
                                </div>

                                <div class="col-md-6 mb-3">
                                            <label hidden >Seu ID GUIA</label>
                                            <input hidden type="text" class="form-control" id="idGuia" placeholder="" name="idGuia" 
                                            value="<?php
                                                if (isset($Uid)) {
                                                    echo $Uid;
                                                }?>" >
                                           
                                        </div>

                        <!-- BOTAO CADASTRAR  -->

                                <div class="row" style="padding-left: 20px; margin-top:30px;">
                                    <div class="col-6">
                                    <input type="submit" value="Cadastrar"><br><br>
                                    </div>
                                    <div class="col-6">           
                                    <input type="reset" name="bt_limpar" value="Limpar campos">
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

