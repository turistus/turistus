<?php
session_start();
include_once '../connection.php';



?>
<!DOCTYPE html>
<html lang="pt/br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Cadastro de Eventos</title>
	</head>
	<body>

    <br>
<!-- Primeira LINHA Principal CONTEINER -->
<main class="container">

    <div class="shadow-lg p-3 mb-5 bg-white rounded"  >
            <div class="row">
                <div class="col-12" style="text-align: right;" >
                    <p>*<a href=""> Ajudar ?</a></p>
                </div>
            </div>
        <div class="row">

            <!-- Titulo-->
            <div class="row" style="padding-left: 50px;  margin-bottom: 50px; background: url(../images/bussola.jpg) repeat-x; display: inline;">
                <div class="col-12">
                    <h1 style="padding-top: 10px;">Criar Evento</h1>
                </div>
            </div>


            <?php
            if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>

<br>

<!-- Div inicial abaixo do Titulo -->
<div class="col-12" style=" margin: auto; padding-top: 20px; ">
    <div class="col-md-8 order-md-1">
    <!-- Aqui abaixo tenho um exemplo de como usar a
    função cadastrar Turista processado em outra pagina php -->
            <form method="POST" action="processa-cad-evento.php" enctype="multipart/form-data" onchange="return validarFormulario()">

                <div class="row" style="padding: 20px;">
                        <!-- as melhores colunas organizadas da maior para menor -->
                    <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12 mb-12">

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 ">
                                            <label> Titulo do turismo</label>
                                            <input type="text" class="form-control" id="nome" placeholder="Nome do evento a ser divulgado" name="nome"
                                            value="<?php
                                                if (isset($dados['nome'])) {
                                                    echo $dados['nome'];
                                                }?>" required><br>
                        </div>

                        <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12">
                                            <label>	Breve descrição </label>
                                            <input class="form-control" type="textarea" maxlength="75" name="breveDescricao" placeholder="Resumo da atividade realizada" id="breveDescricao"
                                            value="<?php if(isset($dados_evento['breveDescricao']))
                                            { echo $dados_evento['breveDescricao'];}elseif(isset($row_evento['breveDescricao']))
                                            { echo $row_evento['breveDescricao']; }?>"required> <br>


                        </div>

                        <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12">
                                            <label> Descrição </label>
                                            <input class="form-control" type="text" style="height: 100px;" name="descricao" id="descricao"
                                            value="<?php if(isset($dados_evento['descricao']))
                                            { echo $dados_evento['descricao'];}elseif(isset($row_evento['descricao']))
                                            { echo $row_evento['descricao']; }?>"required>

                        <div class="text-muted" style="font-size: 0.8em;">Detalhe o evento em geral, dia que pode ser agendado, atividades presentes no evento, tempo médio de duração, dias e horarios que possam ser agendados (Quarta à Domingo das 8:00 às 14:00..) entre outras informações importantes que o turista tem o direito de saber antes de contratar seu serviços.</div>
                        </div>
                        <br>
                                                <h4>Tempo de permanência do anúncio</h4>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <label> Data inicial (Abertura) </label>
                                            <input class="form-control" type="date" name="datai" id="datai"
                                            value="<?php if(isset($dados_evento['datai']))
                                            { echo $dados_evento['datai'];}elseif(isset($row_evento['datai']))
                                            { echo $row_evento['datai']; }?>"required> <br>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <label> Data final (Fechamento) </label>
                                            <input class="form-control" type="date" name="dataf" id="dataf"
                                            value="<?php if(isset($dados_evento['dataf']))
                                            { echo $dados_evento['dataf'];}elseif(isset($row_evento['dataf']))
                                            { echo $row_evento['dataf']; }?>"required> <br>
                        </div>

                        <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12">
                                            <label> Ponto de encontro </label>
                                            <input class="form-control" type="text" name="encontro" id="encontro" placeholder="Local referência de inicio do evento "
                                            value="<?php if(isset($dados_evento['encontro']))
                                            { echo $dados_evento['encontro'];}elseif(isset($row_evento['encontro']))
                                            { echo $row_evento['encontro']; }?>" required> <br>
                        </div>

                        <div class="col-8 col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 10px; ">
                            <h4> Incluso </h4>
                        </div>

                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6" style="padding: 10px;">

                            <div class="col-auto my-1">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="transporte" name="transporte" value="1">
                                    <label class="custom-control-label" for="transporte"> Transporte <i class='fa-solid fa-car'></i></label>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6" style="padding: 10px;">
                            <div class="col-auto my-1">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="alimentacao" name="alimentacao" value="1">
                                    <label class="custom-control-label" for="alimentacao"> Alimentação <i class='fa-solid fa-burger'></i></label>
                                </div>
                            </div>
                        </div>


                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-6" style="padding: 10px; ">
                                                <h4>Selecione as imagens</h4>
                        <label for="foto" class="btn" style="border: 1px solid black; ">Fotos do evento</label>
                        <i class="fa-regular fa-images"></i>
                        <div class="text-muted" style="font-size: 0.8em;">envie no máximo 5 fotos.</div>
                        <input type="file" name="foto[]" id="foto" multiple="multiple" onchange="previewImagem()" style="display: none;" required><br>

                    </div>

                                                <h4>Determine o valor por nº vagas</h4>
                        <div class="row " >
                            <div id="formulario" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" >
                                <div class="form-group form-inline" id="bloco" style="border: 1px solid green; padding:15px;">
                                    <label>  N° Vagas  </label>
                                        <!-- select AQUI   -->
                                    <select id="vagas" name="vagas[]" class="custom-select col-12" required >
                                                        <option value="">Selecione</option>
                                                        <option value="01">01 Pessoa</option>
                                                        <option value="02">02 Pessoas</option>
                                                        <option value="03">03 Pessoas</option>
                                                        <option value="04">04 Pessoas</option>
                                                        <option value="05">05 Pessoas</option>
                                                        <option value="06">06 Pessoas</option>
                                                        <option value="07">07 Pessoas</option>
                                                        <option value="08">08 Pessoas</option>
                                                        <option value="09">09 Pessoas</option>
                                                        <option value="10">10 Pessoas</option>
                                                        <option value="11">11 Pessoas</option>
                                                        <option value="12">12 Pessoas</option>
                                                        <option value="13">13 Pessoas</option>
                                                        <option value="14">14 Pessoas</option>
                                                        <option value="15">15 Pessoas</option>
                                                        <option value="16">16 Pessoas</option>
                                                        <option value="17">17 Pessoas</option>
                                                        <option value="18">18 Pessoas</option>
                                                        <option value="19">19 Pessoas</option>
                                                        <option value="20">20 Pessoas</option>
                                    </select>
                                        <label style="margin-left: 10px;"> Total R$ </label>
                                        <input class="form-control col-12" type="text"  name="total[]" id="total" value="" required >
                                        <button style="margin-left: 10px;" type="button" onclick="adicionarCampo()"> + </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- Fim da ROW -->

                <!-- SEGUNDA PARTE DO FORMULARIO DE CADASTRO DE EVENTO -->





                <div class="col-md-12 mt-3">
                                <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 ">

                                    <h5> Vincule um Ponto Turistico ao seu evento</h5>
                                        <select onclick="searchPontosTuristicos()" type="search" class="form-select" name="idPt" style="border: 1px solid blue; border-radius: 10; width: 150px;" > <!-- importante esse NAME aqui pelo oque entendi levou o dado par o form idPT -->
                                            <option>Selecione</option>

                                                    <?php
                                                    if(!empty($_GET['search'])){
                                                        // echo "contem algo, no pesquisar";
                                                        $palavra = $_GET['search'];
                                                        $query = "SELECT id, name, image, cidade FROM pontosturisticos WHERE pontosturisticos.name LIKE '%$palavra%' OR pontosturisticos.cidade LIKE '%$palavra%' ";
                                                        $result = $conn->prepare($query);

                                                    }else{
                                                        // echo "nao buscou por nada ainda";
                                                        $result = $conn->prepare("SELECT *, pontosturisticos.id AS id, pontosturisticos.uf AS Estado FROM pontosturisticos ORDER BY name ASC;");

                                                        }

                                                        $result->execute();
                                                        $res = $result->fetchAll(PDO::FETCH_ASSOC);


                                                        foreach($res as $ln ){
                                                    ?>

                                                        <option value="<?php echo $ln['id'];?>" name="idPt" id="idPt" >
                                                    <?php

                                                        echo $ln['name'];
                                                    }
                                                    ?>
                                                        </option>
                                        </select>
                                    <!-- Aqui Busca CERTINHO o nome e o ID do ponto turistico para o EVENTO ser cadastrado -->


                                </div>
                                     <!-- ID do PROPRIO GUIA ao cadastrar EVENTO  -->
                                        <div class="col-md-6 mb-3">
                                            <label hidden >Seu ID GUIA</label>
                                            <input hidden type="text" class="form-control" id="idGuia" placeholder="" name="idGuia"
                                            value="<?php
                                                if (isset($Uid)) {
                                                    echo $Uid;
                                                }?>" >

                                        </div>

                        <!-- BOTAO CADASTRAR  -->

                                <div class="row" style="padding-left: 20px; margin-top:20px;">
                                <input type="submit" class="btn btn-success" style="  width: 150px; margin-right: 10px;" id="Postar" name="Postar" value="Postar">

                                    <div class="col-4">

                                    </div>

                                    <div class="col-6">

                                    </div>
                                </div>
                                <div id="mensagemErro" style="color: red;"></div>
            </form>


            <!-- Para buscar a foto na pasta-->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="./js/custom.js"></script>
                    <script>
                        function previewImagem(){
                            var imagem = document.querySelector('input[name=foto]').files[0];
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

                        function validarFormulario() {
                            var campo = document.getElementById('idPt');
                            var mensagemErro = document.getElementById('mensagemErro');
                            if (campo.value === '') {
                            mensagemErro.textContent = 'Por favor, selecione uma opção!';
                            return false; // impede o envio do formulário
                            }
                            mensagemErro.textContent = ''; // limpa a mensagem de erro
                            return true; // permite o envio do formulário
                        }

                        var search = document.getElementById('idPt');
                        search.addEventListener("keydown", function(event){
                            if(event.key === "Enter"){
                                searchPontosTuristicos();
                            }
                        });

                        function searchPontosTuristicos(){
                            var x = document.getElementById("idPt");
                            x.search.value;
                            //window.location = 'cad-EventoFuncao.php?search='+search.value;
                        }
                    </script>

                </div>
            </div>
        </div><!-- Fim da linha ROW GERAL -->
    </div><!-- Fim da class Redonda -->
</main>

	</body>
</html>


