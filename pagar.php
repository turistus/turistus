<?php
//define('ACCESS', true);
//include '../connection.php ';
include './p/configuracao.php';
//include 'proc_pag.php';
//$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
//$idGuia = filter_input(INPUT_GET, "idGuia", FILTER_SANITIZE_NUMBER_INT);
//$emailSessaoAberta;


?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <!-- Fonts and icons -->
        <link rel="shortcut icon" href="../images/icon/logo.ico" >
        <title>Turist Us - PagSeguro</title>
    </head>
    <body>



        <button onclick="pagamento()">Pagar</button>
        <span class="endereco" data-endereco="<?php echo URL; ?>"></span>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     <script type="text/javascript" src="<?php echo SCRIPT_PAGSEGURO; ?>"></script>
     <script src="./personalizadot.js"></script>
    </body>
</html>