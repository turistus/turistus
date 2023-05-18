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

                                    <button id="primeiroForm" type="button" class="btn btn-light text-dark me-2"> Plano Geral 20% </button>
                                    <button id="segundoForm" type="button" class="btn btn-light text-dark me-2"> Plano VIP 15% </button>
                                    <button id="terceiroForm" type="button" class="btn btn-light text-dark me-2"> Plano Premium 10% </button>
                                    <button id="CriarEvento" type="button" class="btn btn-light text-dark me-2"> Informações </button>



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

                                        <h2 class="display-4 mt-3 mb-3">Pedidos Agendados de Turistas EVENTOS</h2>

                                        <hr>
                                            Aqui a lista deve mostrar os Pedidos/EVENTOS que estao agendados, Se Foi Pago PIC PAY, Entao Pagar o GUIA?

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
                                                    guias.celular AS numeroGuia,
                                                    guias.valor AS vGuia


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
                                                    echo "<td class='text-center'><span class='badge badge-pill badge-$color'>R$ $vGuia <br> $name_sta</span></td>";

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
    $("#formSegundo").hide();


  $("#CriarEvento").click(function () {
	$("#formCriarEvento").show(500);
    $("#formPrimeiro").hide();
    $("#formTerceiro").hide();
    $("#formSegundo").hide();

	});

  $("#primeiroForm").click(function () {
	$("#formPrimeiro").show(500);
    $("#formCriarEvento").hide();
    $("#formTerceiro").hide();
    $("#formSegundo").hide();

	});

  $("#segundoForm").click(function () {
	$("#formSegundo").show(500);
    $("#formPrimeiro").hide();
    $("#formCriarEvento").hide();
    $("#formTerceiro").hide();

	});

  $("#terceiroForm").click(function () {
    $("#formPrimeiro").hide();
    $("#formCriarEvento").hide();
    $("#formTerceiro").show(500);
    $("#formSegundo").hide();

	});


  });
</script>
