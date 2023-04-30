<?php
define('ACCESS', true);
include_once '../connection.php';

//Receber os dados do formulário
$dados_CadEvento = filter_input_array(INPUT_POST, FILTER_DEFAULT);
var_dump($dados_CadEvento['input="Cadastrar"']);
$novaData = date("Y/m/d");

if(!empty($dados_CadEvento['Cadastrar'])){

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
               idGuia=:idGuia,
               dataUp=:dataUp";

        $editandoEvento = $conn->prepare($result_markers);
        $editandoEvento->bindParam(':nome', $dados_CadEvento['nome'], PDO::PARAM_STR);
        $editandoEvento->bindParam(':breveDescricao', $dados_CadEvento['breveDescricao']);
        $editandoEvento->bindParam(':descricao', $dados_CadEvento['descricao'], PDO::PARAM_STR);
        $editandoEvento->bindParam(':datai', $dados_CadEvento['datai']);
        $editandoEvento->bindParam(':dataf', $dados_CadEvento['dataf']);
        $editandoEvento->bindParam(':encontro', $dados_CadEvento['encontro']);
        $editandoEvento->bindParam(':transporte', $dados_CadEvento['transporte']);
        $editandoEvento->bindParam(':alimentacao', $dados_CadEvento['alimentacao']);
        $editandoEvento->bindParam(':idGuia', $dados_CadEvento['idGuia']);
        $editandoEvento->bindParam(':dataUp', $novaData);
        $editandoEvento->execute();
        echo "passou aquifffffffffff";

        // Acessa o IF quando cadastrar o usuário no BD
        if ($editandoEvento->rowCount()) {

                $eventoInserido= $conn->lastInsertId();
                $diretorio = "images/eventos/" . $eventoInserido ."/";
                // Criar o diretório
                mkdir($diretorio, 0755);

                // Receber os arquivos do formulário
                $arquivo = $_FILES['foto'];
                //var_dump($arquivo);

                // Ler o array de arquivos
                for ($cont = 0; $cont < count($arquivo['name']); $cont++) {

                        // Receber nome da imagem
                        $nome_arquivo = $arquivo['name'][$cont];

                        // Criar o endereço de destino das imagens
                        $destino = $diretorio . $arquivo['name'][$cont];

                        // Acessa o IF quando realizar o upload corretamente
                        if (move_uploaded_file($arquivo['tmp_name'][$cont], $destino)) {
                        $query_imagem = "UPDATE eventos SET foto=:foto WHERE id = :eventoInserido";
                        $cad_imagem = $conn->prepare($query_imagem);
                        $cad_imagem->bindParam(':foto', $foto);
                        $cad_imagem->bindParam(':eventoInserido', $eventoInserido);

                                if ($cad_imagem->execute()) {
                                        $_SESSION['msg'] = "<p style='color: green;'>FOTO cadastrado com sucesso!</p>";
                                } else {
                                        $_SESSION['msg'] = "<p style='color: #f00;'>Erro: FOTO não cadastrada com sucesso!</p>";
                                }
                        } else {
                        $_SESSION['msg'] = "<p style='color: #f00;'>Erro: FOTO não cadastrada com sucesso!</p>";
                        }
                }

                 // Ler o array de arquivos
                 for ($chave = 0; $chave < count($dados_CadEvento['vagas']); $chave++) {
                $CriarValores = "INSERT INTO valores (idEvento, vagas, total ) VALUES (:idEvento, :vagas, :total) ";
                $preparandoQuerySQL = $conn->prepare($CriarValores);
                $preparandoQuerySQL->bindParam(':idEvento', $eventoInserido);
                $preparandoQuerySQL->bindParam(':vagas', $dados_CadEvento['vagas'][$chave]);
                $preparandoQuerySQL->bindParam(':total', $dados_CadEvento['total'][$chave]);
                $preparandoQuerySQL->execute();
                }
                        if ($cad_imagem->execute()) {
                                $_SESSION['msg'] = "<p style='color: green;'>FOTO cadastrado com sucesso!</p>";
                        } else {
                                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: FOTO não cadastrada com sucesso!</p>";
                        }

        } else {
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não cadastrado com sucesso!</p>";
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



?>