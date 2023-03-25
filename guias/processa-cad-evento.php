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
$result_markers = "INSERT INTO eventos ( nome, datah, breveDescricao, descricao, valor, idGuia, idPt ) VALUES 
(:nome, :datah, :breveDescricao, :descricao, :valor, :idGuia, :idPt )";

	 $add_pay = $conn->prepare($result_markers);
                $add_pay->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
                $add_pay->bindParam(':datah', $dados['datah'], PDO::PARAM_STR);
                $add_pay->bindParam(':breveDescricao', $dados['breveDescricao'], PDO::PARAM_STR);
                $add_pay->bindParam(':descricao', $dados['descricao'], PDO::PARAM_STR);
                $add_pay->bindParam(':valor', $dados['valor'], PDO::PARAM_STR);
                $add_pay->bindParam(':idPt', $dados['idPt'], PDO::PARAM_STR);
                $add_pay->bindParam(':idGuia', $dados['idGuia'], PDO::PARAM_STR);
                
                $add_pay->execute();
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
