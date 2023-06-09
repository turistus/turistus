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
                "notification_urls" => [
                    "https://turistus.com.br/p/pagar.php"
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
                'Authorization:Bearer'.$token
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
