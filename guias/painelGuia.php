<?php
session_start();
define('ACCESS', true);
include_once '../connection.php';

ob_start();


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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link rel="stylesheet" src="./assets/js/material-dashboard.min.js" >

  <link rel="shortcut icon" type="imagex/png" href="../images/Logooriginal.png">
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
                                    <!-- <button id="quartoForm" type="button" class="btn btn text-dark "> Pontos Turisticos </button> -->


                                </div>

                              <h4 class="display-6 mt-3 mb-2">Bem Vindo, Guia <?php echo $nome?> </h4>
                              <p> Cód.Guia: 00<?php echo $Uid?></p>


                                      <!-- INICIO PAINEL com as funçoes Administrativa   -->
                                          <div class="modal-content" id=formPainel style="padding: 10px;">
                                            <div class="row" >
                                              <!-- VALOR TOTAL  -->
                                                <div class="col-md-6" style="margin-bottom: 30px;">

                                                    <div class="card ">
                                                      <div class="card-body" >
                                                        <h3>Histórico Vendas </h3>
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
                                                                SUM(eventos.valor) AS totalVendas,
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
                                                            echo "<div class='row' style='margin:5px; padding: 10px; background-color:#00BFFF; border-radius: 5px;'>";
                                                            echo "<div class='col-md-5'>";
                                                            echo "<h4 style='color: red;'> Bruto <br>R$ ".number_format($totalVendas, 2, ',', '.') ."</h4>";
                                                            echo "</div>";
                                                            echo "<div class='col-md-5'>";
                                                            echo "<h4 style='color: blue;'> Liquido <br>R$ ".number_format($totalVendas-($totalVendas*0.2), 2, ',', '.') ."</h4>";
                                                            echo "</div>";
                                                            echo "<div class='col-md-4'>";
                                                            echo "<h4> Vendas <br> ".$nVendas."</h4>";
                                                            echo "</div>";

                                                            echo "</div>";
                                                            ?>
                                                      </div>
                                                    </div>
                                                </div>
                                              <!-- MELHORES VENDAS  -->
                                              <div class="col-md-6" style="margin-bottom: 30px;">

                                                  <div class="card ">
                                                    <div class="card-body" >
                                                      <h3>Maior Venda </h3>
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
                                                              MAX(eventos.valor) AS mVenda


                                                          FROM payments_picpays AS pay
                                                              INNER JOIN eventos ON eventos.id = pay.product_id
                                                              INNER JOIN servicos ON servicos.id = pay.guiaId

                                                              WHERE pay.guiaId = $Uid ORDER BY idagendado DESC Limit 3";


                                                          $result_payments = $conn->prepare($query_payments);
                                                          $result_payments->execute();

                                                          while ($row_payment = $result_payments->fetch(PDO::FETCH_ASSOC)) {
                                                              //var_dump($row_payment);
                                                              extract($row_payment);
                                                              echo "<div class='row'>";
                                                                echo "<div class='col-md-10'>";
                                                                echo "<h6 style='color: blue;'> ( Evento  00$idE ) </h6><br>";
                                                                echo "<h6> Evento $nE R$  ".number_format($mVenda, 2, ',', '.')." <br></h6>";

                                                                echo "</div>";

                                                              echo "</div>";
                                                          }

                                                          ?>
                                                    </div>
                                                  </div>

                                              </div>
                                              <!-- Lista todos Pedidos para ACEITAR ainda. -->
                                              <div class="col-md-6">
                                                  <div class="col mb-2 text-center" >
                                                    <div class="card ">
                                                      <div class="card-body" >
                                                        <h3>Solicitações Pagas</h3>

                                                        <table class="table table-responsive{-sm|-md|-lg|-xl} table-hover" style="width: 100%;" >
                                                            <thead class="thead-light" style='font-size: 10px;'>
                                                              <tr style='font-size: 8px; height: 5px;'>
                                                                <th scope="col">Aceita</th>
                                                                <th scope="col">Turista</th>
                                                                <th scope="col">Evento</th>
                                                                <th scope="col">Data</th>

                                                              </tr>
                                                            </thead>
                                                            <tbody>
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
                                                            pontosturisticos.id,
                                                                pontosturisticos.image AS i,
                                                                pontosturisticos.name AS name_prod
                                                            FROM payments_picpays AS pay

                                                                INNER JOIN eventos ON eventos.id = pay.product_id
                                                                INNER JOIN pontosturisticos ON pontosturisticos.id = eventos.idPt
                                                                INNER JOIN servicos ON servicos.id = pay.guiaId

                                                                WHERE pay.guiaId = $Uid AND payments_statu_Id <= 4 AND confirmado = 1 ORDER BY idagendado DESC Limit 10";



                                                            $result_payments = $conn->prepare($query_payments);
                                                            $result_payments->execute();
                                                            while ($row_payment = $result_payments->fetch(PDO::FETCH_ASSOC)) {
                                                                //var_dump($row_payment);
                                                                extract($row_payment);
                                                                echo "<tr style='font-size: 12px; height: 20px;'>";
                                                                echo "<td style='font-size: 10px; '>$idagendado<br><a href='confirmaEvento.php?id=$idagendado' class='btn btn-success btn-sm'</a>Sim</td>";


                                                                echo "<th>$first_name <br>" .$celular."</th>" ;


                                                                echo "<td>$nE " ."<br>R$ " . number_format($valor, 2, ',', '.') ."</td>";
                                                                echo "<td>". date('d/m/Y',  strtotime($dataagendada)) ."</td>";
                                                                echo "<td class='text-center'>";

                                                                echo "</td>";
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
                                              <div class="col-md-6">
                                                    <div class="col mb-2 text-center" >
                                                      <div class="card ">
                                                        <div class="card-body">
                                                          <h3>Pagos e aceitos</h3>

                                                          <table class="table table-responsive{-sm|-md|-lg|-xl} table-hover" style="width: 100%;" >
                                                            <thead class="thead-light" style='font-size: 10px;'>
                                                                <tr style='font-size: 8px; height: 5px;'>

                                                                    <th scope="col">Cod</th>
                                                                    <th scope="col">Turista</th>
                                                                    <th scope="col">Evento</th>
                                                                    <th scope="col">Data </th>


                                                                </tr>
                                                            </thead>
                                                            <tbody>
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
                                                            pontosturisticos.id,
                                                                pontosturisticos.image AS i,
                                                                pontosturisticos.name AS name_prod
                                                            FROM payments_picpays AS pay

                                                                INNER JOIN eventos ON eventos.id = pay.product_id
                                                                INNER JOIN pontosturisticos ON pontosturisticos.id = eventos.idPt
                                                                INNER JOIN servicos ON servicos.id = pay.guiaId

                                                                WHERE pay.guiaId = $Uid AND payments_statu_Id = 5 AND confirmado = 2 ORDER BY idagendado DESC Limit 15";



                                                            $result_payments = $conn->prepare($query_payments);
                                                            $result_payments->execute();
                                                            while ($row_payment = $result_payments->fetch(PDO::FETCH_ASSOC)) {
                                                                //var_dump($row_payment);
                                                                extract($row_payment);
                                                                echo "<td >$idagendado </td>";
                                                                echo "<th>$first_name <br>" .$celular."</th>" ;
                                                                echo "<td>$nE " ."<br>R$ " . number_format($valor, 2, ',', '.') ."</td>";
                                                                echo "<td>". date('d/m/Y',  strtotime($dataagendada)) ."</td>";
                                                                echo "<td class='text-center'>";

                                                                echo "</td>";
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
                                <div class="modal-content" id=formCriarEvento>

                                    <?php
                                      include_once '../guias/cad-EventoFuncao.php';
                                    ?>
                                </div>

                                                            <!-- Pag. para listar eventos  Guia -->
                                <div class="modal-content" id=formQuarto style="padding-bottom: 20px;">

                                  <?php
                                      include_once 'funcoes/buscaEventos.php';
                                  ?>

                                </div>

                                <div class="modal-content" id=formPerfil style="padding-bottom: 20px;">
                                                  <!-- Pag. para editar perfil guia -->
                                  <?php
                                      include_once 'funcoes/perfilPrivadoGuia.php';
                                  ?>

                                </div>



                                 <!-- LISTA os seus pontos criados mas por enquanto esta desativado
                                 <div class="modal-content" id=formQuarto style="padding-bottom: 20px;">


                                </div>

                                -->
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
    $("#formSegundo").hide();
    $("#formPerfil").hide();

  $("#CriarEvento").click(function () {
		$("#formCriarEvento").show(500);
    $("#formPainel").hide();
    $("#formTerceiro").hide();
    $("#formQuarto").hide();
    $("#formSegundo").hide();
    $("#formPerfil").hide();
	});

  $("#Painel").click(function () {
		$("#formPainel").show(500);
    $("#formCriarEvento").hide();
    $("#formTerceiro").hide();
    $("#formQuarto").hide();
    $("#formSegundo").hide();
    $("#formPerfil").hide();
	});

  $("#segundoForm").click(function () {
		$("#formSegundo").show(500);
    $("#formPainel").hide();
    $("#formCriarEvento").hide();
    $("#formTerceiro").hide();
    $("#formQuarto").hide();
    $("#formPerfil").hide();
	});

  $("#terceiroForm").click(function () {
		$("#formTerceiro").show(500);
    $("#formPainel").hide();
    $("#formCriarEvento").hide();
    $("#formQuarto").hide();
    $("#formSegundo").hide();
    $("#formPerfil").hide();
	});

  $("#quartoForm").click(function () {
    $("#formQuarto").show(500);
    $("#formPainel").hide();
    $("#formCriarEvento").hide();
    $("#formTerceiro").hide();
    $("#formSegundo").hide();
    $("#formPerfil").hide();
	});

  $("#perfilForm").click(function () {
    $("#formPerfil").show(500);
    $("#formPainel").hide();
    $("#formCriarEvento").hide();
    $("#formTerceiro").hide();
    $("#formQuarto").hide();
    $("#formSegundo").hide();

	});



  });
</script>

