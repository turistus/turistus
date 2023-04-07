<?php
define('ACCESS', true);

ob_start();
include_once '../connection.php';

//Receber os dados do formulário
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//var_dump($dados);
//Aqui incripta a senha pra GRAVAR NO BANCO
$dados['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);

// A variável recebe a mensagem de erro
        $msg = "";

//Salvar os dados no bd
$result_markers = "INSERT INTO servicos ( nome, cpf, email, senha, celular, dtnascimento, uf, valor, aceite) VALUES (:nome, :cpf, :email, :senha, :celular, :dtnascimento, :uf, 0, :aceite)";

	 $add_pay = $conn->prepare($result_markers);
                $add_pay->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
                $add_pay->bindParam(':cpf', $dados['cpf'], PDO::PARAM_STR);
                $add_pay->bindParam(':email', $dados['email'], PDO::PARAM_STR);
                $add_pay->bindParam(':senha', $dados['senha'], PDO::PARAM_STR);
                $add_pay->bindParam(':celular', $dados['celular'], PDO::PARAM_STR);
                $add_pay->bindParam(':dtnascimento', $dados['dtnascimento'], PDO::PARAM_STR);
                $add_pay->bindParam(':uf', $dados['uf'], PDO::PARAM_STR);
                $add_pay->bindParam(':aceite', $dados['aceite'], PDO::PARAM_STR);

                $add_pay->execute();
                $nome = $_SESSION['user_nome'];
                unset($dados);

header("Location: ../guias/painelGuia.php");
//var_dump($result_markers);

//$resultado_markers = mysqli_query($conn, $result_markers
/*
if($conn->affected_rows){
	$_SESSION['msg'] = "<span style='color: green';>Guia cadastrado com sucesso!</span>";
	header("Location: painelGuia.php");
}else{
	$_SESSION['msg'] = "<span style='color: red';>Erro: Guia não foi cadastrado com sucesso!</span>";
	header("Location: painelGuia.php");
}
*/