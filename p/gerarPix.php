
<?php
/**include '../connection.php';

$Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$query_car = "SELECT car_prod.valor, car_prod.id,
        car_prod.nome, car_prod.descricao
        FROM eventos car_prod WHERE $id
        ";

$resultado_car = $conn->prepare($query_car);
$resultado_car->execute();

$cont_item = 1;
while ($row_car = $resultado_car->fetch(PDO::FETCH_ASSOC)) {

    $total_venda = number_format($row_car['valor'], 2, '.', '');

  }

*/

$Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$endpoint = 'https://sandbox.api.pagseguro.com/orders';
$token = 'AF36513B07544C12B790A1D158E70911';
$reference_id = '101';

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
  'Authorization: '.$token
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

  <?php
  echo $Dados. "EXIBIR OS DADOS";


  ?>
</body>

</html>