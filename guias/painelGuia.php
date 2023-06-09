<?php
session_start();
define('ACCESS', true);
include_once '../connection.php';

//ob_start();


//echo $_SESSION['user_id'];
$Uid = $_SESSION['user_id'];
$nome = $_SESSION['user_name'];
$emailusuario = $_SESSION['user_email'];

?>

<!DOCTYPE html>
<html lang="pt/br">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"/>
  <link rel="shortcut icon" type="imagex/png" href="../images/logooriginal.png">
  <title>Painel Do Guia</title>
</head>

<body>

  <?php
    include_once 'menu.php';
  ?>
    <div class="row">
    </div>
  <main class="content">

    <!-- O GUIA tem um agendamento de um evento para fazer tbm -->

    <div class="container" style="padding-bottom: 20px;">

              <!-- BOTAO de ACESSAR o Pontos Criar Eventos -->
              <div class="dialog">
                      <div class="modal-content">
                          <div class="modal-body">

                                <div class="row">
                                    <button id="Painel" type="button" class="btn btn text-dark ">Painel </button>
                                    <button id="terceiroForm" type="button" class="btn btn text-dark "> Pedidos </button>
                                    <button id="CriarEvento" type="button" class="btn btn text-dark "> Criar Evento </button>
                                    <button id="quartoForm" type="button" class="btn btn text-dark "> Eventos </button>
                                    <button id="perfilForm" type="button" class="btn btn text-dark "> Perfil </button>



                                </div>

                              <h4 class="display-6 mt-3 mb-2">Bem vindo, Guia <?php echo $nome?> </h4>
                              <p> Guia: <b>00<?php echo $Uid?></b> Plano: <b><span style="border-radius: 10px; border: black solid 1px; padding:3px;">BÁSICO</span></b> <button id="upgradeForm" class="btn btn-success" style="height: 25px; margin-bottom: 5px; padding: 3px;">  +Upgrade </button></p>
                              <?php if(isset($_SESSION['msg'])){
                                      echo $_SESSION['msg'];
                                      unset($_SESSION['msg']);
                              }?>

                                      <!-- INICIO PAINEL com as funçoes Administrativa  Previsao de vendas -->
                                          <div class="modal-content" id=formPainel style="padding: 10px;">
                                            <div class="row" >
                                              <!-- VALOR TOTAL parte 1 -->
                                                <div class="col-md-6" style="margin-bottom: 30px;">

                                                    <div class="card ">
                                                      <div class="card-body" >
                                                        <h5>Nº Vendas Mensal</h5>
                                                            <?php
                                                            $query_payments = "SELECT
                                                            pay.id AS idagendado,
                                                                pay.first_name,
                                                                pay.phone AS celular,
                                                                pay.guiaId,
                                                                payments_statu_Id,
                                                                pay.product_id,
                                                                pay.dataagendada AS dataagendada,
                                                                pay.created AS quandoCriou,
                                                            eventos.id AS idE,
                                                                eventos.nome AS nE,
                                                                eventos.idPt AS idPt,
                                                                eventos.valor AS valor,
                                                                eventos.idGuia,

                                                                SUM(pay.custoPedido) AS totalVendas,
                                                                COUNT(pay.id) AS nVendas


                                                            FROM payments_picpays AS pay
                                                                INNER JOIN eventos ON eventos.id = pay.product_id
                                                                INNER JOIN servicos ON servicos.id = pay.guiaId
                                                                WHERE pay.guiaId = $Uid AND payments_statu_Id <= 5 ORDER BY idagendado DESC ";


                                                            $result_payments = $conn->prepare($query_payments);
                                                            $result_payments->execute();

                                                            while ($row_payment = $result_payments->fetch(PDO::FETCH_ASSOC)) {
                                                                //var_dump($row_payment);
                                                                extract($row_payment);

                                                            }
                                                            echo "<div class='row' style='margin:5px; padding: 10px; background-color:#B0C4DE; border-radius: 5px;'>";
                                                              echo "<div class='col-md-4'>";
                                                              echo "<h4> ".$nVendas." </h4>";
                                                              echo "</div>";

                                                              echo "<div class='col-md-5'>";
                                                              echo "<h6> Total Vendas <br>R$ ".number_format($totalVendas, 2, ',', '.') ."</h6>";
                                                              echo "</div>";

                                                            echo "</div>";
                                                            ?>
                                                      </div>
                                                    </div>
                                                </div>

                                                <!-- Parte 2 Direita -->
                                                <div class="col-md-6" style="margin-bottom: 30px;">

                                                    <div class="card ">
                                                    <div class="card-body" >
                                                        <h5>Previsão Vendas Anual</h5>
                                                            <?php
                                                            $query_payments = "SELECT
                                                            pay.id AS idagendado,
                                                                pay.first_name,
                                                                pay.phone AS celular,
                                                                pay.guiaId,
                                                                payments_statu_Id,
                                                                pay.product_id,
                                                                pay.dataagendada AS dataagendada,
                                                                pay.created AS quandoCriou,
                                                            eventos.id AS idE,
                                                                eventos.nome AS nE,
                                                                eventos.idPt AS idPt,
                                                                eventos.valor AS valor,
                                                                eventos.idGuia,

                                                                SUM(pay.custoPedido) AS totalVendas,
                                                                COUNT(pay.id) AS nVendas


                                                            FROM payments_picpays AS pay
                                                                INNER JOIN eventos ON eventos.id = pay.product_id
                                                                INNER JOIN servicos ON servicos.id = pay.guiaId
                                                                WHERE pay.guiaId = $Uid AND payments_statu_Id <= 5 ORDER BY idagendado DESC ";


                                                            $result_payments = $conn->prepare($query_payments);
                                                            $result_payments->execute();

                                                            while ($row_payment = $result_payments->fetch(PDO::FETCH_ASSOC)) {
                                                                //var_dump($row_payment);
                                                                extract($row_payment);

                                                            }
                                                            echo "<div class='row' style='margin:5px; padding: 10px; background-color:#E0FFFF; border-radius: 5px;'>";
                                                              echo "<div class='col-md-4'>";
                                                              echo "<h4> Nº ". 12*$nVendas."</h4>";
                                                              echo "</div>";

                                                              echo "<div class='col-md-5'>";
                                                              echo "<h6> Total Vendas <br>R$ ".number_format(12*$totalVendas, 2, ',', '.') ."</h6>";
                                                              echo "</div>";

                                                            echo "</div>";
                                                            ?>
                                                      </div>
                                                    </div>
                                                </div>

                                                <!-- parte 3 -->
                                                <div class="col-md-6" style="margin-bottom: 30px;">

                                                    <div class="card ">
                                                      <div class="card-body" >
                                                        <h5>Meta 1000 Vendas </h5>
                                                            <?php
                                                            $query_payments = "SELECT
                                                            pay.id AS idagendado,
                                                                pay.first_name,
                                                                pay.phone AS celular,
                                                                pay.guiaId,
                                                                payments_statu_Id,
                                                                pay.product_id,
                                                                pay.dataagendada AS dataagendada,
                                                            eventos.id AS idE,
                                                                eventos.nome AS nE,
                                                                eventos.idPt AS idPt,
                                                                eventos.valor AS valor,
                                                                eventos.idGuia,

                                                                SUM(pay.custoPedido) AS totalVendas,
                                                                COUNT(pay.id) AS nVendas

                                                            FROM payments_picpays AS pay
                                                                INNER JOIN eventos ON eventos.id = pay.product_id
                                                                INNER JOIN servicos ON servicos.id = pay.guiaId


                                                                WHERE pay.guiaId = $Uid AND payments_statu_Id <= 5 ORDER BY idagendado DESC Limit 10";


                                                            $result_payments = $conn->prepare($query_payments);
                                                            $result_payments->execute();

                                                            while ($row_payment = $result_payments->fetch(PDO::FETCH_ASSOC)) {
                                                                //var_dump($row_payment);
                                                                extract($row_payment);
                                                            }
                                                            echo "<div class='row' style='margin:5px; padding: 10px; background-color:#B0C4DE; border-radius: 5px;'>";



                                                              echo "<div class='col-md-12'><label> Progresso %</label>";
                                                                echo "<div class='progress' style='height: 20px;'><br>
                                                                        <div class='progress-bar' role='progressbar' style='width: $nVendas/1000%;'
                                                                          aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>$nVendas</div>";
                                                                echo "</div>  ";
                                                                echo "<p class='text-muted' style='text-size: 5px; margin-top: 11px;'>*Complete a meta para o próximo nivel.</p>";
                                                              echo "</div>";

                                                            echo "</div>";
                                                            ?>
                                                      </div>
                                                    </div>
                                                </div>

                                                <!-- Parte 4 -->
                                                <div class="col-md-6" style="margin-bottom: 30px;">

                                                    <div class="card ">
                                                      <div class="card-body" >
                                                        <h5>Solicitar Saque </h5>
                                                          <div class='row' style='margin:5px; padding: 10px; background-color:#E0FFFF; border-radius: 5px;'>
                                                            <?php
                                                            $query_payments = "SELECT
                                                            pay.id AS idagendado,
                                                                pay.first_name,
                                                                pay.phone AS celular,
                                                                pay.guiaId,
                                                                payments_statu_Id,
                                                                pay.product_id,
                                                                pay.dataagendada AS dataagendada,
                                                            eventos.id AS idE,
                                                                eventos.nome AS nE,
                                                                eventos.idPt AS idPt,
                                                                eventos.valor AS valor,
                                                                eventos.idGuia,

                                                                SUM(pay.custoPedido) AS totalVendas,
                                                                COUNT(pay.id) AS nVendas

                                                            FROM payments_picpays AS pay
                                                                INNER JOIN eventos ON eventos.id = pay.product_id
                                                                INNER JOIN servicos ON servicos.id = pay.guiaId


                                                                WHERE pay.guiaId = $Uid AND payments_statu_Id = 6 ORDER BY idagendado DESC Limit 10";


                                                            $result_payments = $conn->prepare($query_payments);
                                                            $result_payments->execute();

                                                            while ($row_payment = $result_payments->fetch(PDO::FETCH_ASSOC)) {
                                                                //var_dump($row_payment);
                                                                extract($row_payment);
                                                            }

                                                              echo "<div class='col-md-5'>";
                                                               echo "<h6> Total PAGO <br>R$ ".number_format($totalVendas, 2, ',', '.') ."</h6>";
                                                              echo "</div>";

                                                              echo "<div class='col-md-4'>";
                                                                echo "<h6> Nº Pedidos <br> ".$nVendas."</h6>";
                                                              echo "</div>";






                                                            ?>
                                                              <div class='col-md-4'>
                                                                  <button type='button' class='btn btn-light'> Solicitar </button>
                                                              </div>
                                                            </div>
                                                      </div>
                                                    </div>
                                                </div>

                                                <hr>
                                              <!-- Lista todos Pedidos para ACEITAR ainda. -->
                                              <div class="col-md-12">
                                                  <div class="col mb-2 text-center" >
                                                    <div class="card ">
                                                      <div class="card-body" >
                                                        <h3>Análise de pedidos</h3>
                                                        <p class="text-muted">Lista de pedidos feitos a serem analisados e aceitos ou remarcados conforme sua agenda.</p>

                                                        <div class="row">
                                                              <ul style="list-style: none; text-align: left;">
                                                                <li style=" background: #008080; height: 18px; width: 18px; border-radius: 30px; border:solid 1px black; ">  </li> Pedido Gerado
                                                                <li style=" background: #000000; height: 18px; width: 18px; border-radius: 30px; border:solid 1px black; ">  </li> Pedido Expirado
                                                                <li style=" background: #9ACD32; height: 18px; width: 18px; border-radius: 30px; border:solid 1px black; ">  </li> Pedido em Análise
                                                                <li style=" background: #32CD32; height: 18px; width: 18px; border-radius: 30px; border:solid 1px black; ">  </li> Pedido Pago
                                                              </ul>
                                                        </div>
                                                        <table class="table table-responsive{-sm|-md|-lg|-xl} table-hover" style="width: 100%;" >
                                                            <thead class="thead-light" style='font-size: 10px;'>
                                                              <tr style='font-size: 10px; height: 5px;'>
                                                                <th scope="col">Ações</th>
                                                                <th scope="col">Turista</th>
                                                                <th scope="col">Evento</th>
                                                                <th scope="col">Data</th>
                                                                <th scope="col">Hora</th>

                                                              </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            $query_payments = "SELECT
                                                            pay.id AS idagendado,
                                                                pay.first_name,
                                                                pay.last_name,
                                                                pay.phone AS celular,
                                                                pay.guiaId,
                                                                payments_statu_Id,
                                                                pay.product_id,
                                                                pay.dataagendada AS dataagendada,
                                                                pay.custoPedido AS valor,
                                                                pay.hora AS hora,
                                                            eventos.id AS idE,
                                                                eventos.nome AS nE,
                                                                eventos.idPt AS idPt,
                                                                eventos.idGuia,
                                                            pontosturisticos.id,
                                                                pontosturisticos.image AS i,
                                                                pontosturisticos.name AS name_prod
                                                            FROM payments_picpays AS pay

                                                                INNER JOIN eventos ON eventos.id = pay.product_id
                                                                INNER JOIN pontosturisticos ON pontosturisticos.id = eventos.idPt
                                                                INNER JOIN servicos ON servicos.id = pay.guiaId

                                                                WHERE pay.guiaId = $Uid AND payments_statu_Id <= 5 AND confirmado = 0 ORDER BY dataagendada DESC Limit 20";

                                                            $result_payments = $conn->prepare($query_payments);
                                                            $result_payments->execute();
                                                            while ($row_payment = $result_payments->fetch(PDO::FETCH_ASSOC)) {
                                                                //var_dump($row_payment);
                                                                extract($row_payment);
                                                                echo "<tr style='font-size: 12px; height: 20px;'>";
                                                                echo "<td style='font-size: 10px; '>$idagendado<br>
                                                                <a href='confirmaEvento.php?id=$idagendado' class='btn btn-success btn-sm'>Confirmar</a>
                                                                <a href='recusaEvento.php?id=$idagendado' class='btn btn-danger btn-sm'>Remarcar</a></td>";
                                                                echo "<td>$first_name $last_name<br>" .$celular."</td>" ;

                                                              if($payments_statu_Id == 1 OR $payments_statu_Id == 2){
                                                                echo "<td>$nE " ."<br><i style='background: #008080;padding:2px;'>R$ " . number_format($valor, 2, ',', '.') ."</i></td>";
                                                              }elseif($payments_statu_Id == 3){
                                                                echo "<td>$nE " ."<br><i style='background: #000000;padding:2px;'>R$ " . number_format($valor, 2, ',', '.') ."</i></td>";
                                                              }elseif($payments_statu_Id == 4){
                                                                echo "<td>$nE " ."<br><i style='background: #9ACD32;padding:2px;'>R$ " . number_format($valor, 2, ',', '.') ."</i></td>";
                                                              }elseif($payments_statu_Id == 5){
                                                                echo "<td>$nE " ."<br><i style='background: #32CD32;padding:2px;'>R$ " . number_format($valor, 2, ',', '.') ."</i></td>";
                                                              }


                                                                echo "<td>". date('d/m/Y',  strtotime($dataagendada)) ."</td>";
                                                                echo "<td>". date('H:m',  strtotime($hora)) ."</td>";
                                                                echo "</tr>";
                                                              }
                                                            ?>
                                                            </tbody>
                                                          </table>
                                                      </div>
                                                    </div>
                                                  </div>
                                              </div>

                                              <!-- Lista Agendados aceitos e PAGOS-->
                                              <div class="col-md-12">
                                                    <div class="col mb-2 text-center" >
                                                      <div class="card ">
                                                        <div class="card-body">
                                                          <h3>Agenda confirmado</h3>

                                                          <table class="table table-responsive{-sm|-md|-lg|-xl} table-hover" style="width: 100%;" >
                                                            <thead class="thead-light" style='font-size: 10px;'>
                                                                <tr style='font-size: 10px; height: 5px;'>

                                                                    <th scope="col">Pedido</th>
                                                                    <th scope="col">Turista</th>
                                                                    <th scope="col">Evento</th>
                                                                    <th scope="col">Data </th>
                                                                    <th scope="col">Hora </th>

                                                                </tr>
                                                            </thead>
                                                            <tbody style='font-size: 12px; height: 5px;'>
                                                              <?php
                                                              $query_payments = "SELECT
                                                              pay.id AS idagendado,
                                                                  pay.first_name,
                                                                  pay.last_name,
                                                                  pay.phone AS celular,
                                                                  pay.guiaId,
                                                                  payments_statu_Id,
                                                                  pay.product_id,
                                                                  pay.dataagendada AS dataagendada,
                                                                  pay.custoPedido AS valor,
                                                                  pay.hora AS hora,
                                                              eventos.id AS idE,
                                                                  eventos.nome AS nE


                                                              FROM payments_picpays AS pay

                                                                  INNER JOIN eventos ON eventos.id = pay.product_id
                                                                  INNER JOIN servicos ON servicos.id = pay.guiaId

                                                                  WHERE pay.guiaId = $Uid AND payments_statu_Id = 5 AND confirmado = 1 ORDER BY dataagendada DESC Limit 20";

                                                              $result_payments = $conn->prepare($query_payments);
                                                              $result_payments->execute();
                                                              while ($row_payment = $result_payments->fetch(PDO::FETCH_ASSOC)) {
                                                                  //var_dump($row_payment);
                                                                  extract($row_payment);
                                                                  echo "<tr style='font-size: 12px; height: 20px;'>";
                                                                  if($dataagendada < date_create()){
                                                                    echo "<td>$idagendado </td>";
                                                                    echo "<td>$first_name $last_name <br>" .$celular."</td>" ;
                                                                    echo "<td>$nE " ."<br>R$ " . number_format($valor, 2, ',', '.') ."</td>";
                                                                    echo "<td>". date('d/m/Y',  strtotime($dataagendada)) ."</td>";
                                                                    echo "<td>". date('H:m',  strtotime($hora)) ."</td>";
                                                                  }else{
                                                                    echo "<td> Ainda não tem Pedidos !</td>";
                                                                    echo "<td> </td>";
                                                                    echo "<td> </td>";
                                                                    echo "<td> </td>";
                                                                    echo "<td> </td>";
                                                                  }
                                                                  echo "</tr>";
                                                                }
                                                              ?>
                                                            </tbody>
                                                          </table>
                                                        </div>
                                                      </div>
                                                    </div>
                                              </div>

                                            </div>
                                          </div>
                                                  <!-- Pag. para listar eventos Completo e realizados com comentarios -->
                                <div class="modal-content" id=formTerceiro style="padding: 10px;">

                                    <?php
                                      include_once 'listaEventoPago.php';
                                    ?>

                                </div>
                                                  <!-- Pag. para cadastro novo EVENTO desse guia -->
                                <div class="modal-content" id=formCriarEvento style="padding-bottom: 20px;">

                                    <?php
                                      include_once '../guias/cad-EventoFuncao.php';
                                    ?>
                                </div>
                                                  <!-- Pag. para listar eventos  Guia -->
                                <div class="modal-content" id=formQuarto style="padding-bottom: 20px;">

                                  <?php
                                      include_once '../guias/funcoes/buscaEventos.php';
                                  ?>

                                </div>
                                                  <!-- Pag. para editar perfil guia -->
                                <div class="modal-content" id=formPerfil style="padding-bottom: 20px;">

                                  <?php
                                      include_once '../guias/funcoes/perfilPrivadoGuia.php';
                                  ?>

                                </div>

                                <div class="modal-content" id=formUpgrade style="padding-bottom: 20px;">

                                  <?php
                                      include_once '../guias/planos/upgradePlanos.php';
                                  ?>

                                </div>

                          </div>
                      </div>
              </div><!-- Final da MODAL DIALOG BUTONES-->
    </div><!-- Final da segunda ROW Principal -->

   </main>

   <br>
   <br>
   <hr>
  <?php
    include_once '../rodape.php';
  ?>

