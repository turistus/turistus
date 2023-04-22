
<?php
define('ACCESS', true);

include("./connection.php");

//Receber os dados do formulário
$descreveEvento = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// A variável recebe a mensagem de erro
$msg = "";

// Acessar o IF quando o usuário clica no botão
if ($descreveEvento['titulo'] != true){


echo "nao deu";

}else{

$titulo=$descreveEvento['titulo'];
$idEv=$descreveEvento['idEv'];
$descricao=$descreveEvento['descricao'];
$custoEvento=$descreveEvento['custoEvento'];
$idGuia=$descreveEvento['idGuia'];
echo "oiii" . $titulo . $idEv . $descricao . $custoEvento . $idguia;
    echo "Entrou no else";
//Salvar os dados da compra no banco de dados
$query_pa = "INSERT INTO payments_pagSeg (titulo, idEv, descricao, custoEvento, idGuia, dataGerada)
                    VALUES ($titulo, $idEv, $descricao, $custoEvento, $idguia, '0000-00-00')";
$add_pagSeg = $conn->prepare($query_pa);
$add_pagSeg->execute();
// FIM DA INSERT EM PAYMENTS PICPAY
echo "INSERIU !!!!!!!!!!!!!!!";

if ($add_pagSeg->rowCount()) {
    echo "AQUI È O ID DO AGENDAMENTO ENTAO PASSOU O INSERT !!";
    $last_insert_id = $conn->lastInsertId();

setcookie("titulo", $nomeEvento, time()+3600);
setcookie("custoEvento", $custoEvento, time()+3600);
setcookie("descricao", $descricao, time()+3600);
setcookie("last_insert_id", $last_insert_id, time()+3600);
setcookie("id", $id, time()+3600);

$msg = "SUCESSO !!!!!";
header("Location: ../pg/pagarPagSeguro/EnviaFormPag.php");
    }
    else{

    }

}
?>

