<?php
session_start();

define('ACCESS', true);
include_once '../connection.php';
include_once '../adm/validate.php';

?>

<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Desconecta ADM - PAGAMENTOS</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>
    <body>

		<?php
        include_once './menu.php';
        ?>
		<div class="m-5">
			<h1>Todos Pagamentos</h1>

		</div>

		<main class="content m-5">

		<!-- BOTAO de ACESSAR o Pontos Criar Eventos -->
		<div class="dialog">
                      <div class="modal-content">
                          <div class="modal-body">

                                <div class="row">

                                    <button id="primeiroForm" type="button" class="btn btn-light text-dark me-2"> PicPay </button>
                                    <button id="segundoForm" type="button" class="btn btn-light text-dark me-2"> PagSeguro </button>
                                    <button id="terceiroForm" type="button" class="btn btn-light text-dark me-2"> Agendados </button>
                                    <button id="PG20Form" type="button" class="btn btn-light text-dark me-2"> Plano Geral 20% </button>
                                    <button id="PG15Form" type="button" class="btn btn-light text-dark me-2"> Plano VIP 15% </button>
                                    <button id="PG10Form" type="button" class="btn btn-light text-dark me-2"> Plano Premium 10% </button>
                                    <button id="CriarEvento" type="button" class="btn btn-light text-dark me-2"> Ped. PontosT </button>



                                </div>

                              <br>


        <!-- ------------------------------------------ primeiro Form ----------------------------------------------------------------- -->
                                <div class="modal-content m-1 p-5" id=formPrimeiro>

										<h2>Informações e Pagamentos </h2>
                                    <p>Aqui deve apresentar tudo sobre os pagamentos, quantos,
                                        valores mais altos, melhores turistas pagantes, melhor ponto turistico,
                                        melhor evento,
                                    </p>
                                    <hr>
                                    <p>
                                        DEVER:. Informar os Pagamentos realizados pelos Turistas Pelos Serviços e produtos (Eventos e Pontos Turisticos livres)
                                        <br>
                                        Oferencendo aos usuarios as informações do EVENTO e APOS pagamento Liberação de contato GUIA.
                                        <br>
                                        Ou Oferencendo Pontos Turisticos livres, sendo cobrado os Dados de localização exata e informações para chegar sozinho.
                                    <hr>
                                        Penso que os Pontos turisticos devem ser GRATIS, porem, para ter melhores informações
                                                <br>
                                                podem contratar/COMPRAR o ponto turistico vinculado ao GUIA Criador ou selecionado.
                                                <br>
                                                 Sendo possivel outros GUIAS lucrar em Pontos na MESMA REGIAO.
                                    </p>


                                                <hr>



                                                <?php
                                                    include_once 'list-payment.php';
                                                ?>


								</div>


         <!-- ------------------------------------------ Segundo Form ----------------------------------------------------------------- -->
                                <div class="modal-content" id=formSegundo>

                                  <h2>Pagamentos Atrazados  </h2>
                                  <p>LISTA DE AGENDADOS ATRAZADOS </p>

                                </div>


         <!-- ------------------------------------------ terceiro Form ----------------------------------------------------------------- -->
                                <div class="modal-content" id=formTerceiro>

                                    <div class="container">

                                        <h2 class="display-4 mt-3 mb-3">Pedidos EVENTOS Agendados de Turistas </h2>

                                        <hr>
                                            lista deve mostrar os Pedidos de EVENTOS que estao agendados,
                                            <br>
                                            listados por Turistas e data Agendada,  e exibindo o total bruto,
                                            <br>
                                            para ser recebido, para o guia fazer o evento.
                                            Se Foi Pago PIC PAY, Entao Pagar o GUIA?


                                        <?php
                                        if(isset($_SESSION['msg'])){
                                            echo $_SESSION['msg'];
                                            unset($_SESSION['msg']);
                                        }
                                        ?>
                                        <hr>

                                        <table class="table table-bordered table-striped table-hover" style="max-width: 600px;">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID DA AGENDADOS</th>
                                                    <th scope="col">Agenda Nome </th>
                                                    <th scope="col">E-mail <br> Celular</th>
                                                    <th scope="col">EVENTO</th>
                                                    <th scope="col" class="text-center">AGENDADO <br>Dia</th>
                                                    <th scope="col" class="text-center">Status</th>

                                                    <th scope="col" class="text-center">Guia Nativo</th>

                                                    <th scope="col" class="text-center">VALOR<br>GUIA+Informação <br> Ponto Turistico</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $query_payments = "SELECT
                                                pay.id,
                                                pay.first_name,
                                                pay.email,
                                                pay.payments_statu_Id AS statusPay,
                                                pay.created AS dataPedido,

                                                sta.name AS name_sta, sta.color,

                                                agend.id AS IDAGENDADOS,
                                                agend.first_name AS NomeTur,

                                                guias.nome AS nomeGuia,
                                                guias.celular AS numeroGuia,
                                                even.nome AS nomeEvento

                                                FROM payments_picpays AS pay
                                                /**Aqui abaixo Busca os STATUS que estão na TABELA Payments PIC PAY  */
                                                INNER JOIN payments_status AS sta ON sta.id=pay.id
                                                /**Aqui Busca as PAYMENTS PIC PAY que estão na TABELA AGENDADOS  */
                                                INNER JOIN agendados AS agend ON agend.payments_picpays_id=pay.id
                                                /**Aqui Busca os PONTOS que estão na TABELA Payments PIC PAY  */

                                                /**Aqui Busca os EVENTOS que estão na TABELA AGENDADOS  */
                                                INNER JOIN eventos AS even ON even.id=agend.idEvento
                                                /**Aqui Busca os GUIAS que estão na TABELA EVENTOS  */
                                                INNER JOIN servicos AS guias ON guias.id=even.idGuia


                                                ORDER BY pay.id DESC LIMIT 13";
                                            $result_payments = $conn->prepare($query_payments);
                                            $result_payments->execute();
                                            while ($row_payment = $result_payments->fetch(PDO::FETCH_ASSOC)) {
                                                //var_dump($row_payment);
                                                extract($row_payment);
                                                echo "<tr>";
                                                echo "<th>$IDAGENDADOS</th>";
                                                echo "<td>$NomeTur</td>";
                                                echo "<td>$email <br> $nCelular</td>";
                                                echo "<td>$nomeEvento</td>";
                                                echo "<td>$dataPedido</td>";
                                                echo "<td class='text-center'><span class='badge badge-pill badge-$color'>$statusPay $name_sta</span></td>";

                                                echo "<td>$nomeGuia - $numeroGuia </td>";
                                                echo "<td> R$ $vGuia 00 </td>";

                                                echo "</tr>";

                                            }
                                            ?>
                                        </table>

                                    </div><!-- Div CONTEINR FINAL -->

                                </div>

                                <!-- ------------------------------------------ PG20 Form ----------------------------------------------------------------- -->
                                <div class="modal-content" id=formPG20>

                                  <h2>Pagamentos de Guias 20% </h2>
                                  <p>LISTA DE guias que usam o plano de 20%, sendo feito os Pagamentos todo dia 10.  </p>
                                  <p>Com total dos pedidos de eventos por GUIA e total em VALOR e total -20% que é o valor a ser depositado  </p>

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
                                            INNER JOIN servicos AS guias ON guias.id = pay.guiaId GROUP BY guias.id


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

                                <!-- ------------------------------------------ PG15 Form ----------------------------------------------------------------- -->
                                <div class="modal-content" id=formPG15>

                                  <h2>Pagamentos de Guias 15% </h2>
                                  <p>LISTA DE guias que usam o plano de 15%, sendo feito os Pagamentos todo dia 10.  </p>
                                  <p>Com total dos pedidos de eventos por GUIA e total em VALOR e total -15% que é o valor a ser depositado  </p>
                                </div>

                                <!-- ------------------------------------------ PG10 Form ----------------------------------------------------------------- -->
                                <div class="modal-content" id=formPG10>

                                  <h2>Pagamentos de Guias 10% </h2>
                                  <p>LISTA DE guias que usam o plano de 10%, sendo feito os Pagamentos todo dia 10.  </p>
                                  <p>Com total dos pedidos de eventos por GUIA e total em VALOR e total -10% que é o valor a ser depositado  </p>

                                </div>

                                <!-- INICIO DO PAINEL PEDIDOS Registrados pela TABELA PIC PAY por PONTOS -->
                                <div class="modal-content" id=formCriarEvento>

                                    <div class="container">

                                            <h2 class="display-4 mt-3 mb-3">Pedidos *Pontos Turisticos</h2>

                                            <hr>
                                                Aqui a lista deve mostrar os Pedidos/PontoTuristicos que estao agendados e Pago, Entao Pagar o GUIA

                                                <hr>



                                            <?php
                                            if(isset($_SESSION['msg'])){
                                                echo $_SESSION['msg'];
                                                unset($_SESSION['msg']);
                                            }
                                            ?>
                                            <hr>

                                            <table class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID PICPAY</th>
                                                        <th scope="col">PicPayPayments Nome </th>
                                                        <th scope="col">E-mail <br> Celular</th>
                                                        <th scope="col">Ponto <br>Turistico </th>
                                                        <th scope="col" class="text-center">AGENDADO <br>Dia</th>


                                                        <th scope="col" class="text-center">Guia Nativo</th>
                                                        <th scope="col" class="text-center">VALOR<br>GUIA+Informação <br> Ponto Turistico</th>

                                                    </tr>
                                                </thead>
                                                <?php
                                                $query_payments = "SELECT pay.id AS idPicPay, pay.first_name, pay.last_name, pay.email,
                                                    pay.phone AS nCelular,
                                                    prod.name AS name_Pt,
                                                    sta.name AS name_sta,
                                                    sta.color,
                                                    sta.id AS idStatus,
                                                    pay.created AS dataPedido,
                                                    guias.nome AS nomeGuia,
                                                    guias.celular AS numeroGuia



                                                    FROM payments_picpays AS pay


                                                    /**Aqui Busca os PONTOS que estão na TABELA Payments PIC PAY  */
                                                    INNER JOIN pontosturisticos AS prod ON prod.id=pay.product_id

                                                    /**Aqui Busca os GUIAS que estão na TABELA EVENTOS  */
                                                    INNER JOIN servicos AS guias ON guias.id=pay.guiaId

                                                 /** tenho que buscar o VALOR do EVENTO na tabela picpayments que devo criar um campo valor pra salvar junto da compra */

                                                    /**Aqui abaixo Busca os STATUS que estão na TABELA Payments PIC PAY  */
                                                    /**A POSIÇAO de CADA linha de SQL importa */
                                                    INNER JOIN payments_status AS sta ON sta.id = pay.payments_statu_Id WHERE pay.payments_statu_Id = '5'

                                                    ORDER BY idPicPay DESC";
                                                $result_payments = $conn->prepare($query_payments);
                                                $result_payments->execute();
                                                while ($row_payment = $result_payments->fetch(PDO::FETCH_ASSOC)) {
                                                    //var_dump($row_payment);
                                                    extract($row_payment);
                                                    echo "<tr>";
                                                    echo "<th>$idPicPay</th>";
                                                    echo "<td>$first_name $last_name</td>";
                                                    echo "<td>$email <br> $nCelular</td>";
                                                    echo "<td>$name_Pt</td>";
                                                    echo "<td>$dataPedido</td>";


                                                    echo "<td>$nomeGuia - $numeroGuia </td>";
                                                    echo "<td class='text-center'><span class='badge badge-pill badge-$color'>R$ <br> $name_sta</span></td>";

                                                    echo "</tr>";

                                                }

                                                ?>
                                            </table>




                                        </div><!-- Div CONTEINR FINAL -->
                                </div>



                          </div>

                      </div>

              </div><!-- Final da MODAL DIALOG BUTONES-->








		</main>

    </body>
    <?php
        include_once '../rodape.php';
    ?>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){

    $("#formPrimeiro").show();
    $("#formCriarEvento").hide();
    $("#formTerceiro").hide();
    $("#formSegundo").hide();formPG10
    $("#formPG20").hide();
    $("#formPG15").hide();
    $("#formPG10").hide();


$("#PG20Form").click(function () {
    $("#formPG20").show(500);
	$("#formCriarEvento").hide();
    $("#formPrimeiro").hide();
    $("#formTerceiro").hide();
    $("#formSegundo").hide();
    $("#formPG15").hide();
    $("#formPG10").hide();

	});


$("#PG15Form").click(function () {
    $("#formPG15").show(500);
	$("#formCriarEvento").hide();
    $("#formPrimeiro").hide();
    $("#formTerceiro").hide();
    $("#formSegundo").hide();
    $("#formPG20").hide();
    $("#formPG10").hide();

	});

$("#PG10Form").click(function () {
    $("#formPG10").show(500);
	$("#formCriarEvento").hide();
    $("#formPrimeiro").hide();
    $("#formTerceiro").hide();
    $("#formSegundo").hide();
    $("#formPG20").hide();
    $("#formPG15").hide();

	});

  $("#CriarEvento").click(function () {
	$("#formCriarEvento").show(500);
    $("#formPrimeiro").hide();
    $("#formTerceiro").hide();
    $("#formSegundo").hide();
    $("#formPG20").hide();
    $("#formPG15").hide();
    $("#formPG10").hide();

	});

  $("#primeiroForm").click(function () {
	$("#formPrimeiro").show(500);
    $("#formCriarEvento").hide();
    $("#formTerceiro").hide();
    $("#formSegundo").hide();
    $("#formPG20").hide();
    $("#formPG15").hide();
    $("#formPG10").hide();

	});

  $("#segundoForm").click(function () {
	$("#formPrimeiro").hide();
    $("#formCriarEvento").hide();
    $("#formTerceiro").hide();
    $("#formSegundo").show(500);
    $("#formPG20").hide();
    $("#formPG15").hide();
    $("#formPG10").hide();

	});

  $("#terceiroForm").click(function () {
    $("#formPrimeiro").hide();
    $("#formCriarEvento").hide();
    $("#formTerceiro").show(500);
    $("#formSegundo").hide();
    $("#formPG20").hide();
    $("#formPG15").hide();
    $("#formPG10").hide();

	});


  });
</script>
