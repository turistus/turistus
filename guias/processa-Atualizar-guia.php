<!-- Função utilizada para atualizar o PERFIL do GUIA -->
<?php
define('ACCESS', true);
ob_start();
include_once '../connection.php';
$Uid = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
echo $Uid;


//Receber os dados do formulário
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
var_dump($dados);

// A variável recebe a mensagem de erro
        $msg = "";

try {
	if (!empty($dados['SendAddMsg'])) {
		$attachment = $_FILES['attachment'];
		echo $attachment['name'] ."AAAAA";
		var_dump($attachment);
		//Salvar os dados no bd
		$result_markers = "UPDATE servicos SET 
		image = :image, apelido = :apelido, nome = :nome, cpf = :cpf, email = :email, senha = :senha, 
		celular = :celular, dtnascimento = :dtnascimento, uf = :uf, valor = :valor, aceite = 1, 
		banco = :banco, agencia = :agencia, conta = :conta, pix = :pix
		WHERE servicos.id = :id ";
		$add_pay = $conn->prepare($result_markers);
		
		$add_pay->bindParam(':image', $attachment['name'], PDO::PARAM_STR);
		$add_pay->bindParam(':apelido', $dados['apelido'], PDO::PARAM_STR);
		$add_pay->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
		$add_pay->bindParam(':cpf', $dados['cpf'], PDO::PARAM_STR);
		$add_pay->bindParam(':email', $dados['email'], PDO::PARAM_STR);
		$add_pay->bindParam(':senha', $dados['senha'], PDO::PARAM_STR);
		$add_pay->bindParam(':celular', $dados['celular'], PDO::PARAM_STR);
		$add_pay->bindParam(':dtnascimento', $dados['dtnascimento'], PDO::PARAM_STR);
		$add_pay->bindParam(':uf', $dados['uf'], PDO::PARAM_STR);
		$add_pay->bindParam(':valor', $dados['valor'], PDO::PARAM_STR);
		$add_pay->bindParam(':banco', $dados['banco'], PDO::PARAM_STR);
		$add_pay->bindParam(':agencia', $dados['agencia'], PDO::PARAM_STR);
		$add_pay->bindParam(':conta', $dados['conta'], PDO::PARAM_STR);
		$add_pay->bindParam(':pix', $dados['pix'], PDO::PARAM_STR);
		$add_pay->bindParam(':id', $Uid);		
	        $add_pay->execute();
            unset($dados);
				
				if ((isset($attachment['name'])) AND (!empty($attachment['name']))) {
					///Recuperar último ID inserido no banco de dados
					//$last_id = $conn->lastInsertId();
					//echo "$last_id";
					//Diretório onde o arquivo será salvo
					$directory = '../images/guias/' . $Uid . "/";
					
					//Criar o diretório
					mkdir($directory, 0755);
					
					//Upload do arquivo
					$file = $attachment['name'];
					move_uploaded_file($attachment['tmp_name'], $directory . $file);
					echo " Imagem enviada com sucesso ! <br>";
				}
				echo "Mensagem de FOTO NAO enviada com sucesso!<br>";
			echo "";
	  	}                                           
	} catch (Exception $e) {
				echo "Erro: Mensagem de contato não enviada com sucesso 1 !<br>" . $e;
			}
    

//header("Location: ../guias/painelGuia.php");

