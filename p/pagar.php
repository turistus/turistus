<?php
define('ACCESS', true);
ob_start();
//ID do EVENTOOO
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$emailSessaoAberta = filter_input(INPUT_GET, "email", FILTER_SANITIZE_EMAIL);
echo "ID DO EVENTO".$id;
include_once '../connection.php';
session_start();

?>
                <?php
                // AQUI DEVE CHAMAR id,guia,valor do EVENTO.
                $query_products = "SELECT *,
                svcs.id AS GuiaID,
                svcs.nome AS nomeGuia,
                eventos.id AS id,
                eventos.nome AS nomeEvento,
                eventos.valor AS custoEvento

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
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
        <title>PIX - PagSeguro</title>
    </head>
    <body>

    <div class="container">

            <div class="py-5 text-center">

                <img class="d-block mx-auto mb-4" src="../images/logo/LG.jpg" alt="" width="72" height="72">
                    <h2>Formulário de Pagamento PIX</h2>
                    <p class="lead" style="color: grey;">Realizando o pagamento por PIX.</p>
            </div>
            <div class="row mb-5">
                <div class="col-md-8">
                    <h3><?php echo $nomeEvento; ?></h3>
                </div>

                <div class="col-md-4">
                   <p> Valor Total</p>
                    <div class="mb-1 text-muted"> R$ <?php echo number_format($custoEvento, 2, ",", ".");?></div>
                    <div class="mb-1 text-muted"> <?php echo $nomeGuia;?></div>

                </div>
            </div>



            <div class="row">
                <div class="col-md-8 order-md-1">

                    <!-- <div class="meio-pag">A</div> -->
                    <span id="msg"></span>
                    <form name="formPagamento" action="../p/gerarPix.php?id=<?php echo $id; ?>" id="formPagamento">
                        <span id="msg"></span>
                        <h4 class="mb-3">Dados do Comprador</h4>
                        <div class="mb-3">
                            <label>Nome</label>
                            <input type="text" name="senderName" id="senderName" placeholder="Nome completo" value="Jose Compradorss" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>CPF</label>
                            <input type="text" name="senderCPF" id="senderCPF" placeholder="CPF sem traço" value="22111944785" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>E-mail</label>
                            <input type="email" name="senderEmail" id="senderEmail" placeholder="E-mail do comprador" value="<?php echo $emailSessaoAberta;?>" class="form-control" required>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label>DDD</label>
                                <input type="text" name="senderAreaCode" id="senderAreaCode" placeholder="DDD" value="11" class="form-control" required>
                            </div>
                            <div class="col-md-9 mb-3">
                                <label>Telefone</label>
                                <input type="text" name="senderPhone" id="senderPhone" placeholder="Somente número" value="56273440" class="form-control" required>
                            </div>
                        </div>

                        <input type="hidden" name="reference" id="reference" value="<?php echo $id; ?>">
                        <input type="hidden" name="amount" id="amount" value="<?php echo $custoEvento; ?>">

                            <!-- BOTAO ENVIAR PagSeguro -->
                        <button type="submit" name="BtnPagSeguro" class="btn btn-primary" value="Enviar">Gerar Pix</button>

                    </form>
                </div>
            </div>
        </div>


        <?php
        include_once '../rodape.php';
        ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    </body>
</html>