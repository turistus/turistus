<?php

//Necessário testar em dominio com SSL
define("URL", "https://turistus.com.br/");

$sandbox = true;
if ($sandbox) {
    //Credenciais do SandBox
    define("EMAIL_PAGSEGURO", "desconectaprincipal@hotmail.com");
    define("TOKEN_PAGSEGURO", "AF36513B07544C12B790A1D158E70911");
    define("URL_PAGSEGURO", "https://ws.sandbox.pagseguro.uol.com.br/v2/");
    define("SCRIPT_PAGSEGURO", "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js");
    define("EMAIL_LOJA", "turmonkey2023@hotmail.com");
    define("MOEDA_PAGAMENTO", "BRL");
    define("URL_NOTIFICACAO", "https://turistus.com.br/notificacaoPagSeguro.php");
} else {
    //Credenciais do PagSeguro
    define("EMAIL_PAGSEGURO", "desconectaprincipal@hotmail.com");
    define("TOKEN_PAGSEGURO", "Seu token no PagSeguro");
    define("URL_PAGSEGURO", "https://ws.pagseguro.uol.com.br/v2/");
    define("SCRIPT_PAGSEGURO", "https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js");
    define("EMAIL_LOJA", "E-mail de suporte pós venda");
    define("MOEDA_PAGAMENTO", "BRL");
    define("URL_NOTIFICACAO", "https://turistus.com.br/adm/NotificacaoPagSeguro.php");
}