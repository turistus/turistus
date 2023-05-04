<?php
session_start();
define('ACCESS', true);
include_once '../connection.php';

//Receber os dados do formulário
$dados_CadEvento = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if($dados_CadEvento['Cadastrar'] === "Cadastrar"){

        $novaData = date("Y/m/d");

        //Salvar os dados no bd
        $Cria_Evento = "INSERT INTO eventos (nome, breveDescricao, descricao, datai, dataf, encontro, transporte, alimentacao, valor, idGuia, idPt, dataUp )
         VALUES (:nome, :breveDescricao, :descricao, :datai, :dataf, :encontro, :transporte, :alimentacao, 1, :idGuia, :idPt, :dataUp)";

        $editandoEvento = $conn->prepare($Cria_Evento);
        $editandoEvento->bindParam(':nome', $dados_CadEvento['nome']);
        $editandoEvento->bindParam(':breveDescricao', $dados_CadEvento['breveDescricao']);
        $editandoEvento->bindParam(':descricao', $dados_CadEvento['descricao']);
        $editandoEvento->bindParam(':datai', $dados_CadEvento['datai']);
        $editandoEvento->bindParam(':dataf', $dados_CadEvento['dataf']);
        $editandoEvento->bindParam(':encontro', $dados_CadEvento['encontro']);
        $editandoEvento->bindParam(':transporte', $dados_CadEvento['transporte']);
        $editandoEvento->bindParam(':alimentacao', $dados_CadEvento['alimentacao']);
        $editandoEvento->bindParam(':idGuia', $dados_CadEvento['idGuia']);
        $editandoEvento->bindParam(':idPt', $dados_CadEvento['idPt']);
        $editandoEvento->bindParam(':dataUp', $novaData);
        $editandoEvento->execute();

        // Acessa o IF quando cadastrar o usuário no BD
        if ($editandoEvento->rowCount()) {

                $eventoInserido= $conn->lastInsertId();
                // Ler o array de arquivos
                for ($chave = 0; $chave < count($dados_CadEvento['vagas']); $chave++) {
                        $CriarValores = "INSERT INTO valores (idEvento, vagas, total ) VALUES (:idEvento, :vagas, :total) ";
                        $preparandoQuerySQL = $conn->prepare($CriarValores);
                        $preparandoQuerySQL->bindParam(':idEvento', $eventoInserido);
                        $preparandoQuerySQL->bindParam(':vagas', $dados_CadEvento['vagas'][$chave]);
                        $preparandoQuerySQL->bindParam(':total', $dados_CadEvento['total'][$chave]);
                        $preparandoQuerySQL->execute();

                                if ($preparandoQuerySQL->rowCount()) {
                                        $_SESSION['msg'] = "<p style='color: green;'> Inseriu valores com sucesso!</p>";
                                } else {
                                        $_SESSION['msg'] = "<p style='color: #f00;'> Erro: Não Inseriu Valores !</p>";
                                }
                        }

                $diretorio = "images/eventos/$eventoInserido/";
                // Criar o diretório
                mkdir($diretorio, 0755);

                // Receber os arquivos do formulário
                $arquivo = $_FILES['foto'];

                // Ler o array de arquivos
                for ($cont = 0; $cont < count($arquivo['name']); $cont++) {

                        // Receber nome da imagem
                        $nome_arquivo = $arquivo['name'][$cont];

                        // Criar o endereço de destino das imagens
                        $destino = $diretorio . $arquivo['name'][$cont];

                        // Acessa o IF quando realizar o upload corretamente AQQUQUIII QE TEM O B.O SE ELE NAO MOVER PARA A PASTA COMO FAZ O INSERT.

                        if(move_uploaded_file($_FILES['foto']['tmp_name'][$cont], $diretorio.$_FILES['foto']['name'])){
                        $query_imagem = "INSERT INTO foto_Eventos (foto, idEv) VALUES (:foto, :idEv )";
                        $cad_imagem = $conn->prepare($query_imagem);
                        $cad_imagem->bindParam(':foto', $nome_arquivo);
                        $cad_imagem->bindParam(':idEv', $eventoInserido);


                                if ($cad_imagem->execute()) {
                                        $_SESSION['msg'] = "<p style='color: green;'> Evento Criado com sucesso!</p>";
                                } else {
                                        $_SESSION['msg'] = "<p style='color: #f00;'> Erro: Evento não criado com sucesso!</p>";
                                }
                        }else{
                                echo "NAO ENVIOU IMAGEM PRO SERVIDOR";
                        }

                }


        } else {
                $_SESSION['msg'] = "<p style='color: #f00;'> Erro: não cadastrou !</p>";
            }
 }else{
       echo "NAO CADASTROU !!";
       //header("Location: ../guias/painelGuia.php");
 }

if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
}

unset($dados_CadEvento);
//header("Location: ../guias/painelGuia.php");

?>