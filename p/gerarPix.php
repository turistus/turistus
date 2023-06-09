
<?php


$endpoint = 'https://api.pagseguro.com/orders';
$token = '2ec1526c-6da7-467f-b950-73129b6b5fc4e192b72c44e081c68c58638efbbbd16f318d-49a8-4a82-be6d-77f0366b88d2';
$reference_id = "158";

$body =
  [
    "reference_id" => $reference_id,
    "customer" => [
      "name" => "ALBERTO Compra",
      "email" => "email@test.com",
      "tax_id" => "12345678909",
      "phones" => [
        [
          "country" => "55",
          "area" => "11",
          "number" => "999999999",
          "type" => "MOBILE"
        ]
      ]
    ],
    "items" => [
      [
        "name" => "TRILHA DA MANTIQUEIRA",
        "quantity" => 1,
        "unit_amount" => 100.00
      ]
    ],
    "qr_codes" => [
      [
        "amount" => [
          "value" => 100.00
        ],
        "expiration_date" => "2023-04-29T20:15:59-03:00",
      ]
    ],
    "notification_urls" => [
      "https://turistus.com.br/p/gerarPix.php"
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

// A variável recebe a mensagem de erro
$msg = "";
$Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
// Acessar o IF quando o usuário clica no botão
  if (isset($Dados['BtnPagSeguro'])) {
    //var_dump($Dados);


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

      echo $Dados['senderName'] . "DADOS ARRAY";

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
          $msg = "SUCESSO !!!!!";
            }
    }
  }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QrCode Pix Pagseguro</title>
</head>

<body>


  <?php if ($data) : ?>
    <img src="<?php echo $data['qr_codes'][0]['links'][0]['href'] ?>" alt="">
  <?php endif; ?>

</body>


</html>