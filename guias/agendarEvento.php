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
    <title>Agendar Evento</title>
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
       PRA QUE essa TELA ? 
<br>
<!-- Primeira LINHA Principal CONTEINER -->
<main class="container">
    <div class="shadow-lg p-3 mb-5 bg-white rounded" style=" border:solid 1px black; " >
        <div class="row">

            <!-- Titulo-->
        <div class="row" style="padding-left: 50px;  margin-bottom: 50px; background: url(../images/bussola.jpg) repeat-x top center;">
            <div class="col-12">
            <h1>Agenda de eventos</h1>
            </div>
        </div>

<!-- Div inicial abaixo do Titulo -->
<div class="col-10" style=" margin: auto; padding-top: 20px; border: solid 1px black;">
    <div class="col-md-8 order-md-1">
    <!-- Aqui abaixo tenho um exemplo de como usar a
    função cadastrar Turista processado em outra pagina php -->
            <form method="POST" action="processa-agenda-evento.php">
                    
                        <div class="row" >
                            
                                    <div class="col-md-12">
                                    
                                        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-mb-12">
                                            <label >Data e Hora </label>
                                            <input type="date" class="form-control" id="dHora" placeholder="" name="dHora" value="<?php
                                                if (isset($dados['dHora'])) {
                                                    echo $dados['dHora'];
                                                }?>">
                                            
                                            
                                        </div>
                                        
                                        <div class="col-md-6">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-mb-12">

                                    <label >Eventos Abertos</label> 
                                        <select name="idEvento"><!-- importante esse NAME aqui pelo oque entendi levou o dado para o form IdEVENTO -->
                                            <option>Selecioneee</option>
                                            


                                                    <?php
                                                    
                                                        $result = $conn->prepare("SELECT * FROM eventos ORDER BY nome ASC;");
                                                        $result->execute();
                                                        $res = $result->fetchAll(PDO::FETCH_ASSOC);
                                                    ?>
                                                    <?php   
                                                        foreach($res as $ln ){
                                                    ?>
                                                            <option value="<?php echo $ln['id'];?>" name="idEvento" id="idEvento" >

                                                                <?php 
                                                                // echo $ln['id'].' - <br/>';
                                                                    echo $ln['nome'];
                                                                
                                                                    if (isset($ln['id'])) {
                                                                        echo $ln['id'];
                                                                    }


                                                        }       ?>
                                                            </option> 
                                        </select>
<!-- Aqui Busca CERTINHO o nome e o ID do Evento para o agendA ser cadastrado -->
                            
                                </div>

                                <div class="col-md-6 mb-3">
                                            <label hidden >Seu ID GUIA</label>
                                            <input hidden type="text" class="form-control" id="idGuia" placeholder="" name="idGuia" 
                                            value="<?php
                                                if (isset($Uid)) {
                                                    echo $Uid;
                                                }?>" >
                                           
                                        </div>






                                        

                        </div><!-- Fim da ROW -->
                        
                <!-- SEGUNDA PARTE DO FORMULARIO DE CADASTRO DE GUIA NATIVO -->


                            <div class="col-md-6">
                                
                                <div class="col-md-9 mb-3">
                                        <label >valor Total</label>
                                        <input type="text" class="form-control" id="valorTotal" placeholder="" name="valorTotal"
                                        value="<?php
                                            if (isset($dados['valorTotal'])) {
                                                echo $dados['valorTotal'];
                                            }?>" required>
                                </div>

                                <div class="col-md-9 mb-3">
                                        <label >... Nivel ACESSO</label>
                                        <input type="text" class="form-control" id="nivelAcesso" placeholder="" name="nivelAcesso" value="<?php
                                            if (isset($dados['nivelAcesso'])) {
                                                echo $dados['nivelAcesso'];
                                            }?>">
                                        <small class="text-muted">*</small>
                                </div>
                                                                
                            </div>



                        <!-- BOTAO CADASTRAR  -->

                                <div class="row" style="padding-left: 20px; margin-top:30px;">
                                    <div class="col-12">
                                    <input type="submit" value=" Agendar "><br><br>
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

