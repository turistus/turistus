<?php
define('ACCESS', true);
include_once 'connection.php';
?>
<!doctype html>
<html lang="pt-br">
    <head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	        <title>Chico Bel Seguros</title>
    </head>
    <body>
<?php
  include_once '../adm/menu.php';
  ?>

<div class="container">
  <div class="row">
   ...
  </div>
</div>




<!-- DIV CONTAINER FORMULARIO -->
<div class="container" style="font-family: 'Acme'; font-size: 20px;">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

        
        <h2 style="background: black;">Cadastro de novo ponto turistico</h2> 
            

        <?php
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
 		
 		//if ($add_msg->rowCount()) {
              

              //painel onde os ADM insere um ponto turistico
            try {

		        if (!empty($data['SendAddMsg'])) {
		            $attachment = $_FILES['attachment'];
		            //var_dump($data);
		            //var_dump($attachment);
		            $query_msg = "INSERT INTO pontosturisticos (name, descricao, local, valor, file, created) VALUES (:name, :descricao, :local, :valor, :file, NOW())";
		            $add_msg = $conn->prepare($query_msg);

		            $add_msg->bindParam(':name', $data['name'], PDO::PARAM_STR);
		            $add_msg->bindParam(':descricao', $data['descricao'], PDO::PARAM_STR);
		            $add_msg->bindParam(':local', $data['local'], PDO::PARAM_STR);
		            $add_msg->bindParam(':valor', $data['valor'], PDO::PARAM_STR);
		            $add_msg->bindParam(':file', $attachment['name'], PDO::PARAM_STR);
		       
		            $add_msg->execute();

		            unset($data);
              

                    if ((isset($attachment['name'])) AND (!empty($attachment['name']))) {
                        ///Recuperar último ID inserido no banco de dados
                        $last_id = $conn->lastInsertId();
                        
                        //Diretório onde o arquivo será salvo
                        $directory = '../images/pontosturisticos/' . $last_id . "/";
                        
                        //Criar o diretório
                        mkdir($directory, 0755);
                        
                        //Upload do arquivo
                        $file = $attachment['name'];
                        move_uploaded_file($attachment['tmp_name'], $directory . $file);
                    }
                    echo "Mensagem de FOTO enviada com sucesso!<br>";
                
          }                                           
         } catch (Exception $e) {
                    //echo "Erro: Mensagem de contato não enviada com sucesso 1 !<br>" . $e;
                } 
        //}
//aqui e onde vai SALVAR no BANCOOOOOOO  ATE AQUII
        ?>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <form name="add_msg" action="" method="POST" enctype="multipart/form-data">
            <label>Nome </label>
            <input type="text" name="name" id="name" placeholder="Nome completo" value="<?php
            if (isset($data['name'])) {
                echo $data['name'];
            }
            ?>" autofocus required><br><br>

            <label>Descrição </label>
            <input type="content" name="descricao" id="descricao" placeholder="Descreva o lugar"  value="<?php
            if (isset($data['descricao'])) {
                echo $data['descricao'];
            }
            ?>" required><br><br>

            <label>Localização </label>
            <input type="text" name="local" id="local" placeholder="Região"  value="<?php
            if (isset($data['local'])) {
                echo $data['local'];
            }
            ?>" required><br><br>

            <label>Valor </label>
            <input type="text" name="valor" id="valor" placeholder="valor"  value="<?php
            if (isset($data['valor'])) {
                echo $data['valor'];
            }
            ?>" required><br><br>
         

            <label>Foto Ponto Turistico</label>
            <input type="file" name="attachment" id="attachment"><br><br>

 			<input type="submit" value="Enviar" name="SendAddMsg">
        </form>
  	</div>
</div>



        <div class="p-3 mb-2 bg-primary text-white">Desconecta rodape Painel ADM</div>
    </body>
</html>
