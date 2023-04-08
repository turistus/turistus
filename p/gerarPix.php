
<?php
include '../connection.php';

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


$endpoint = 'https://sandbox.api.pagseguro.com/orders';
$token = 'AF36513B07544C12B790A1D158E70911';

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
        "name" => $row_car['nome'],
        "quantity" => 1,
        "unit_amount" => $total_venda
      ]
    ],
    "qr_codes" => [
      [
        "amount" => [
          "value" => $total_venda
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