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
$result_markers = "INSERT INTO agendados ( dHora, idEvento, payments_picpays_id, turistaId, valorTotal, nivelAcesso) VALUES 
(:dHora, :idEvento, :payments_picpays_id, :turistaId, :valorTotal, :nivelAcesso)";

	 $add_pay = $conn->prepare($result_markers);
                $add_pay->bindParam(':dHora', $dados['dHora'], PDO::PARAM_STR);
                $add_pay->bindParam(':idEvento', $dados['idEvento'], PDO::PARAM_STR);
                $add_pay->bindParam(':payments_picpays_id', $dados['payments_picpays_id'], PDO::PARAM_STR);
                $add_pay->bindParam(':turistaId', $dados['turistaId'], PDO::PARAM_STR);
                $add_pay->bindParam(':valorTotal', $dados['valorTotal'], PDO::PARAM_STR);
                $add_pay->bindParam(':nivelAcesso', $dados['nivelAcesso'], PDO::PARAM_STR);
                $add_pay->execute();
                unset($dados);

header("Location: ../guias/painelGuia.php");
//var_dump($result_markers);

//$resultado_markers = mysqli_query($conn, $result_markers

if(($conn)){
	$_SESSION['msg'] = "<span style='color: green';>Usuario cadastrado com sucesso!</span>";
	header("Location: usuarios/painelUsuario.php");
}else{
	$_SESSION['msg'] = "<span style='color: red';>Erro: Usuario não foi cadastrado com sucesso!</span>";
	header("Location: usuarios/painelUsuario.php");	
}
