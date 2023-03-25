<?php
session_start();

define('ACCESS', true);
include_once '../adm/connection.php';
include_once '../adm/validate.php';

?> 

<!DOCTYPE HTML>
<html lang="pt-br">  
    <head>  
        <meta charset="utf-8">
        <title>Desconecta ADM - Listar eventos</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>
    <body>
		
		<?php
        include_once './menu.php';
        ?>
		<div>
			<h1>EVENTOS</h1>

		</div>

		<main class="content">

		<!-- BOTAO de ACESSAR o Pontos Criar Eventos -->
		<div class="dialog">
                      <div class="modal-content">
                          <div class="modal-body">
                              
                                <div class="row">
                                    <button id="primeiroForm" type="button" class="btn btn-light text-dark me-2"> Informações e Avisos </button>
                                    <button id="CriarEvento" type="button" class="btn btn-light text-dark me-2"> Listar Eventos </button>
                                    <button id="segundoForm" type="button" class="btn btn-light text-dark me-2"> Total R$ P/ Guia </button>
                                    <button id="terceiroForm" type="button" class="btn btn-light text-dark me-2"> Terceiro </button>
                                    <button id="quartoForm" type="button" class="btn btn-light text-dark me-2"> Quarto </button>
                                    <button type="button" class="btn btn-danger text-dark me-2"><a href="../lgn/logout.php" class="nav-link px-2 link-secondary">Sair</a></button>
                                </div>

                              <br>

                                <div class="modal-content" id=formCriarEvento style="padding: 15px;">
                                 
                                      
                                        <h2>Listar EVENTOS CRIADOS PELOS GUIAS</h2>
                                        Aqui são apresentado os EVENTOS criado por GUIAS e seus valores e codigos.devemos poder editar ou desativar evento por aqui mais pra frente
                                        <hr>
                                        <span id="conteudo"></span>
                                      
                                    
                                      
                                </div>
                                                  
                                <div class="modal-content" id=formPrimeiro>
                                                        
										              <h2>Informações e Avisos do Evento</h2>

															
								                </div>

                                <div class="modal-content" id=formSegundo style="padding: 15px; margin:20px;">
                                  
                                  <h2>Valor Ganho Por Guia</h2>

                                       <p>Como PAGAR os 80% Do GUIA <br> 
                                       0 - Ter o Agendamento de confirmado e PAGO.<br>
                                       1 - Buscar os Eventos realizados e agendados Por CADA Turista e PAGO. <br>
                                       </p>
     
                                        <!-- <span id="conteudoAgendados"></span> -->

                                        
                                        
                                        <h2 class="display-4 mt-3 mb-3">Pedidos EVENTOS pagos Agendados de Turistas </h2>
                                        
                                        <hr>
                                            Aqui a lista deve mostrar os Pedidos/EVENTOS que estao agendados, Se Foi Pago PIC PAY, Entao Pagar o GUIA?
                                          <br>
                                          Devemos pagar SOMENTE depois que passar da data do evento e perguntar se foi feito para o turista.
                                        <?php
                                        if(isset($_SESSION['msg'])){
                                            echo $_SESSION['msg'];
                                            unset($_SESSION['msg']);
                                        }
                                        ?>
                                        <hr>
                                    
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr style="background-color: #DAA520;">
                                                    <th scope="col">ID </th>
                                                    <th scope="col">Turista </th>
                                                    <th scope="col">E-mail <br> Celular</th>
                                                    <th scope="col">EVENTO</th>
                                                    <th scope="col" class="text-center">AGENDADO <br>Dia</th>
                                                    
                                                
                                                    <th scope="col" class="text-center">Guia Nativo</th>
                                                    
                                                    <th scope="col" class="text-center">VALOR</th>
                                                    <th scope="col" class="text-center">Valor -20% Guia</th>
                                                    <th scope="col" class="text-center">DEPOSITAR</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $query_payments = "SELECT 
                                                pay.id AS idPag, 
                                                pay.first_name, 
                                                pay.email,
                                                pay.payments_statu_Id AS statusPay,
                                                pay.created AS dataPedido,
                                                
                                                                                                
                                                
                                                guias.nome AS nomeGuia,
                                                guias.celular AS numeroGuia,
                                                even.nome AS nomeEvento,
                                                even.valor AS valor,
                                                pay.phone AS phone,
                                                pay.dataagendada AS dataagendada
                                                
                                                FROM payments_picpays AS pay
                                                /**Aqui abaixo Busca os STATUS que estão na TABELA Payments PIC PAY  */
                                                
                                                INNER JOIN eventos AS even ON even.id = pay.product_id 
                                                      INNER JOIN pontosturisticos ON pontosturisticos.id = even.idPt
                                                      INNER JOIN servicos AS guias ON guias.id = pay.guiaId
                                               
                                                
                                                ORDER BY idPag DESC LIMIT 13";
                                            $result_payments = $conn->prepare($query_payments);
                                            $result_payments->execute();
                                            while ($row_payment = $result_payments->fetch(PDO::FETCH_ASSOC)) {
                                                //var_dump($row_payment);
                                                extract($row_payment);
                                                echo "<tr>";
                                                echo "<th>$idPag</th>";
                                                echo "<td>$first_name</td>";
                                                echo "<td>$email <br> $phone </td>";
                                                echo "<td>$nomeEvento</td>";
                                                echo "<td>". date('d/m/Y',  strtotime($dataagendada)) ."</td>";
                                               
                                                
                                                echo "<td>$nomeGuia - $numeroGuia Numero PIX</td>";
                                                echo "<td> R$ $valor  </td>";

                                                $valor20p = $valor - $valor*0.2;
                                                echo "<td> R$ $valor20p  </td>";
                                                echo "<td> Pagar/Depositar  </td>";
                                                echo "</tr>";

                                            }
                                            ?>
                                        </table>

                                    










                                </div>

                                <div class="modal-content" id=formTerceiro>
                                  
                                  AAA3
            
                                </div>
                                  
                                <div class="modal-content" id=formQuarto>
                                  
                                  AAA4
            
                                </div>
                          </div>
                      </div>
              </div><!-- Final da MODAL DIALOG BUTONES-->



		</main>
		
    </body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    
    $("#formPrimeiro").show();
    $("#formCriarEvento").hide();
    $("#formTerceiro").hide();
    $("#formQuarto").hide();
    $("#formSegundo").hide();

  $("#CriarEvento").click(function () {
		$("#formCriarEvento").show(500);
    $("#formPrimeiro").hide();
    $("#formTerceiro").hide();
    $("#formQuarto").hide();
    $("#formSegundo").hide();
	});

  $("#primeiroForm").click(function () {
		$("#formPrimeiro").show(500);
    $("#formCriarEvento").hide();
    $("#formTerceiro").hide();
    $("#formQuarto").hide();
    $("#formSegundo").hide();
	});

  $("#segundoForm").click(function () {
		$("#formSegundo").show(500);
    $("#formPrimeiro").hide();
    $("#formCriarEvento").hide();
    $("#formTerceiro").hide();
    $("#formQuarto").hide();
	});

  $("#terceiroForm").click(function () {
		
    $("#formPrimeiro").hide();
    $("#formCriarEvento").hide();
    $("#formTerceiro").show(500);
    $("#formQuarto").hide();
    $("#formSegundo").hide();
	});

  $("#quartoForm").click(function () {
		$("#formPrimeiro").hide();
    $("#formCriarEvento").hide();
    $("#formTerceiro").hide();
    $("#formQuarto").show(500);
    $("#formSegundo").hide();
	});

 

  });

  var qnt_result_pg = 10; //quantidade de registro por página
 var pagina = 1; //página inicial
 $(document).ready(function () {
 listar_usuario(pagina, qnt_result_pg); //Chamar a função para listar os registros
                               });
                                        
  function listar_usuario(pagina, qnt_result_pg){
    var dados = {
                pagina: pagina,
                qnt_result_pg: qnt_result_pg
                }
  $.post('listar_Evento.php', dados , function(retorna){
    //Subtitui o valor no seletor id="conteudo"
    $("#conteudo").html(retorna);
                                 });
                              }


</script>


