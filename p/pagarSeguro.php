
<?php

$endpoint = 'https://sandbox.api.pagseguro.com/orders';
$token = '7B51B77D7A7A2162240DDFA7FDEC306A';

$body =
  [
    "reference_id" => "0001",
    "customer" => [
      "name" => "Jose da Silva",
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
        "unit_amount" => 5.00
      ]
    ],
    "qr_codes" => [
      [
        "amount" => [
          "value" => 5.00
        ],
        "expiration_date" => "2023-04-29T20:15:59-03:00",
      ]
    ],
    "shipping" => [
      "address" => [
        "street" => "Avenida Brigadeiro Faria Lima",
        "number" => "1384",
        "complement" => "apto 12",
        "locality" => "Pinheiros",
        "city" => "São Paulo",
        "region_code" => "SP",
        "country" => "BRA",
        "postal_code" => "01452002"
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
  'Authorization: $token'
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
<html lang="en">

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