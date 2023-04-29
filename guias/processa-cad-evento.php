<?php
define('ACCESS', true);

ob_start();
include_once '../connection.php';

//Receber os dados do formulário
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
var_dump($dados);

// A variável recebe a mensagem de erro
        $msg = "";

//Salvar os dados no bd
$result_markers = "INSERT INTO eventos SET
                       nome=:nome,
                       breveDescricao=:breveDescricao
                       descricao=:descricao,
                       datai=:datai,
                       dataf=:dataf,
                       encontro=:encontro,
                       transporte=:transporte,
                       alimentacao=:alimentacao,
                       foto=:foto,
                       vagas=:vagas,
                       valor=:valor,
                       dataUp=:dataUp";

	 $add_pay = $conn->prepare($result_markers);
         $editandoEvento->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
         $editandoEvento->bindParam(':breveDescricao', $dados['breveDescricao']);
         $editandoEvento->bindParam(':descricao', $dados['descricao'], PDO::PARAM_STR);
         $editandoEvento->bindParam(':datai', $dados['datai']);
         $editandoEvento->bindParam(':dataf', $dados['dataf']);
         $editandoEvento->bindParam(':encontro', $dados['encontro']);
         $editandoEvento->bindParam(':transporte', $dados['transporte']);
         $editandoEvento->bindParam(':alimentacao', $dados['alimentacao']);
         $editandoEvento->bindParam(':foto', $dados['foto']);
         $editandoEvento->bindParam(':dataUp', $dados['dataUp']);

                $add_pay->execute();

                $CriarValores = "INSERT INTO valores (idEvento, vagas, total ) VALUES (:idEvento, :vagas, :total) ";
                $preparandoQuerySQL = $conn->prepare($result_markers);
                $editandoEvento->bindParam(':idEvento', $id);
                $editandoEvento->bindParam(':vagas', $dados['vagas'][$chave]);
                $editandoEvento->bindParam(':total', $dados['valor'][$chave]);


                unset($dados);

header("Location: ../guias/painelGuia.php");
//var_dump($result_markers);

//$resultado_markers = mysqli_query($conn, $result_markers

if(($conn)){
	$_SESSION['msg'] = "<span style='color: green';>evento cadastrado com sucesso!</span>";
	header("Location: painelGuia.php");
}else{
	$_SESSION['msg'] = "<span style='color: red';>Erro: evento não foi cadastrado com sucesso!</span>";
	header("Location: painelGuia.php");
}
