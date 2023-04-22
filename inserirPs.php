
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
echo "oiii" . $titulo . $idEv . $descricao . $custoEvento . $idGuia;
    echo "Entrou no else";

$inserirPs = "INSERT INTO payments_pagSeg (titulo, idEv, descricao, custoEvento, idGuia, dataGerada)
                    VALUES ($titulo, $idEv, $descricao, $custoEvento, $idGuia, '0000-00-00')";
$add_pagSeg = $conn->prepare($inserirPs);
$add_pagSeg->execute();

echo "INSERIU !!!!!!!!!!!!!!!";

if ($add_pagSeg->rowCount()) {
    echo "AQUI È O ID DO AGENDAMENTO ENTAO PASSOU O INSERT !!";
    $last_insert_id = $conn->lastInsertId();
setcookie("id", $id, time()+3600);
setcookie("titulo", $nomeEvento, time()+3600);
setcookie("custoEvento", $custoEvento, time()+3600);
setcookie("descricao", $descricao, time()+3600);
setcookie("last_insert_id", $last_insert_id, time()+3600);


$msg = "SUCESSO !!!!!";
header("Location: ../pg/pagarPagSeguro/EnviaFormPag.php");
    }
    else{

    }

}
?>

