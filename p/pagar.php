<?php


$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

include '../connection.php';

$Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$query_car = "SELECT *,
svcs.id AS GuiaID,
svcs.nome AS nomeGuia,
eventos.id AS id,
eventos.nome AS nomeEvento,
eventos.valor AS custoEvento

FROM eventos

INNER JOIN servicos AS svcs ON svcs.id=eventos.idGuia
WHERE eventos.id =:id LIMIT 1 ";

$resultado_car = $conn->prepare($query_car);
$resultado_car->execute();

while ($row_car = $resultado_car->fetch(PDO::FETCH_ASSOC)) {

    $total_venda = number_format($row_car['custoEvento'], 2, '.', '');

  }


$endpoint = 'https://sandbox.api.pagseguro.com/orders';
$token = 'AF36513B07544C12B790A1D158E70911';

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>PIX - PagSeguro</title>
    </head>
    <body>

    <div class="container">

    <?php

        // A variável recebe a mensagem de erro
        $msg = "";

        // Acessar o IF quando o usuário clica no botão
        if (isset($Dados['BtnPagSeguro'])) {
            //var_dump($data);
            $empty_input = false;
            $Dados = array_map('trim', $Dados);
            if (in_array("", $Dados)) {
                $empty_input = true;
                $msg = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher todos os campos!</div>";
            } elseif (!filter_var($Dados['email'], FILTER_VALIDATE_EMAIL)) {
                $empty_input = true;
                $msg = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher com e-mail válido!</div>";
            }

            // Acessa o IF quando não há nenhum erro no formulário
            if (!$empty_input) {
                //Data para salvar no BD e enviar para o PicPay
                $Dados['created'] = date('Y-m-d H:i:s');
                $Dados['due_date'] = date('Y-m-d H:i:s', strtotime($Dados['created'] . '+3days'));
                $due_date = date(DATE_ATOM, strtotime($Dados['due_date']));



                //Salvar os dados da compra no banco de dados
                $query_pay_picpay = "INSERT INTO payments_pagSeg (titulo, dataGerada) VALUES (:titulo, :dataGerada)";

                $add_pay_picpay = $conn->prepare($query_pay_picpay);

                $add_pay_picpay->bindParam(":titulo", $nomeEvento, PDO::PARAM_STR);
                $add_pay_picpay->bindParam(":dataGerada", $Dados['due_date']);


                $add_pay_picpay->execute();


             // FIM DA INSERT EM PAYMENTS PICPAY

                if ($add_pay_picpay->rowCount()) {
                    $last_insert_id = $conn->lastInsertId();

                    /** GERAR O PIX */



                $body =
                [
                "reference_id" => $Dados['reference'],
                "customer" => [
                    "name" => $Dados['senderName'],
                    "email" => $Dados['senderEmail'],
                    "tax_id" => $Dados['senderCPF'],
                    "phones" => [
                    [
                        "country" => "55",
                        "area" => $Dados['senderAreaCode'],
                        "number" => $Dados['senderPhone'],
                        "type" => "MOBILE"
                    ]
                    ]
                ],
                "items" => [
                    [
                    "name" => $nomeEvento,
                    "quantity" => 1,
                    "unit_amount" => 500.0//$total_venda
                    ]
                ],
                "qr_codes" => [
                    [
                    "amount" => [
                        "value" => 500.0//$total_venda
                    ],
                    "expiration_date" => "2023-04-29T20:15:59-03:00"
                    ]
                ],
                "shipping" => [
                    "address" => [
                    "street" => $Dados['billingAddressStreet'],
                    "number" => $Dados['billingAddressNumber'],
                    "complement" => $Dados['billingAddressComplement'],
                    "locality" => $Dados['billingAddressDistrict'],
                    "city" => $Dados['billingAddressCity'],
                    "region_code" => $Dados['billingAddressState'],
                    "country" => "BRA",
                    "postal_code" => $Dados['billingAddressPostalCode']
                    ]
                ],
                "notification_urls" => [
                    "https://turistus.com.br/notificacaoPagSeguro.php"
                ]
                ];

                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $endpoint);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
                curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Content-Type:application/json',
                'Authorization:'.$token
                ]);

                $response = curl_exec($curl);
                $error = curl_error($curl);

                curl_close($curl);

                if ($error) {
                var_dump($error);
                die();
                }

                $data = json_decode($response, true);

                var_dump($data);
                //Preciso ver se funciona igual aqui o CODE
                    if (isset($data->code) AND $data->code != 200) {
                        $msg = "<div class='alert alert-danger' role='alert'>Erro: Tente novamente!</div>";
                    } else {
                        //Editar a compra informado dados que o PicPay retornou
                        $query_up_pay_picpay = "UPDATE payments_pagSeg SET payment_url = '" . $data->paymentUrl . "', qrcode = '" . $data->qrcode->base64 . "', modified = NOW() WHERE id = $last_insert_id LIMIT 1";
                        $up_pay_picpay = $conn->prepare($query_up_pay_picpay);
                        $up_pay_picpay->execute();
                        ?>
                        <!-- Janela modal com o QRCODE -->
                        <div class="modal fade" id="pagseguro" tabindex="-1" aria-labelledby="pagseguroLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content text-center">
                                    <div class="modal-header bg-success text-white">
                                        <h5 class="modal-title" id="pagseguroLabel">Pague com Pix</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5 class="modal-title" id="pagseguroLabel">Abra o seu Banco em seu telefone e escaneie o código abaixo:</h5>
                                        <?php
                                        echo "<img src='" . $data->qrcode->base64 . "'><br><br>";
                                        ?>
                                        <p class="lead">Se tiver algum problema com a leitura do QR code, atualize o aplicativo.</p>
                                        <p class="lead"><a href="../pg/sobre.php" target="_blank">Saiba quem somos</a></p>
                                    </div>
                                    <div class="modal-footer">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    $msg = "<div class='alert alert-danger' role='alert'>Erro: Tente novamente!</div>";
                }
            }
        }
        ?>




            <div class="row">
                <div class="col-md-8 order-md-1">

                    <!-- <div class="meio-pag">A</div> -->
                    <span id="msg"></span>
                    <form name="formPagamento" action="pagar.php?id=<?php echo $id; ?>" id="formPagamento">
                        <span id="msg"></span>
                        <h4 class="mb-3">Dados do Comprador</h4>
                        <div class="mb-3">
                            <label>Nome</label>
                            <input type="text" name="senderName" id="senderName" placeholder="Nome completo" value="Jose Comprador" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>CPF</label>
                            <input type="text" name="senderCPF" id="senderCPF" placeholder="CPF sem traço" value="22111944785" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>E-mail</label>
                            <input type="email" name="senderEmail" id="senderEmail" placeholder="E-mail do comprador" value="<?php echo $emailSessaoAberta;?>" class="form-control" required>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label>DDD</label>
                                <input type="text" name="senderAreaCode" id="senderAreaCode" placeholder="DDD" value="11" class="form-control" required>
                            </div>
                            <div class="col-md-9 mb-3">
                                <label>Telefone</label>
                                <input type="text" name="senderPhone" id="senderPhone" placeholder="Somente número" value="56273440" class="form-control" required>
                            </div>
                        </div>

                        <h4 class="mb-3 creditCard">Endereço do titular do cartão</h4>
                        <div class="row creditCard">
                            <div class="col-md-9 mb-3 creditCard">
                                <label class="creditCard">Logradouro</label>
                                <input type="text" name="billingAddressStreet" id="billingAddressStreet" placeholder="Av. Rua" value="Av. Brig. Faria Lima" class="creditCard form-control">
                            </div>
                            <div class="col-md-3 mb-3 creditCard">
                                <label class="creditCard">Número</label>
                                <input type="text" name="billingAddressNumber" id="billingAddressNumber" placeholder="Número" value="1384" class="creditCard form-control">
                            </div>
                        </div>

                        <div class="mb-3 creditCard">
                            <label class="creditCard">Complemento</label>
                            <input type="text" name="billingAddressComplement" id="billingAddressComplement" placeholder="Complemento" value="5o andar" class="creditCard form-control">
                        </div>



                        <div class="row creditCard">
                            <div class="col-md-5 mb-3 creditCard">
                                <label class="creditCard">Bairro</label>
                                <input type="text" name="billingAddressDistrict" id="billingAddressDistrict" placeholder="Bairro" value="Jardim Paulistano" class="creditCard form-control">
                            </div>
                            <div class="col-md-5 mb-3 creditCard">
                                <label class="creditCard">Cidade</label>
                                <input type="text" name="billingAddressCity" id="billingAddressCity" placeholder="Cidade" value="Sao Paulo" class="creditCard form-control">
                            </div>
                            <div class="col-md-2 mb-3 creditCard">
                                <label class="creditCard">Estado</label>
                                <select name="billingAddressState" class="custom-select d-block w-100 creditCard" id="billingAddressState">
                                    <option value="">Selecione</option>
                                    <option value="AC">AC</option>
                                    <option value="AL">AL</option>
                                    <option value="AP">AP</option>
                                    <option value="AM">AM</option>
                                    <option value="BA">BA</option>
                                    <option value="CE">CE</option>
                                    <option value="DF">DF</option>
                                    <option value="ES">ES</option>
                                    <option value="GO">GO</option>
                                    <option value="MA">MA</option>
                                    <option value="MT">MT</option>
                                    <option value="MS">MS</option>
                                    <option value="MG">MG</option>
                                    <option value="PA">PA</option>
                                    <option value="PB">PB</option>
                                    <option value="PR">PR</option>
                                    <option value="PE">PE</option>
                                    <option value="PI">PI</option>
                                    <option value="RJ">RJ</option>
                                    <option value="RN">RN</option>
                                    <option value="RS">RS</option>
                                    <option value="RO">RO</option>
                                    <option value="RR">RR</option>
                                    <option value="SC">SC</option>
                                    <option value="SP">SP</option>
                                    <option value="SE">SE</option>
                                    <option value="TO">TO</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="creditCard">CEP</label>
                            <input type="text" name="billingAddressPostalCode" class="form-control creditCard" id="billingAddressPostalCode" placeholder="CEP sem traço" value="01452002">
                        </div>



                        <input type="hidden" name="reference" id="reference" value="<?php echo $id; ?>">

                        <input type="hidden" name="amount" id="amount" value="<?php echo $total_venda; ?>">

                            <!-- BOTAO ENVIAR PagSeguro -->
                        <button type="submit" name="BtnPagSeguro" class="btn btn-primary" value="Enviar">Gerar Pix</button>
                        <input id="BotaoPagamento" type="image" src="https://stc.pagseguro.uol.com.br/public/img/botoes/pagamentos/209x48-pagar-azul-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />

                    </form>
                </div>
            </div>
        </div>


        <?php
        include_once '../rodape.php';
        ?>






    </body>
</html>