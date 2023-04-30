<?php
define('ACCESS', true);
include_once '../connection.php';

//Receber os dados do formulário
$dados_CadEvento = filter_input_array(INPUT_POST, FILTER_DEFAULT);
var_dump($dados_CadEvento."VAAAR");
echo $dados_CadEvento;
$novaData = date("Y/m/d");
echo $novaData;

if(!empty($dados_CadEvento['Cadastrar'])){
        $last_id = 96;

        $CriarValores = "INSERT INTO valores (idEvento, vagas, total ) VALUES (:idEvento, :vagas, :total) ";
        $preparandoQuerySQL = $conn->prepare($CriarValores);
        $preparandoQuerySQL->bindParam(':idEvento', $last_id);
        $preparandoQuerySQL->bindParam(':vagas','1');
        $preparandoQuerySQL->bindParam(':total', '20');
        $preparandoQuerySQL->execute();

}

?>