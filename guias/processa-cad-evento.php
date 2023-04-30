<?php
define('ACCESS', true);
include_once '../connection.php';

//Receber os dados do formulário
$dados_CadEvento = filter_input_array(INPUT_POST, FILTER_DEFAULT);
echo $dados_CadEvento['input="Cadastrar"'];
$novaData = date("Y/m/d");
// A variável recebe a mensagem de erro
$msg = "";
$_SESSION['msgs'] = "<p> AQUI CHEGOU !</p>";
if(!empty($dados_CadEvento['Cadastrar'])){
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
        $editandoEvento->bindParam(':foto', $arquivo['foto']);
        $editandoEvento->bindParam(':idGuia', $dados_CadEvento['idGuia']);
        $editandoEvento->bindParam(':dataUp', $novaData);
        $add_pay->execute();
        echo "passou aquifffffffffff";
        var_dump($result_markers);

        if(!empty($dados_CadEvento['Cadastrar'])){
                $last_id = $conn->lastInsertId();

                $CriarValores = "INSERT INTO valores (idEvento, vagas, total ) VALUES (:idEvento, :vagas, :total) ";
                $preparandoQuerySQL = $conn->prepare($CriarValores);
                $preparandoQuerySQL->bindParam(':idEvento', $last_id);
                $preparandoQuerySQL->bindParam(':vagas', $dados_CadEvento['vagas'][$chave]);
                $preparandoQuerySQL->bindParam(':total', $dados_CadEvento['total'][$chave]);
                $preparandoQuerySQL->execute();

                if ((isset($arquivo['foto'])) AND (!empty($arquivo['foto']))) {

                        for($cont = 0; $cont < count($arquivo['foto']); $cont++ ){
                        $destino = "images/eventos/" .$last_id .'/'. $arquivo['foto'][$cont];
                        //Criar o diretório
                        mkdir($destino, 0755);
                        //Upload do arquivo
                        $file = $arquivo['foto'][$cont];
                        move_uploaded_file($arquivo['tmp_name'], $destino . $file);
                        }

                                if(move_uploaded_file($arquivo['temp_name'][$cont], $destino)){
                                        $_SESSION['msg'] = "<p> Upload Realizado !</p>";
                                }else{
                                        $_SESSION['msg'] = "<p> Upload Não Realizado !</p>";
                                }
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



?>