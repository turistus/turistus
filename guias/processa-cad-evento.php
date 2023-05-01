<?php
session_start();
define('ACCESS', true);
include_once '../connection.php';

//Receber os dados do formulário
$dados_CadEvento = filter_input_array(INPUT_POST, FILTER_DEFAULT);
var_dump($dados_CadEvento);
//$arquivo = $_FILES['foto']['name'];
//var_dump($arquivo);

if($dados_CadEvento['Cadastrar'] === "Cadastrar"){

        $novaData = date("Y/m/d");

        //Salvar os dados no bd
        $Cria_Evento = "INSERT INTO eventos (nome, breveDescricao, descricao, datai, dataf, encontro, transporte, alimentacao, valor, idGuia, idPt, dataUp )
         VALUES (:nome, :breveDescricao, :descricao, :datai, :dataf, :encontro, :transporte, :alimentacao, 1, :idGuia, :idpt, :dataUp)";

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
        var_dump("INSERIIII !!!!! agora dia: ". $novaData);

        // Acessa o IF quando cadastrar o usuário no BD
        if ($editandoEvento->rowCount()) {

                $eventoInserido= $conn->lastInsertId();
                $diretorio = "images/eventos/" . $eventoInserido ."/";
                // Criar o diretório
                mkdir($diretorio, 0755);

                // Receber os arquivos do formulário
                $arquivo = $_FILES['foto'];
                var_dump($arquivo);

                // Ler o array de arquivos
                for ($cont = 0; $cont < count($arquivo['name']); $cont++) {

                        // Receber nome da imagem
                        $nome_arquivo = $arquivo['name'][$cont];

                        // Criar o endereço de destino das imagens
                        $destino = $diretorio . $nome_arquivo;

                        // Acessa o IF quando realizar o upload corretamente
                        if (move_uploaded_file($arquivo['tmp_name'][$cont], $destino)) {
                        $query_imagem = "UPDATE eventos SET foto=:foto WHERE id = :eventoInserido";
                        $cad_imagem = $conn->prepare($query_imagem);
                        $cad_imagem->bindParam(':foto', $nome_arquivo);
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


        } else {
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não cadastrado com sucesso!</p>";
            }
 }else{
       echo "NAO CADASTROU !!";
       //header("Location: ../guias/painelGuia.php");
 }

if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
}

unset($dados);
//header("Location: ../guias/painelGuia.php");

?>