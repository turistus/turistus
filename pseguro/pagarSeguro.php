<?php


?>



<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>API Pagseguro</title>
</head>
<body>
    <form name="FormPagamento" id="FormPagamento" action="https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html" method="post">
        <input id="BotaoPagamento" type="image" src="https://stc.pagseguro.uol.com.br/public/img/botoes/pagamentos/209x48-pagar-azul-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
    </form>

<!-- Lembrar de alterar os dados sandbox, min.js -->
    <script src="Libraries/zepto.min.js"></script>
    <!--<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script> -->

    <script src="/funcJavascript.min.js"></script>
    <script type="text/javascript" src= "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
</body>
<html/>

