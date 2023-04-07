<?php
define('ACCESS', true);
session_start();
ob_start();
include_once '../connection.php';

//Receber os dados do formulário
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//var_dump($dados);
//Aqui incripta a senha pra GRAVAR NO BANCO
$dados['password'] = password_hash($dados['password'], PASSWORD_DEFAULT);


// A variável recebe a mensagem de erro
        $msg = "";

//Salvar os dados no bd
$result_markers = "INSERT INTO turistas ( name, email, password, celular, dtnascimento, aceite) VALUES (:name, :email, :password, :celular, :dtnascimento, :aceite)";

	 $add_pay = $conn->prepare($result_markers);
                $add_pay->bindParam(':name', $dados['name'], PDO::PARAM_STR);
                $add_pay->bindParam(':email', $dados['email'], PDO::PARAM_STR);
                $add_pay->bindParam(':password', $dados['password'], PDO::PARAM_STR);
                $add_pay->bindParam(':celular', $dados['celular'], PDO::PARAM_STR);
                $add_pay->bindParam(':dtnascimento', $dados['dtnascimento'], PDO::PARAM_STR);
                $add_pay->bindParam(':aceite', $dados['aceite'], PDO::PARAM_STR);

                $add_pay->execute();
                      //PArte para mandar para o painel turista as Sessions do logado
                $_SESSION['user_id'] = $dados['id'];
                $_SESSION['user_name'] = $dados['name'];
                $_SESSION['user_email'] = $dados['email'];
                $_SESSION['user_key'] = $dados['password'];
                unset($dados);
//Aqui o P é P maiusculo.
header("Location: ../pg/eventos.php");
//var_dump($result_markers);


//$resultado_markers = mysqli_query($conn, $result_markers

if(mysqli_insert_id($connex)){
	$_SESSION['msg'] = "<span style='color: green';>Usuario cadastrado com sucesso!</span>";
	header("Location: ../usuarios/PainelTurista.php");
}else{
	$_SESSION['msg'] = "<span style='color: red';>Erro: Usuario não foi cadastrado com sucesso!</span>";
	header("Location: ../index.php");
}
