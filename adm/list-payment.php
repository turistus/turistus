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
        <link rel="shortcut icon" href="../images/icon/favicon.ico" >
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <title>Desconecta ADM - Listar os Pagamentos</title>
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?>
        <div class="container">

            <h2 class="display-4 mt-3 mb-3">Pagamentos AGENDADOS Turistas</h2>
            Aqui devemos VALIDAR todo pagamentos feito tanto por EVENTOS ou por Pontos Turisticos Abertos, e deixar o status Pago ou refente ao caso.
            Clicando em Status.
            <br>
            entao, Clique em Status em cada 5 minutos nos 20 primeiros sempre para ver se foi pago...
            <br>

            <?php
            if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
            <hr>

            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr style="font-size: 0.8em;">
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Ações</th>

                        <th scope="col">ID</th>
                        <th scope="col">Data Pedido</th>
                        <th scope="col">Data Agendada</th>
                        <th scope="col">Turista</th>
                        <th scope="col">E-mail </th>
                        <th scope="col">Evento</th>
                        <th scope="col">Vagas</th>
                        <th scope="col">Total</th>

                        <th scope="col" class="text-center">Guia Nativo</th>

                    </tr>
                </thead>
                <?php
                $query_payments =
                    "SELECT
                    pay.id,
                    pay.first_name,
                    pay.email,
                    pay.created,
                    pay.dataagendada,

                    prod.name AS name_prod,

                    sta.name AS name_sta,
                    sta.color,

                    eventos.id AS idEvento,
                    eventos.nome AS nomeE,

                    valores.id AS idVal,
                    valores.idEvento AS idEventoVal,
                    valores.vagas,
                    valores.total

                    FROM payments_picpays pay
                    INNER JOIN turistas ON turistas.email = pay.email
                    INNER JOIN valores ON valores.idEventoVal = pay.product_id
                    INNER JOIN eventos ON eventos.idEvento = valores.idEventoVal
                    INNER JOIN payments_status AS sta ON sta.id=pay.payments_statu_Id
                    ORDER BY pay.id DESC ";
                $result_payments = $conn->prepare($query_payments);
                $result_payments->execute();
                while ($row_payment = $result_payments->fetch(PDO::FETCH_ASSOC)) {
                    //var_dump($row_payment);
                    extract($row_payment);
                    $totalFormatado = number_format($total, 2, ",", ".");
                    echo "<tr>";
                        echo "<td class='text-center'><span class='badge badge-pill badge-$color'>$name_sta</span></td>";
                        echo "<td class='text-center'>";
                            echo "<a href='payment-status.php?id=$id' class='btn btn-outline-primary btn-sm'>Status</a> ";
                            echo "<a href='cancel-payment.php?id=$id' class='btn btn-outline-danger btn-sm'>Cancelar</a>";
                        echo "</td>";

                        echo "<th>$id</th>";
                        echo "<th>". date('d/m/Y',  strtotime($created)) ."</th>";
                        echo "<th>". date('d/m/Y',  strtotime($dataagendada)) ."</th>";
                        echo "<td>$first_name</td>";
                        echo "<td>$email</td>";
                        echo "<td>$nomeE</td>";
                        echo "<td>$vagas</td>";
                        echo "<td>$totalFormatado</td>";
                        echo "<td>ID GUIA nome</td>";
                    echo "</tr>";

                }
                ?>
            </table>

        </div><!-- Div CONTEINR FINAL -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    </body>
    <?php
        include_once '../rodape.php';
    ?>
</html>