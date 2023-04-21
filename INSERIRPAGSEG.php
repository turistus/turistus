
<?php
define('ACCESS', true);

include("../connection.php");

//Receber os dados do formulário
$descreveEvento = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// A variável recebe a mensagem de erro
$msg = "";

// Acessar o IF quando o usuário clica no botão
if ($descreveEvento['BotaoPagar'] == true){
//Salvar os dados da compra no banco de dados
$query_pa = "INSERT INTO payments_pagSeg (titulo, idEv, descricao, custoEvento, idGuia, dataGerada)
                    VALUES (:titulo, :idEv, :descricao, :custoEvento, :idGuia, :dataGerada)";
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
header("location: ../pg/pagarPagSeguro/EnviaFormPag.php?id=<?php echo $id;?>");
    }else{}
}
?>

