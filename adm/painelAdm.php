<?php
session_start();

define('ACCESS', true);
include_once '../connection.php';
include_once '../adm/validate.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" type="imagex/png" href="../images/logooriginal.png">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
        <title>Desconecta ADM - Painel ADM</title>
    </head>
    <body style="font-family: Mulish,sans-serif;" >
        <?php
        include_once './menu.php';
        ?>
        <div class="container">

            <h2 class="display-4 mt-3 mb-3">PAINEL ADM</h2>
            Aqui devemos validar todo pagamentos feito e deixar o status Pago ou refente ao caso.
            Alem de controlar todos os Pedidos Pagos e nao pagos.

            <?php
            if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }

            echo "Session ID: ". $_SESSION['user_id'];
            ?>
            <hr>



            <div class="row" >
                <div class="col-md-6" style="padding-left: 20px;">
                    <h3>Pagina Principal do Administrador</h3>
                    <p>Acesso liberado apenas para socios, para controlar todas as movimentações de pagamentos e agendamentos de eventos e turismos com GUIAS</p>
                <hr>
                    <p>Aqui Deve Se MOSTRAR os pontos turisticos mais acessados ou pagos.
                        <br>
                        Tambem o Melhor Guia, Como em um Painel de B.I onde voce ve onde deve investir mais tempo e dinheiro.
                    </p>
                </div>
            </div>


        </div><!-- Div CONTEINR FINAL -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    <?php
        include_once '../rodape.php';
    ?>
</html>