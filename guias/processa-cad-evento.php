<?php
define('ACCESS', true);
include_once '../connection.php';

//Receber os dados do formulário
$dados_CadEvento = filter_input_array(INPUT_POST, FILTER_DEFAULT);
var_dump($dados_CadEvento['input=']."VAAAR");
echo $dados_CadEvento;
$novaData = date("Y/m/d");
echo $novaData;


        $last_id = 95;
        $v1=1;
        $v2=10;

        $CriarValores = "INSERT INTO valores (idEvento, vagas, total ) VALUES (:idEvento, :vagas, :total) ";
        $preparandoQuerySQL = $conn->prepare($CriarValores);
        $preparandoQuerySQL->bindParam(':idEvento', $last_id);
        $preparandoQuerySQL->bindParam(':vagas',$v1);
        $preparandoQuerySQL->bindParam(':total', $v2);
        $preparandoQuerySQL->execute();



?>