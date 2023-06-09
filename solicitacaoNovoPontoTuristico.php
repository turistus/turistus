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
        <link rel="shortcut icon" type="imagex/png" href="../images/logooriginal.png">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.6/jquery.inputmask.min.js"></script>



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

                        <h2 style="background: url(../images/bussola.jpg); padding:15px; ">Novo ponto turístico</h2>
        </div>
                        <?php
                        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                            try {
                		        if (!empty($data['SendAddMsg'])) {
                		            $attachment = $_FILES['attachment'];
                		            $query_msg = "INSERT INTO pontosturisticos (name, descricao, price, image, created, idGuia, cidade, uf, autor, cpf, nascimentoAut, lanchonete, camping, hotelaria, sanitarios, risco, acessib, liberado) VALUES (:name, :descricao, 13, :image, NOW(), 1, :cidade, :uf, :autor, :cpf, :nascimentoAut, :lanchonete, :camping, :hotelaria, :sanitarios, :risco, :acessib, 0)";
                		            $add_msg = $conn->prepare($query_msg);
                		            $add_msg->bindParam(':name', $data['name'], PDO::PARAM_STR);
                		            $add_msg->bindParam(':descricao', $data['descricao'], PDO::PARAM_STR);
                		            $add_msg->bindParam(':image', $attachment['name'], PDO::PARAM_STR);
                                    $add_msg->bindParam(':cidade', $data['cidade'], PDO::PARAM_STR);
                                    $add_msg->bindParam(':uf', $data['uf'], PDO::PARAM_STR);
                                    $add_msg->bindParam(':autor', $data['autor'], PDO::PARAM_STR);
                                    $add_msg->bindParam(':cpf', $data['cpf'], PDO::PARAM_STR);
                                    $add_msg->bindParam(':nascimentoAut', $data['nascimentoAut'], PDO::PARAM_STR);
                                    $add_msg->bindParam(':lanchonete', $data['lanchonete']);
                                    $add_msg->bindParam(':camping', $data['camping']);
                                    $add_msg->bindParam(':hotelaria', $data['hotelaria']);
                                    $add_msg->bindParam(':sanitarios', $data['sanitarios']);
                                    $add_msg->bindParam(':risco', $data['risco']);
                                    $add_msg->bindParam(':acessib', $data['acessib']);
                		            $add_msg->execute();
                		            unset($data);
                                    if ((isset($attachment['name'])) AND (!empty($attachment['name']))) {
                                        $last_id = $conn->lastInsertId();

                                        //Diretório onde o arquivo será salvo
                                        $directory = 'images/pontosturisticos/' . $last_id . "/";

                                        //Criar o diretório
                                        mkdir($directory, 0755);

                                        //Upload do arquivo
                                        $file = $attachment['name'];
                                        move_uploaded_file($attachment['tmp_name'], $directory . $file);
                                    }
                                echo "Solicitação Enviada !";
                          }
                         } catch (Exception $e) {
                                    echo "Erro: Mensagem de contato não enviada com sucesso !<br>" . $e;
                                }
                        ?>

            <!-- SEGUNDA (ROW) LINHA -->
            <div class="row" style=" padding: 10px; margin: 20px;">
            <form name="add_msg" action="" method="POST" enctype="multipart/form-data">
            <!--         XS <576px SM > 576  MD > 768  LG > 992  XL > 1200-->
                <div class="col-8 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 10px;">

                        <label> Titulo </label>
                        <input type="text" name="name" id="name" placeholder=" Nome turistico " maxlength="50" value="<?php
                        if (isset($data['name'])) {
                            echo $data['name'];
                        }
                        ?>" autofocus required>
                </div>

                <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10" style="padding: 10px; max-width: 500px;">
                        <label> Descrição </label>

                        <textarea class="form-control" rows="3" cols="15" name="descricao" id="descricao"  value="<?php
                        if (isset($data['descricao'])) {
                            echo $data['descricao'];
                        }
                        ?>" required> Descreva toda a história do ponto turístico. </textarea>

                </div>
                <br>

                <div class=" col-7 col-sm-4 col-md-3 col-lg-6 col-xl-4 " style="padding: 10px; ">

                    <label class="uf"> Estado UF </label>
                                <select name="uf" class="custom-select uf" id="uf" required>
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


                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-8 " style="padding: 10px;">
                        <label > Cidade </label><br>
                        <input type="text" name="cidade" id="cidade" placeholder=" Nome do municipio"  value="<?php
                        if (isset($data['cidade'])) {
                            echo $data['cidade'];
                        }
                        ?>" required>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6" style="padding: 10px;">
                        <label > Autor </label><br>
                        <input type="text" name="autor" id="autor" placeholder=" Nome do autor"  value="<?php
                        if (isset($data['autor'])) {
                            echo $data['autor'];
                        }
                        ?>" required>
                </div>

                <div class="col-xl-8 col-lg-6 col-md-6 col-sm-8 " style="padding: 10px; ">
                        <label > CPF </label><br>
                        <input class="cpf-input" type="text" name="cpf" id="cpf" placeholder=" 000.000.000-00 " value="<?php
                        if (isset($data['cpf'])) {
                            echo $data['cpf'];
                        }
                        ?>" required>
                </div>
                <hr>

                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6" style="padding: 10px; ">
                        <label > Data nascimento </label><br>
                        <input type="date" name="nascimentoAut" id="nascimentoAut" value="<?php
                        if (isset($data['nascimentoAut'])) {
                            echo $data['nascimentoAut'];
                        }
                        ?>" required>
                </div>
