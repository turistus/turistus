
<?php


$curl = curl_init();

$qrCode = 'QRCO_FAF57DD3-66AD-41B9-B975-3E4C53D49355';

curl_setopt_array($curl, [
  CURLOPT_URL => "https://sandbox.api.pagseguro.com/pix/pay/{$qrCode}",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_SSL_VERIFYPEER => true,
  CURLOPT_CAINFO => "cacert.pem",
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_HTTPHEADER => [
    "Authorization: ".$token,
    "accept: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}