</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

  $(document).ready(function() {

    $("#formPainel").show();
    $("#formCriarEvento").hide();
    $("#formTerceiro").hide();
    $("#formQuarto").hide();
    $("#formPerfil").hide();
    $("#formUpgrade").hide();

  $("#CriarEvento").click(function () {
		$("#formCriarEvento").show(500);
    $("#formPainel").hide();
    $("#formTerceiro").hide();
    $("#formQuarto").hide();
    $("#formPerfil").hide();
    $("#formUpgrade").hide();
	});

  $("#Painel").click(function () {
		$("#formPainel").show(500);
    $("#formCriarEvento").hide();
    $("#formTerceiro").hide();
    $("#formQuarto").hide();
    $("#formPerfil").hide();
    $("#formUpgrade").hide();
	});

  $("#terceiroForm").click(function () {
		$("#formTerceiro").show(500);
    $("#formPainel").hide();
    $("#formCriarEvento").hide();
    $("#formQuarto").hide();
    $("#formPerfil").hide();
    $("#formUpgrade").hide();
	});

  $("#quartoForm").click(function () {
    $("#formQuarto").show(500);
    $("#formPainel").hide();
    $("#formCriarEvento").hide();
    $("#formTerceiro").hide();
    $("#formPerfil").hide();
    $("#formUpgrade").hide();
	});

  $("#perfilForm").click(function () {
    $("#formPerfil").show(500);
    $("#formPainel").hide();
    $("#formCriarEvento").hide();
    $("#formTerceiro").hide();
    $("#formQuarto").hide();
    $("#formUpgrade").hide();

	});

  $("#upgradeForm").click(function () {
    $("#formUpgrade").show(500);
    $("#formPainel").hide();
    $("#formCriarEvento").hide();
    $("#formTerceiro").hide();
    $("#formQuarto").hide();
    $("#formPerfil").hide();

	});


  });
</script>

