<?php

//Necessário testar em dominio com SSL
define("URL", "https://turistus.com.br");


$sandbox = true;
if ($sandbox) {
    //Credenciais do SandBox
    define("EMAIL_PAGSEGURO", "esconectaprincipal@hotmail.com");
    define("TOKEN_PAGSEGURO", "AF36513B07544C12B790A1D158E70911");

} else {
    //Credenciais do PagSeguro
    define("EMAIL_PAGSEGURO", "desconectaprincipal@hotmail.com");
    define("TOKEN_PAGSEGURO", "2ec1526c-6da7-467f-b950-73129b6b5fc4e192b72c44e081c68c58638efbbbd16f318d-49a8-4a82-be6d-77f0366b88d2");

}

?>