<br>
                        <div class="col-8 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 10px; ">
                            <label> Local possui </label>
                        </div>
                    <div class="row">

                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6" style="padding: 10px; ">

                                <div class="col-auto my-1">

                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input type="checkbox" class="custom-control-input" id="lanchonete" name="lanchonete" value="1">
                                        <label class="custom-control-label" for="lanchonete"> Praça de Alimentação <i class='fa-solid fa-burger'></i></label>
                                    </div>
                                </div>

                        </div>
                        <br>
                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6" style="padding: 10px; ">

                                <div class="col-auto my-1">

                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input type="checkbox" class="custom-control-input" id="camping" name="camping" value="1">
                                        <label class="custom-control-label" for="camping"> Camping <i class='fa-solid fa-campground'></i></label>
                                    </div>
                                </div>

                        </div>

                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6" style="padding: 10px;">

                                <div class="col-auto my-1">

                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input type="checkbox" class="custom-control-input" id="hotelaria" name="hotelaria" value="1">
                                        <label class="custom-control-label" for="hotelaria"> Hospedagens <i class='fa-solid fa-hotel'></i></label>
                                    </div>
                                </div>

                        </div>

                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6" style="padding: 10px;">

                                <div class="col-auto my-1">

                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input type="checkbox" class="custom-control-input" id="sanitarios" name="sanitarios" value="1">
                                        <label class="custom-control-label" for="sanitarios"> Saneamento B. <i class='fa-solid fa-toilet-paper'></i></label>
                                    </div>
                                </div>

                        </div>

                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6" style="padding: 10px;">

                                <div class="col-auto my-1">

                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input type="checkbox" class="custom-control-input" id="risco" name="risco" value="1">
                                        <label class="custom-control-label" for="risco"> Perigo <i class='fa-solid fa-triangle-exclamation'></i></label>
                                    </div>
                                </div>

                        </div>

                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6" style="padding: 10px;">

                                <div class="col-auto my-1">

                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input type="checkbox" class="custom-control-input" id="acessib" name="acessib" value="1">
                                        <label class="custom-control-label" for="acessib"> Acessibilidade <i class='fas fa-wheelchair'></i></label>
                                    </div>
                                </div>

                        </div>
                    </div><!-- FIM da ROW dos Check BOX-->
                <hr>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 10px; ">
                        <label for="attachment" class="btn" style="border: 1px solid black; ">Foto Ponto Turístico</label>
                        <i class="fa-regular fa-images"></i>
                        <input type="file" name="attachment" id="attachment" onchange="previewImagem()" style="display: none;" required><br><br>

             			<input type="submit" value="Solicitar" name="SendAddMsg" >
                </div>


                    </form>

                    <!-- Para buscar a foto na pasta-->
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

                    <script>
                       // Função para aplicar a máscara de CPF
                        function maskCpfInput(input) {
                            var value = input.value.replace(/\D/g, '').substring(0, 11);
                            value = value.replace(/(\d{3})(\d)/, '$1.$2');
                            value = value.replace(/(\d{3})(\d)/, '$1.$2');
                            value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                            input.value = value;
                        }

                        // Obter o campo de entrada do CPF
                        var cpfInput = document.getElementById('cpf');

                        // Adicionar um ouvinte de evento 'input' ao campo de entrada
                        cpfInput.addEventListener('input', function() {
                        maskCpfInput(cpfInput);
                        });





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
    </div><!-- Fim da Shadown-->
</main>

        <?php
            include_once 'rodape.php';
        ?>
    </body>
</html>
