<?php

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
echo $dados['celular'];

// Consulta celular no banco pra ver se existe
if($dados['celular'] > 0){

}


$mensagem = urldecode("Alterando sua senha ");

$url_Api_sms = "https://api.iagentesms.com.br/webservices/http.php?metodo=envio
&usuario=turistus@turistus.com.br
&senha=46999419624
&celular=$numeroCelular
&mensagem={$mensagem}";

$resultado_Api_sms = file_get_contents($url_Api_sms);

echo $resultado_Api_sms;

?>