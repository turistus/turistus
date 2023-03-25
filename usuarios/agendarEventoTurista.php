<?php
define('ACCESS', true);

include_once '../connection.php';
session_start();
ob_start();

//$sv = "SELECT * FROM servicos WHERE id = '$Uid' ORDER BY id ASC";

//echo $_SESSION['user_id'];
$Uid = $_SESSION['user_id'];
//$nome = $_SESSION['user_nome'];
if (empty($Uid)) {
    header("Location: cadastros/cadastrarturista.php");
    die("Erro: página encontrada!<br>");
}

//$email = $_SESSION['user_email'];
//echo $nome;
//$idT = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$idGuia = filter_input(INPUT_POST, "idGuia", FILTER_SANITIZE_NUMBER_INT);

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
        <div class="row" style="padding-left: 50px;  margin-bottom: 50px; padding-top:10px; background: url(../images/bussola.jpg) repeat-x top center;">
            <div class="col-12">
            <h1><ion-icon name="book-sharp"></ion-icon>  Agendar Evento</h1>
            </div>
        </div>

<!-- Div inicial abaixo do Titulo -->
<div class="col-10" style=" height: 400px; margin: auto; padding-top: 20px; border: dotted 0.5px black;">
    <div class="col-md-8 order-md-1">
    <!-- Aqui abaixo tenho um exemplo de como usar a
    função cadastrar Turista processado em outra pagina php -->
            <form method="POST" action="processa-cad-agenda-turista.php">
                    
                                               
                <!-- SEGUNDA PARTE DO FORMULARIO DE CADASTRO DE EVENTO -->


                            
                <div class="col-md-6">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-mb-12">

                                        <div class="col-md-6 mb-3">
                                            <label >ID do TURISTA Escondido</label>
                                            <input type="text" class="form-control" id="valorTotal" placeholder="" name="valorTotal" 
                                            value="<?php
                                                if (isset($valorTotal)) {
                                                    echo $UvalorTotal;
                                                }?>" >
                                           
                                        </div>
                                    
                                    <div class="col-md-6 mb-3">
                                            <label >Valor Total</label>
                                            <input type="text" class="form-control" id="valorTotal" placeholder="" name="valorTotal" 
                                            value="<?php
                                                if (isset($valorTotal)) {
                                                    echo $UvalorTotal;
                                                }?>" >
                                           
                                        </div>
                                        
                                        

                            
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
            
      LOGADO ANTES USUARIO                 
            
            

                </div>
            </div>
        </div><!-- Fim da linha ROW GERAL -->
    </div><!-- Fim da class Redonda -->
</main>
 <?php
  include_once '../rodape.php';
  ?>
	</body>
    <script  type = "module"  src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js" > </script> 
<script  nomodule  src="https://unpkg .com/ionicons@5.5.2/dist/ionicons/ionicons.js" > </script>
</html>

