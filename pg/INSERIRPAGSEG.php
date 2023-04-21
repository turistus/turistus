
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="images/icon/favicon.ico" >
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" >
        <title>TESTE INSERIR</title>
    </head>
    <body>


<?php

include("../connection.php");
//Receber os dados do formulário
$descreveEvento = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$titulo = $descreveEvento['titulo'];
$idEv = $descreveEvento['titulo'];
$descricao = $descreveEvento['titulo'];
$custoEvento = $descreveEvento['titulo'];
$idGuia = $descreveEvento['titulo'];

// A variável recebe a mensagem de erro
$msg = "";

// Acessar o IF quando o usuário clica no botão
if (isset($descreveEvento['Formuo'])){
//Salvar os dados da compra no banco de dados
$query_pa = "INSERT INTO payments_pagSeg (titulo, idEv, descricao, custoEvento, idGuia, dataGerada)
VALUES (:titulo, :idEv, :descricao, :custoEvento, :idGuia, :dataGerada)";
$add_pagSeg = $conn->prepare($query_pa);
$add_pagSeg->bindParam(":titulo", $titulo, PDO::PARAM_STR);
$add_pagSeg->bindParam(":idEv", $idEv);
$add_pagSeg->bindParam(":descricao", $descricao, PDO::PARAM_STR);
$add_pagSeg->bindParam(":custoEvento", $custoEvento);
$add_pagSeg->bindParam(":idGuia", $idGuia);
$add_pagSeg->bindParam(":dataGerada", "0000-00-00");

$add_pagSeg->execute();
// FIM DA INSERT EM PAYMENTS PICPAY

 }else{
    header("Location: ./view-eventos.php");
 }

?>


<form name="Formuo" id="Formuo" action="INSERIRPAGSEG.php" method="POST">
    <!-- N�?O EDITE OS COMANDOS DAS LINHAS ABAIXO -->
    <input type="hidden" name="titulo" id="titulo" value="SORTE" />
    <input type="hidden" name="idEv" id="idEv" value="33" />
    <input type="hidden" name="custoEvento" id="custoEvento" value="13.50" />
    <input type="hidden" name="descricao" id="descricao" value="A Lagoa Perdida" />
    <input type="hidden" name="idGuia" id="idGuia" value="01" />

    <input id="BtnPagS" type="image" src="https://stc.pagseguro.uol.com.br/public/img/botoes/pagamentos/209x48-pagar-azul-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
</form>



    </body>
</html>
