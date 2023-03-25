<!--Pagina criada somente aos ADM para cadastro de Pontos turisticos com 1 imagem e informaçoes basicas. -->

<?php
session_start();

define('ACCESS', true);
include_once '../connection.php';
include_once '../adm/validate.php';

?> 
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="../images/icon/favicon.ico" >
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <title>Cadastro Ponto Turistico - ADMIN</title>
    </head>
<body>
        <?php
            include_once './menu.php';
        ?>

        <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>


<!-- DIV CONTAINER FORMULARIO -->
<main class="content" style="font-family: 'Acme'; font-size: 20px;">
    <div class="shadow-lg p-3 mb-5 bg-white rounded" style="border: solid 1px black;">
        <!-- PRIMEIRA LINHA -->
        <div class="row" >
        
                        <h2 style="background: url(../images/bussola.jpg);">Cadastro de novo ponto turistico</h2> 
                        <?php
                        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                 		
                            //painel onde os ADM insere um ponto turistico
                            try {

                		        if (!empty($data['SendAddMsg'])) {
                		            $attachment = $_FILES['attachment'];
                		            //var_dump($data);
                		            //var_dump($attachment);
                		            $query_msg = "INSERT INTO pontosturisticos (name, descricao, price, image, created, idGuia, cidade, uf) VALUES (:name, :descricao, :price, :image, NOW(), :guiaId, :cidade, :uf)";
                		            $add_msg = $conn->prepare($query_msg);
                		            $add_msg->bindParam(':name', $data['name'], PDO::PARAM_STR);
                		            $add_msg->bindParam(':descricao', $data['descricao'], PDO::PARAM_STR);
                		            $add_msg->bindParam(':price', $data['price'], PDO::PARAM_STR);
                		            $add_msg->bindParam(':image', $attachment['name'], PDO::PARAM_STR);
                                    $add_msg->bindParam(':cidade', $data['cidade'], PDO::PARAM_STR);
                                    $add_msg->bindParam(':uf', $data['uf'], PDO::PARAM_STR);
                                    $add_msg->bindParam(':guiaId', $data['guiaId'], PDO::PARAM_STR);
                                    		       
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
                                echo "";
                          }                                           
                         } catch (Exception $e) {
                                    echo "Erro: Mensagem de contato não enviada com sucesso 1 !<br>" . $e;
                                } 
                        //}
                //aqui e onde vai SALVAR no BANCOOOOOOO  ATE AQUII
                        ?>
            <!-- SEGUNDA (ROW) LINHA -->
            <div class="row" style="border: solid 1px black; padding: 10px; margin: 20px;">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" style="padding: 10px;">
                    <form name="add_msg" action="" method="POST" enctype="multipart/form-data">
                        <label>Nome </label>
                        <input type="text" name="name" id="name" placeholder="Nome completo" value="<?php
                        if (isset($data['name'])) {
                            echo $data['name'];
                        }
                        ?>" autofocus required>
                </div>

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" style="padding: 10px;">             
                        <label>Descrição </label>
                          
                        <textarea class="form-control" rows="5" cols="28" name="descricao" id="descricao" placeholder="Descreva BREVEMENTE" value="<?php
                        if (isset($data['descricao'])) {
                            echo $data['descricao'];
                        }
                        ?>"> </textarea>
                </div>

                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12" style="padding: 10px;"> 
                        <label>Cidade </label>
                        <input type="text" name="cidade" id="cidade" placeholder="Cidade"  value="<?php
                        if (isset($data['cidade'])) {
                            echo $data['cidade'];
                        }
                        ?>" required>
                </div>

                <div class="col" style="padding: 10px; ">        
                        <label> Valor </label>
                        <input type="text" name="price" id="price" placeholder="Valor"  value="<?php
                        if (isset($data['price'])) {
                            echo $data['price'];
                        }
                        ?>" required>
                </div> 
                
                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12" style="padding: 10px;">        
                        <label> UF </label>
                        <input type="text" name="uf" id="uf" placeholder="uf"  value="<?php
                        if (isset($data['uf'])) {
                            echo $data['uf'];
                        }
                        ?>" required>
                </div>

                <div class="col-xl-2 col-lg-6 col-md-6 col-sm-2" style="padding: 10px;">          
                        <label> Guia NATIVO </label>
                     
                        <input type="text" name="guiaId" id="guiaId" placeholder="guiaId"  value="<?php
                        if (isset($data['guiaId'])) {
                            echo $data['guiaId'];
                        }
                        ?>" required>
                        
                </div>

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" style="padding: 10px;">
                        <label>Foto Ponto Turistico</label>
                        <input type="file" name="attachment" id="attachment" onchange="previewImagem()" ><br><br>

                        <div class="card">
                             <img style="max-height: 200px" src='<?php echo "./images/pontosturisticos/$id/$image"; ?>' class="card-img-top" alt="...">
                        </div>

             			<input type="submit" value="Enviar" name="SendAddMsg">
                </div>

                    </form>

                    <!-- Para buscar a foto na pasta-->
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>   
                    <script>
                        function previewImagem(){
                            var imagem = document.querySelector('input[name=attachment]').files[0];
                            var preview = document.querySelector('img');

                            var reader = new FileReader();

                            reader.onloadend = function(){
                                preview.src = reader.result;
                            }
                            if(imagem){
                                reader.readAsDataURL(imagem);
                            }else{
                                preview.src = "";
                            }
                        }

                    </script>
                    
            </div><!-- Fim da DIV Row 2 -->        
        </div><!-- Fim da ROW principal -->
    </div><!-- Fim da Shadown-->    
</main>


PAGINA OK Funcional.

        <?php
            include_once '../rodape.php';
        ?>
    </body>
</html>
