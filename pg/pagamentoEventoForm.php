

<?php

define('ACCESS', true);
ob_start();
//ID do EVENTOOO
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
//$idGuia = filter_input(INPUT_GET, "idGuia", FILTER_SANITIZE_NUMBER_INT);



include_once '../connection.php';
include_once './configPicPay.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="shortcut icon" href="./images/icon/logo.ico" >
        <title>Desconecta - formulario de chekout</title>
    </head>
    <body>

        <?php
        include_once 'menu.php';


$dados_pagamento = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//$id = $dados_pagamento['id'];
$idGuia = $dados_pagamento['idGuia'];
$emailSA = $dados_pagamento['email'];
$valorSelecionado = $_POST['opcaoSelecionada'];


echo " <br> id :".$dados_pagamento['id']." ";
echo "<br>";
echo " idVal:".$valorSelecionado." ";
echo "<br>";
echo " email:".$dados_pagamento['email']." ";
echo "<br>";
echo " idGuia:".$dados_pagamento['idGuia']." ";
echo "<br>";
echo " encontro:".$dados_pagamento['encontro']." ";

        if (empty($id)) {
            header("Location: ../index.php");
            die("Erro: página encontrada!<br>");
        }else{

        // AQUI DEVE CHAMAR id,guia,valor do EVENTO.
        $query_products = "SELECT *,
        svcs.id AS GuiaID,
        svcs.nome AS nomeGuia,
        eventos.id AS id,
        eventos.nome AS nomeEvento,
        eventos.encontro,
        eventos.descricao,


        val.id AS idValo,
        val.idEvento,
        val.vagas,
        val.total

        FROM eventos

        INNER JOIN servicos AS svcs ON svcs.id=eventos.idGuia
        LEFT JOIN valores AS val ON val.idEvento=eventos.id
        WHERE eventos.id =:id LIMIT 1 ";

        $result_products = $conn->prepare($query_products);
        $result_products->bindParam(':id', $id, PDO::PARAM_INT);
        $result_products->execute();
        if ($result_products->rowCount() == 0) {
            header("Location: eventos.php");
            die("Erro: página encontrada!<br>");
        }
        $row_product = $result_products->fetch(PDO::FETCH_ASSOC);
        extract($row_product);

        }
        //Receber os dados do formulário
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        // A variável recebe a mensagem de erro
        $msg = "";

        // Acessar o IF quando o usuário clica no botão
        if (isset($data['BtnPicPay'])) {
            //var_dump($data);
            $empty_input = false;
            $data = array_map('trim', $data);
            if (in_array("", $data)) {
                $empty_input = true;
                $msg = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher todos os campos!</div>";
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $empty_input = true;
                $msg = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher com e-mail válido!</div>";
            }

            // Acessa o IF quando não há nenhum erro no formulário
            if (!$empty_input) {
                //Data para salvar no BD e enviar para o PicPay
                $data['created'] = date('Y-m-d H:i:s');
                $data['due_date'] = date('Y-m-d H:i:s', strtotime($data['created'] . '+3days'));
                $due_date = date(DATE_ATOM, strtotime($data['due_date']));



                //Salvar os dados da compra no banco de dados
                $query_pay_picpay = "INSERT INTO payments_picpays (first_name, last_name, cpf, phone, email, expires_at, product_id, payments_statu_Id, created, guiaId, dataagendada, valorId, nVagas, custoPedido) VALUES (:first_name, :last_name, :cpf, :phone, :email, :expires_at, :product_id, 1, :created, :guiaId, :dataagendada, :valorId, 1,1)";

                $add_pay_picpay = $conn->prepare($query_pay_picpay);

                $add_pay_picpay->bindParam(":first_name", $data['first_name'], PDO::PARAM_STR);
                $add_pay_picpay->bindParam(":last_name", $data['last_name']);
                $add_pay_picpay->bindParam(":cpf", $data['cpf']);
                $add_pay_picpay->bindParam(":phone", $data['phone']);
                $add_pay_picpay->bindParam(":email", $data['email']);
                $add_pay_picpay->bindParam(":expires_at", $data['due_date']);
                $add_pay_picpay->bindParam(":product_id", $id);
                $add_pay_picpay->bindParam(":created", $data['created']);
                $add_pay_picpay->bindParam(":guiaId", $data['idGuia']);
                $add_pay_picpay->bindParam(":dataagendada", $data['dataagendada']);
                $add_pay_picpay->bindParam(":valorId", $data['valorId']);



                $add_pay_picpay->execute();
             // FIM DA INSERT EM PAYMENTS PICPAY

                if ($add_pay_picpay->rowCount()) {
                    $last_insert_id = $conn->lastInsertId();
                    $phone_form = str_replace("(", " ", $data['phone']);
                    $phone_form = str_replace(")", " ", $phone_form);
                    $data_buy = [
                        "referenceId" => $last_insert_id,
                        "callbackUrl" => CALLBACKURL,
                        "returnUrl" => RETURNURL . $last_insert_id,
                        "value" => (double) $total,
                        "expiresAt" => $due_date,
                        "buyer" => [
                            "firstName" => $data['first_name'],
                            "lastName" => $data['last_name'],
                            "document" => $data['cpf'],
                            "email" => $data['email'],
                            "phone" => "+55 $phone_form"
                        ]
                    ];

                    //Iniciar cUrl
                    $ch = curl_init();

                    // URL de requisição no PicPay
                    curl_setopt($ch, CURLOPT_URL, 'https://appws.picpay.com/ecommerce/public/payments');

                    // Paramêtro de resposta
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    // Enviar o parâmetro referente ao SSL
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

                    // Enviar dados da compra
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data_buy));

                    // Enviar os headers
                    $headers = [];
                    $headers[] = 'Content-Type: application/json';
                    $headers[] = 'x-picpay-token:' . PICPAYTOKEN;
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                    // Realizar a requisição
                    $result = curl_exec($ch);

                    // Fechar a conexão
                    curl_close($ch);

                    // Ler o conteúdo da resposta
                    $data_result = json_decode($result);

                    // Imprimir o conteúdo da resposta
                    //var_dump($data_result);

                    if (isset($data_result->code) AND $data_result->code != 200) {
                        $msg = "<div class='alert alert-danger' role='alert'>Erro: Tente novamente!</div>";
                    } else {
                        //Editar a compra informado dados que o PicPay retornou
                        $query_up_pay_picpay = "UPDATE payments_picpays SET payment_url = '" . $data_result->paymentUrl . "', qrcode = '" . $data_result->qrcode->base64 . "', modified = NOW() WHERE id = $last_insert_id LIMIT 1";
                        $up_pay_picpay = $conn->prepare($query_up_pay_picpay);
                        $up_pay_picpay->execute();
                        ?>
                        <!-- Janela modal com o QRCODE -->
                        <div class="modal fade" id="picpay" tabindex="-1" aria-labelledby="picpayLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content text-center">
                                    <div class="modal-header bg-success text-white">
                                        <h5 class="modal-title" id="picpayLabel">Pague com PicPay</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5 class="modal-title" id="picpayLabel">Abra o PicPay em seu telefone e escaneie o código abaixo:</h5>
                                        <?php
                                        echo "<img src='" . $data_result->qrcode->base64 . "'><br><br>";
                                        ?>
                                        <p class="lead">Se tiver algum problema com a leitura do QR code, atualize o aplicativo.</p>
                                        <p class="lead"><a href="https://meajuda.picpay.com/hc/pt-br/articles/360045117912-Quero-fazer-a-adi%C3%A7%C3%A3o-mas-a-op%C3%A7%C3%A3o-n%C3%A3o-aparece-para-mim-E-agora-" target="_blank">Saiba como atualizar o aplicativo</a></p>
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

        <div class="container">
            <div class="py-5 text-center">

                <img class="d-block mx-auto mb-4" src="../images/logo/LG.jpg" alt="" width="72" height="72">
                    <h2>Formulário de Pagamento de Eventos</h2>
                    <p class="lead" style="color: grey;">Realizando o pagamento por PicPay.</p>
            </div>

            <div class="row mb-5">
                <div class="col-md-8">
                    <h3><?php echo $nomeEvento; ?></h3>
                </div>

                <div class="col-md-4">
                   <p> Pedido </p>
                    <div class="mb-1 text-muted"> <?php echo $vagas." Vagas ";?></div>
                    <div class="mb-1 text-muted"> R$ <?php echo number_format($total, 2, ",", ".");?></div>

                    <div class="mb-1 text-muted"> <?php echo $descricao;?></div>
                    <div class="mb-1 text-muted">Ponto de inicio <?php echo $encontro;?></div>


                </div>
            </div>

            <hr>

            <div class="row mb-5">
                <div class="col-md-12">
                    <h4 class="mb-3">Informações Pessoais</h4>
                    <?php
                    if (!empty($msg)) {
                        echo $msg;
                        $msg = "";
                    }
                    ?>
                    <form method="POST" action="pagamentoEventoForm.php?id=<?php echo $id; ?>">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="first_name">Primeiro Nome</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Primeiro nome" value="<?php
                    if (isset($data['first_name'])) {
                        echo $data['first_name'];
                    }
                    ?>" autofocus >
                            </div>

                            <div class="form-group col-md-6">
                                <label for="last_name">Último Nome</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Último nome" value="<?php
                                if (isset($data['last_name'])) {
                                    echo $data['last_name'];
                                }
                    ?>" >
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="cpf">CPF</label>
                                <input type="text" name="cpf" id="cpf" class="form-control" placeholder="Somente número do CPF" maxlength="14" oninput="maskCPF(this)" value="<?php
                                if (isset($data['cpf'])) {
                                    echo $data['cpf'];
                                }
                    ?>" >
                            </div>

                            <div class="form-group col-md-6">
                                <label for="phone">Telefone</label>
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Telefone com o DDD" maxlength="14" oninput="maskPhone(this)" value="<?php
                                if (isset($data['phone'])) {
                                    echo $data['phone'];
                                }
                    ?>" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Digite o seu melhor e-mail" value="<?php
                                if (isset($data['email'])) {
                                    echo $data['email'];
                                }
                    ?>">
                        </div>
                        <div class="form-group">
                            <label for="dataagendada">Escolha uma Data</label>
                            <input type="date" name="dataagendada" id="dataagendada" class="form-control" >
                        </div>

                        <div class="form-group">

                            <input type="hidden" name="idGuia" id="idGuia" class="form-control" value="<?php
                                if (isset($row_product['idGuia'])) {
                                    echo $row_product['idGuia'];
                                }
                    ?>">
                        </div>

                        <div class="form-group">

                            <input type="text" name="valorId" id="valorId" class="form-control" value="<?php
                                if (isset($valorSelecionado)) {
                                    echo $valorSelecionado;
                                }
                    ?>">
                        </div>


                            <!-- BOTAO ENVIAR PICPAY -->
                        <button type="submit" name="BtnPicPay" class="btn btn-primary" value="Enviar">Enviar Pic Pay</button>

                    </form>
                </div>
            </div>
        </div>
<!-- -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script src="js/custom.js"></script>

        <?php
        if (isset($data_result->paymentUrl)) {
            ?>
            <script>
                $(document).ready(function () {
                    $('#picpay').modal('show');
                });
            </script>
            <?php
        }
        ?>

    </body>

    <?php
  include_once '../rodape.php';
  ?>
</html>