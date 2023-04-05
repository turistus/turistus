<!--Pagina criada somente aos ADM para cadastro de Pontos turisticos com 1 imagem e informaçoes basicas. -->

<?php
//session_start();

define('ACCESS', true);
include_once 'connection.php';


?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="../images/icon/favicon.ico" >
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./css/estilobtnenviar.css">

        <title>Solicitação Novo Ponto Turistico</title>
    </head>
<body>
        <?php
            include_once 'menuprincipal.php';
        ?>

        <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>


<!-- DIV CONTAINER FORMULARIO -->
<main class="content" style="font-family: 'Acme'; font-size: 20px;">
    <div class="shadow-lg p-3 mb-5 ml-3 mr-3 bg-white rounded" style="border: solid 1px black;">
        <!-- PRIMEIRA LINHA -->
        <div class="row" >

                        <h2 style="background: url(../images/bussola.jpg); margin-left: 10px;">Novo ponto turistico</h2>
                        <?php
                        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                            //painel onde os ADM insere um ponto turistico
                            try {

                		        if (!empty($data['SendAddMsg'])) {
                		            $attachment = $_FILES['attachment'];
                		            //var_dump($data);
                		            //var_dump($attachment);
                		            $query_msg = "INSERT INTO pontosturisticos (name, descricao, price, image, created, idGuia, cidade, uf, autor, cpf, nascimentoAut, lanchonete, liberado) VALUES (:name, :descricao, 13, :image, NOW(), 1, :cidade, :uf, :autor, :cpf, :nascimentoAut, :lanchonete, 0)";
                		            $add_msg = $conn->prepare($query_msg);

                		            $add_msg->bindParam(':name', $data['name'], PDO::PARAM_STR);
                		            $add_msg->bindParam(':descricao', $data['descricao'], PDO::PARAM_STR);
                		            $add_msg->bindParam(':image', $attachment['name'], PDO::PARAM_STR);
                                    $add_msg->bindParam(':cidade', $data['cidade'], PDO::PARAM_STR);
                                    $add_msg->bindParam(':uf', $data['uf'], PDO::PARAM_STR);
                                    $add_msg->bindParam(':autor', $data['autor'], PDO::PARAM_STR);
                                    $add_msg->bindParam(':cpf', $data['cpf'], PDO::PARAM_STR);
                                    $add_msg->bindParam(':nascimentoAut', $data['nascimentoAut'], PDO::PARAM_STR);
                                    $add_msg->bindParam(':lanchonete', $data['lanchonete'], PDO::PARAM_STR);



                		            $add_msg->execute();

                		            unset($data);

                                    if ((isset($attachment['name'])) AND (!empty($attachment['name']))) {
                                        ///Recuperar último ID inserido no banco de dados
                                        $last_id = $conn->lastInsertId();

                                        //Diretório onde o arquivo será salvo
                                        $directory = 'images/pontosturisticos/' . $last_id . "/";

                                        //Criar o diretório
                                        mkdir($directory, 0755);

                                        //Upload do arquivo
                                        $file = $attachment['name'];
                                        move_uploaded_file($attachment['tmp_name'], $directory . $file);
                                    }
                                    //echo "Mensagem de foto enviada com sucesso!<br>";
                                echo "Solicitação Enviada !";
                          }
                         } catch (Exception $e) {
                                    echo "Erro: Mensagem de contato não enviada com sucesso !<br>" . $e;
                                }
                        //}
                //aqui e onde vai SALVAR no BANCOOOOOOO  ATE AQUII
                        ?>
            <!-- SEGUNDA (ROW) LINHA -->
            <div class="row" style=" padding: 10px; margin: 20px;">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-10" style="padding: 10px;">
                    <form name="add_msg" action="" method="POST" enctype="multipart/form-data">
                        <label>Nome </label>
                        <input type="text" name="name" id="name" placeholder=" Nome turistico " value="<?php
                        if (isset($data['name'])) {
                            echo $data['name'];
                        }
                        ?>" autofocus required>
                </div>

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" style="padding: 10px;">
                        <label>Descrição </label>

                        <textarea class="form-control" rows="3" cols="28" name="descricao" id="descricao" placeholder="Descreva BREVEMENTE" value="<?php
                        if (isset($data['descricao'])) {
                            echo $data['descricao'];
                        }
                        ?>" required> </textarea>
                        <small class="text-muted"> Descreva toda a história do ponto turistico.</small>
                </div>

                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-4" style="padding: 10px;">

                    <label class="uf">Estado UF</label>
                                <select name="uf" class="custom-select d-block w-100 uf" id="uf" required>
                                    <option value="">Selecione</option>
                                    <option value="AC">AC</option>
                                    <option value="AL">AL</option>
                                    <option value="AP">AP</option>
                                    <option value="AM">AM</option>
                                    <option value="BA">BA</option>
                                    <option value="CE">CE</option>
                                    <option value="DF">DF</option>
                                    <option value="ES">ES</option>
                                    <option value="GO">GO</option>
                                    <option value="MA">MA</option>
                                    <option value="MT">MT</option>
                                    <option value="MS">MS</option>
                                    <option value="MG">MG</option>
                                    <option value="PA">PA</option>
                                    <option value="PB">PB</option>
                                    <option value="PR">PR</option>
                                    <option value="PE">PE</option>
                                    <option value="PI">PI</option>
                                    <option value="RJ">RJ</option>
                                    <option value="RN">RN</option>
                                    <option value="RS">RS</option>
                                    <option value="RO">RO</option>
                                    <option value="RR">RR</option>
                                    <option value="SC">SC</option>
                                    <option value="SP">SP</option>
                                    <option value="SE">SE</option>
                                    <option value="TO">TO</option>
                                </select>
                </div>


                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-10" style="padding: 10px;">
                        <label >Cidade </label>
                        <input type="text" name="cidade" id="cidade" placeholder=" Nome do municipio"  value="<?php
                        if (isset($data['cidade'])) {
                            echo $data['cidade'];
                        }
                        ?>" required>
                </div>

                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-10" style="padding: 10px;">
                        <label >Autor </label>
                        <input type="text" name="autor" id="autor" placeholder=" Nome do autor"  value="<?php
                        if (isset($data['autor'])) {
                            echo $data['autor'];
                        }
                        ?>" required>
                </div>

                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-8" style="padding: 10px;">
                        <label > CPF </label>
                        <input type="text" name="cpf" id="cpf" placeholder="000.000.000-00"  value="<?php
                        if (isset($data['cpf'])) {
                            echo $data['cpf'];
                        }
                        ?>" required>
                </div>

                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6" style="padding: 10px;">
                        <label >Data nascimento </label>
                        <input type="date" name="nascimentoAut" id="nascimentoAut" value="<?php
                        if (isset($data['nascimentoAut'])) {
                            echo $data['nascimentoAut'];
                        }
                        ?>" required>
                </div>

                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6" style="padding: 10px;">
                        <label > Possui </label>
                        <div class="custom-control custom-checkbox mr-sm-2">
                        <i class="fa-regular fa-user-alien"> Aliens</i>
                        <input type="checkbox" class="custom-control-input" id="lanchonete" name="lanchonete" value="1" required>
                        </div>

                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-6" style="padding: 10px;">
                        <label>Foto Ponto Turistico</label>
                        <input type="file" name="attachment" id="attachment" onchange="previewImagem()" required><br><br>

                        <div class="card">
                             <img style="max-height: 200px; " src='<?php echo "./images/pontosturisticos/$id/$image"; ?>' class="card-img-top" alt="...">
                        </div>

             			<input type="submit" value="Enviar" name="SendAddMsg" >
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

        <?php
            include_once 'rodape.php';
        ?>
    </body>
</html>
