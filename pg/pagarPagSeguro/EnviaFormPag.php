
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
<!-- -->



<?php
//session_start();
    include_once 'credenciais.php';



$Data["email"]=EMAIL_PAGSEGURO;
$Data["token"]=TOKEN_PAGSEGURO;
$Data["currency"]="BRL";
//tem que ter ID novo toda vez e CUSTO AMOUNT minimo 1.00 (um real)
$Data["itemId1"]="1031";
$Data["itemDescription1"]="$nomeEvento";
$Data["itemAmount1"]="5.00";
$Data["itemQuantity1"]="1";
$Data["itemWeight1"]="1000";
$Data["reference"]="579";
$Data["senderName"]="João da Silva";
$Data["senderAreaCode"]="37";
$Data["senderPhone"]="99999999";
$Data["senderEmail"]="twomonkeys@hotmail.com";
$Data["shippingType"]="1";
$Data["shippingAddressStreet"]="Rua Antonieta";
$Data["shippingAddressNumber"]="10";
$Data["shippingAddressComplement"]="Casa";
$Data["shippingAddressDistrict"]="Jardim Paulistano";
$Data["shippingAddressPostalCode"]="30690090";
$Data["shippingAddressCity"]="Belo Horizonte";
$Data["shippingAddressState"]="MG";
$Data["shippingAddressCountry"]="BRA";

$BuildQuery=http_build_query($Data);
$Url="https://ws.sandbox.pagseguro.uol.com.br/v2/checkout";

$Curl=curl_init($Url);
curl_setopt($Curl,CURLOPT_HTTPHEADER,Array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
curl_setopt($Curl,CURLOPT_POST,true);
curl_setopt($Curl,CURLOPT_SSL_VERIFYPEER,true);
curl_setopt($Curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($Curl,CURLOPT_POSTFIELDS,$BuildQuery);
$Retorno=curl_exec($Curl);
curl_close($Curl);

$Xml=simplexml_load_string($Retorno);
echo $Xml->code;


?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" ></script>
        <script src="../../Libraries/zepto.min.js"></script>
        <script src="../../Libraries/chamaPagDireto.js"></script>

    </body>

    <?php
  include_once '../../rodape.php';
  ?>
</html>
