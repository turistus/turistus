
<?php
define('ACCESS', true);
ob_start();
//ID do EVENTOOO
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
    header("Location: index.php");
    die("Erro: página encontrada!<br>");
}

include_once '../../connection.php';

?>
                <?php
                // AQUI DEVE CHAMAR id,guia,valor do EVENTO.
                $query_products = "SELECT *,
                svcs.id AS GuiaID,
                svcs.nome AS nomeGuia,
                eventos.id AS id,
                eventos.nome AS nomeEvento,
                eventos.valor AS custoEvento,
                eventos.breveDescricao AS descricao

                FROM eventos

                INNER JOIN servicos AS svcs ON svcs.id=eventos.idGuia
                WHERE eventos.id =:id LIMIT 1 ";

                $result_products = $conn->prepare($query_products);
                $result_products->bindParam(':id', $id, PDO::PARAM_INT);
                $result_products->execute();
                if ($result_products->rowCount() == 0) {
                    header("Location: eventos.php");
                    die("Erro: página encontrada!<br>");
                }
                $row_product = $result_products->fetch(PDO::FETCH_ASSOC);
                extract($row_product);
                ?>
<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">

        <link rel="shortcut icon" href="../../images/logooriginal.png" >
        <title>Turist Us - Formulario de Pagamento</title>
    </head>
    <body>

        <?php
        include_once 'menuF.php';
        ?>


        <div class="container">
            <div class="py-5 text-center">

                <img class="d-block mx-auto mb-4" src="../../images/logooriginal.png" alt="" width="72" height="72">
                    <h2>Formulário de Pagamento </h2>
                    <p class="lead" style="color: grey;">Realizando o pagamento por PagSeguro.</p>
            </div>

            <div class="row mb-5">
                <div class="col-md-8">
                    <h3><?php echo $nomeEvento; ?></h3>
                </div>

                <div class="col-md-4">
                   <p> Descrição da Compra</p>
                    <div class="mb-1 text-muted"> R$ <?php echo number_format($custoEvento, 2, ",", ".");?></div>
                    <div class="mb-1 text-muted"> <?php echo $nomeGuia;?></div>
                    <div class="mb-1 text-muted"> <?php echo $descricao;?></div>

                </div>
            </div>

            <hr>

            <div class="col-md-4">
                <form name="FormPagamento" id="FormPagamento" action="https://sandbox.pagseguro.uol.com.br/checkout/v2/payment.html" method="get">
                    <!-- N�?O EDITE OS COMANDOS DAS LINHAS ABAIXO -->
                    <input type="hidden" name="code" id="code" value="" />
                    <input type="hidden" name="iot" value="button" />
                    <input id="BotaoPagar" type="image" src="https://stc.pagseguro.uol.com.br/public/img/botoes/pagamentos/209x48-pagar-azul-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
                </form>
            </div>
                </div>
            </div>
        </div>



      <?php

        //Salvar os dados da compra no banco de dados
        $query_pa = "INSERT INTO payments_pagSeg (titulo, idEv, descricao, custoEvento, idGuia, dataGerada) VALUES (:titulo, :idEv, :descricao, :custoEvento, :idGuia, :dataGerada)";
        $add_pagSeg = $conn->prepare($query_pa);
        $add_pagSeg->bindParam(":titulo", $nomeEvento, PDO::PARAM_STR);
        $add_pagSeg->bindParam(":idEv", $id);
        $add_pagSeg->bindParam(":descricao", $descricao, PDO::PARAM_STR);
        $add_pagSeg->bindParam(":custoEvento", $custoEvento);
        $add_pagSeg->bindParam(":idGuia", $idGuia);
        $add_pagSeg->bindParam(":dataGerada", "0000-00-00");

        $add_pagSeg->execute();
        // FIM DA INSERT EM PAYMENTS PICPAY

        if ($add_pagSeg->rowCount()) {
            $last_insert_id = $conn->lastInsertId();

        setcookie("titulo", $nomeEvento, time()+3600);
        setcookie("custoEvento", $custoEvento, time()+3600);
        setcookie("descricao", $descricao, time()+3600);
        setcookie("last_insert_id", $last_insert_id, time()+3600);
        setcookie("id", $id, time()+3600);

        $msg = "SUCESSO !!!!!";
            }

?>
<!-- -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" ></script>
        <script src="../../Libraries/zepto.min.js"></script>
        <script src="../../Libraries/chamaPagDireto.js"></script>

    </body>

    <?php
  include_once '../../rodape.php';
  ?>
</html>
