<?php
session_start();
define('ACCESS', true);
include_once '../connection.php';



$sessionId = $_SESSION['user_id'];
$sessionEmail = $_SESSION['user_email'];



?>

<!doctype html>
<html lang="pt/br">

<head>
  <title>Painel Turista</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <link href='https://fonts.googleapis.com/css?family=EB Garamond' rel='stylesheet'>
</head>

<body style="font-family: 'EB Garamond';font-size: 20px;">

<?php
  include_once 'menuPainelTurista.php';
?>


<div class="row">
<!--            só espaço mesmo   PRECISO manter uma SESSAO aberta com email e senha ou oque eu precisar para liberar as outras coisas como pontos pagos

            PRECISA SER ATUALIZADO AUTOMATICAMENTE QUANDO TURISTA ESTIVER FEITO O
            PAGAMENTO, O STATUS DO PEDIDO VAI ESTAR ID 5 entao pode aparecer no

            PAINEL DE AGENDAMENTO DO USUARIO TURISTA


            // a Mesma coisa se repete para a AGENDA de TURISTA
            //por DATA
            // para quando houver INSERT da tabela payments_picpays O STATUS DO PEDIDO VAI ESTAR ID 5
            // deve se ser pesquisado a ultima transação  e descobrir de que GUIA é
            // e a data para mostrar no PAINEL DO TURISTA pela tabela AGENDATuristaGuia
-->

</div>
  <main class="container" style="border-left: solid 1px black;">

        <!-- O usuario tem um agendamento de um evento -->
   
   <div class="container" >
                  

                    <h2 class="display-4 mt-5 mb-5">Bem Vindo, <?php echo $name?></h2>
                    <?php
                    if(isset($_SESSION['msg'])){
                      echo $_SESSION['msg'];
                      //unset($_SESSION['msg']);
                    }
                    ?>
                    
                    
                  <div class="row">
                      <!-- Esse Col-1 deixa apenas 1 coluna para o menu vertical -->
                     <!-- PAINEL a esquerda PERFIL -->                 
                    <div class="modal-content col-3"  style="padding: 10px;">
                                  
                        <h3>PERFIL </h3>  
                        <img src='https://github.com/mdo.png' alt='perfil_foto' width='48' height='48' class='rounded-circle'>
                        
                        <br>
                        <p>Nome Completo </p>
                        <button id="editar" type="button" class="btn btn-light text-white me-1 col-3 "  > Editar </button>
                        <button type="button" class="btn btn-light text-white me-1 col-3" > <a href="../lgn/logout.php"> Sair </a></button>
                        <p>Cidade </p>
                        <p>Frase </p>
                        <hr>
                        <h3>Fotos</h3>
                      </div>
                      
                                            
                  <!-- BOTAO de ACESSAR o Pontos Criar Eventos -->
                  <div class="dialog col-9">
                      <div class="modal-content">
                          <div class="modal-body">
                                <!-- linha ROW de BOTOES do PAINEL -->
                                <div class="row" style=" padding: 20px;">
                                    <button id="Painel" type="button" class="btn btn-light text-white me-2" > Painel </button>
                                    <button id="EventosLiberados" type="button" class="btn btn-light text-white me-2"> EVENTOS Liberados </button>
                                    <!--<button id="segundoForm" type="button" class="btn btn-light text-white me-2"> Pontos Liberados </button>-->
                                    <button id="terceiroForm" type="button" class="btn btn-light text-white me-2"> Fotos </button>
                                    <!--<button id="quartoForm" type="button" class="btn btn-light text-white me-2"> PT Pagos </button>-->
                                    <button type="button" class="btn btn-danger text-white me-2"><a href="../lgn/logout.php" class="nav-link px-2 link-secondary">Sair</a></button>
                                </div>

                              <br>



                                  <!-- CONTENT Eventos Liberados --> 
                                <div class="modal-content" id=formEventosLiberados>
                                    
                                  
                                  <?php
                                      include_once 'funcoes/eventosLiberados.php';
                                  ?>


                                </div>

                                
                                 <!-- CONTENT PAINEL -->                 
                                <div class="modal-content" id=formPainel style="padding: 10px;">
                                  
                                    PERFIL / CONTAGENS / NUMEROS

                                </div>
                                  <!-- CONTENT pontos liberados --> 
                                <div class="modal-content" id=formSegundo style="padding-bottom: 20px;">
                                  
                                  <?php
                                      include_once 'funcoes/pontosLiberados.php';
                                  ?>
            
                                </div>
                                  
                                <!-- CONTENT PAINEL -->
                                <div class="modal-content" id=formTerceiro style="padding: 10px;">
                                    a            
                                </div>

                                  <!-- CONTENT PAINEL --> 
                                <div class="modal-content" id=formQuarto style="padding-bottom: 20px;">
                                  
                                    
            
                                </div>
                          </div>
                      </div>
              </div><!-- Final da MODAL DIALOG BUTONES-->
    </div><!-- Final da segunda ROW Principal -->


                  </div>
   </div>
</main>

<?php
  include_once '../rodape.php';
?>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    
    $("#formPainel").hide();
    $("#formEventosLiberados").hide();
    $("#formTerceiro").hide();
    $("#formQuarto").hide();
    $("#formSegundo").hide();

  $("#EventosLiberados").click(function () {
		$("#formEventosLiberados").show(500);
    $("#formPainel").hide();
    $("#formTerceiro").hide();
    $("#formQuarto").hide();
    $("#formSegundo").hide();
	});

  $("#Painel").click(function () {
		$("#formPainel").show(500);
    $("#formEventosLiberados").hide();
    $("#formTerceiro").hide();
    $("#formQuarto").hide();
    $("#formSegundo").hide();
	});

  $("#segundoForm").click(function () {
		$("#formSegundo").show(500);
    $("#formPainel").hide();
    $("#formEventosLiberados").hide();
    $("#formTerceiro").hide();
    $("#formQuarto").hide();
	});

  $("#terceiroForm").click(function () {
		
    $("#formPainel").hide();
    $("#formEventosLiberados").hide();
    $("#formTerceiro").show(500);
    $("#formQuarto").hide();
    $("#formSegundo").hide();
	});

  $("#quartoForm").click(function () {
		$("#formPainel").hide();
    $("#formEventosLiberados").hide();
    $("#formTerceiro").hide();
    $("#formQuarto").show(500);
    $("#formSegundo").hide();
	});

 

  });
</script>