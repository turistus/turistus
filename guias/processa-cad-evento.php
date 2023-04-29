<?php
define('ACCESS', true);

ob_start();
include_once '../connection.php';

//Receber os dados do formulário
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
var_dump($dados);

// A variável recebe a mensagem de erro
        $msg = "";

        if(!empty($dados['Cadastrar'])){
                $arquivo = $_FILES['foto'];

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
                       dataUp=:dataUp";

	 $editandoEvento = $conn->prepare($result_markers);
         $editandoEvento->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
         $editandoEvento->bindParam(':breveDescricao', $dados['breveDescricao']);
         $editandoEvento->bindParam(':descricao', $dados['descricao'], PDO::PARAM_STR);
         $editandoEvento->bindParam(':datai', $dados['datai']);
         $editandoEvento->bindParam(':dataf', $dados['dataf']);
         $editandoEvento->bindParam(':encontro', $dados['encontro']);
         $editandoEvento->bindParam(':transporte', $dados['transporte']);
         $editandoEvento->bindParam(':alimentacao', $dados['alimentacao']);
         $editandoEvento->bindParam(':foto', $arquivo['name']);
         $editandoEvento->bindParam(':dataUp', $dados['dataUp']);

                $add_pay->execute();

        if(!empty($dados['Cadastrar'])){
                $last_id = $conn->lastInsertId();
                $CriarValores = "INSERT INTO valores (idEvento, vagas, total ) VALUES (:idEvento, :vagas, :total) ";
                $preparandoQuerySQL = $conn->prepare($CriarValores);
                $preparandoQuerySQL->bindParam(':idEvento', $last_id);
                $preparandoQuerySQL->bindParam(':vagas', $dados['vagas'][$chave]);
                $preparandoQuerySQL->bindParam(':total', $dados['valor'][$chave]);
                $preparandoQuerySQL->execute();

                for($cont = 0; $cont < count($arquivo['name']); $cont++ ){
                        $destino = "images/eventos/" .$id . $arquivo['name'][$cont];
        //Criar o diretório
                mkdir($destino, 0755);
                //Upload do arquivo
                $file = $arquivo['name'];
                move_uploaded_file($arquivo['tmp_name'], $destino . $file);
                }

                if(move_uploaded_file($arquivo['temp_name'][$cont], $destino)){
                        $_SESSION['msg'] = "<p> Upload Realizado !</p>";
                }else{
                        $_SESSION['msg'] = "<p> Upload Não Realizado !</p>";
                     }
                }
        }
        if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
        }

        unset($dados);
        //header("Location: ../guias/painelGuia.php");

if(($conn)){
	$_SESSION['msg'] = "<span style='color: green';>evento cadastrado com sucesso!</span>";
	header("Location: painelGuia.php");
}else{
	$_SESSION['msg'] = "<span style='color: red';>Erro: evento não foi cadastrado com sucesso!</span>";
	header("Location: painelGuia.php");
}
