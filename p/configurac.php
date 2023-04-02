<?php

//Necessário testar em dominio com SSL
define("URL", "https://www.turistus.com.br/");

$sandbox = true;
if ($sandbox) {
    //Credenciais do SandBox
    define("EMAIL_PAGSEGURO", "desconectaprincipal@hotmail.com");
    define("TOKEN_PAGSEGURO", "7B51B77D7A7A2162240DDFA7FDEC306A");
    define("URL_PAGSEGURO", "https://ws.sandbox.pagseguro.uol.com.br/v2/");
    define("SCRIPT_PAGSEGURO", "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js");
    define("EMAIL_LOJA", "turmonkey2023@hotmail.com");
    define("MOEDA_PAGAMENTO", "BRL");
    define("URL_NOTIFICACAO", "https://www.turistus.com.br/notificacaoPagSeguro.php");
} else {
    //Credenciais do PagSeguro
    define("EMAIL_PAGSEGURO", "desconectaprincipal@hotmail.com");
    define("TOKEN_PAGSEGURO", "05565737-2405-45a7-aeb0-dac6b621d4db665758264eccb1df2cd7cca70bea714d6121-d57c-4d90-90bd-ceb9cf463be5");
    define("URL_PAGSEGURO", "https://ws.pagseguro.uol.com.br/v2/");
    define("SCRIPT_PAGSEGURO", "https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js");
    define("EMAIL_LOJA", "turmonkey2023@hotmail.com");
    define("MOEDA_PAGAMENTO", "BRL");
    define("URL_NOTIFICACAO", "https://www.turistus.com.br/notificacaoPagSeguro.php");
}