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
        <title>Desconecta ADM - Status Pedidos</title>
    </head>
    <body>
        <?php
        include_once './menu.php';
        ?>
        <div class="container">
        
            <h2 class="display-4 mt-3 mb-3">Agendamento de Pedidos de Turistas</h2>
            Aqui devemos validar todo TURISMO AGENDADO e Verificar que guia e EVENTO foi PAGO,  pra?.

           <hr>
            Depois*DEVE SER PENSADO COMO CONFERIR O PAGAMENTO FEITO POR PIX.
            <hr>
            ****** DEVO FAZER A BUSCA DE Pedidos de turistas Agendados, por EVENTO
            <hr>
            ****** DEVO FAZER A BUSCA DE Pedidos de turistas Agendados, por Ponto Turistico
            
            
            <?php
            if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
            <hr>
           
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID DA AGENDADOS</th>
                        <th scope="col">PicPayPayments Nome </th>
                        <th scope="col">E-mail</th>
                        <th scope="col">PontoT - EVENTO</th>

                        <th scope="col" class="text-center">Status</th>
                      
                        <th scope="col" class="text-center">Guia Nativo</th>
                        <th scope="col" class="text-center">DATA e HORA</th>
                    </tr>
                </thead>
                <?php
                $query_payments = "SELECT pay.id, pay.first_name, pay.email,
                    prod.name AS name_Pt,
                    sta.name AS name_sta, sta.color, sta.id AS idStatus,
                    pay.created AS dataPedido,
                    agend.id AS IDAGENDADOS,
                    guias.nome AS nomeGuia,
                    guias.celular AS numeroGuia,
                    even.nome AS nomeEvento
                    
                    FROM payments_picpays pay
                    /**Aqui abaixo Busca os STATUS que estão na TABELA Payments PIC PAY  */
                    INNER JOIN payments_status AS sta ON sta.id=pay.id
                    /**Aqui Busca as PAYMENTS PIC PAY que estão na TABELA AGENDADOS  */
                    INNER JOIN agendados AS agend ON agend.payments_picpays_id=pay.id
                    /**Aqui Busca os PONTOS que estão na TABELA Payments PIC PAY  */
                    INNER JOIN pontosturisticos AS prod ON prod.id=pay.product_id
                    /**Aqui Busca os EVENTOS que estão na TABELA AGENDADOS  */
                    INNER JOIN eventos AS even ON even.id=agend.idEvento
                    /**Aqui Busca os GUIAS que estão na TABELA EVENTOS  */
                    INNER JOIN servicos AS guias ON guias.id=even.idGuia
                    
                    ORDER BY pay.id DESC ";
                $result_payments = $conn->prepare($query_payments);
                $result_payments->execute();
                while ($row_payment = $result_payments->fetch(PDO::FETCH_ASSOC)) {
                    //var_dump($row_payment);
                    extract($row_payment);
                    echo "<tr>";
                    echo "<th>$IDAGENDADOS</th>";
                    echo "<td>$first_name</td>";
                    echo "<td>$email</td>";
                    echo "<td>$name_Pt - $nomeEvento</td>";
                    echo "<td class='text-center'><span class='badge badge-pill badge-$color'>Id Status $idStatus $name_sta</span></td>";
                    
                     echo "<td>$nomeGuia - $numeroGuia </td>";
                     echo "<td>$dataPedido</td>";

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