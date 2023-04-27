<?php
define('ACCESS', true);
include_once '../connection.php';
session_start();
ob_start();

$idE = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (empty($idE)) {
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Evento não encontrado!</p>";
    header("Location: painelGuia.php");
    exit();
}


$query_busca_evento = "SELECT * FROM eventos WHERE id = $idE limit 1";
$evento_selecionado = $conn->prepare($query_busca_evento);
$evento_selecionado->execute();



if(($evento_selecionado) AND ($evento_selecionado->rowCount() != 0) ){
    $row_evento = $evento_selecionado->fetch(PDO::FETCH_ASSOC);
}  else {
    header("Location: ../guias/painelGuia.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="../images/icon/favicon.ico" >
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <title>Editar Eventos</title>
    </head>

<style>

#popupEditaEvento {
   position: fixed;
   top: 50%;
   left: 50%;
   transform: translate(-50%, -50%);
   background-color: #fff;
   border: 1px solid #ccc;
   padding: 20px;
   width: 600px;
   max-width: 100%;
   float: left;
}
</style>

<body>
<main class="content" style="font-family: 'Acme'; font-size: 20px;" >
    <div class="shadow-lg p-3 mb-5 bg-white rounded" style="border: solid 1px black;"  >
        <!-- PRIMEIRA LINHA -->
        <div class="row" >

            <div class="conteiner form-group col-12">

            <h3> Editar Evento </h3>

            <?php
                //RECEEBE os dados do formulario abaixo

                $dados_evento = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                //var_dump($dados_evento);
                //Verifica se foi clicado
                if(!empty($dados_evento['Editar-Evento'])){
                    $empty_input = false;
                    array_map('trim',$dados_evento);
                        if(in_array("",$dados_evento)){
                            $empty_input = true;
                            echo "Prencha todos os campos  !!!";
                        }

                    if(!$empty_input){
                       $query_update_evento = "UPDATE eventos SET
                       nome=:nome,
                       descricao=:descricao,
                       valor=:valor,
                       datah=:datah,
                       breveDescricao=:breveDescricao
                       WHERE id=:id";
                       $editandoEvento = $conn->prepare($query_update_evento);

                       $editandoEvento->bindParam(':nome', $dados_evento['nome'], PDO::PARAM_STR);
                       $editandoEvento->bindParam(':descricao', $dados_evento['descricao'], PDO::PARAM_STR);
                       $editandoEvento->bindParam(':valor', $dados_evento['valor']);
                       $editandoEvento->bindParam(':datah', $dados_evento['datah']);
                       $editandoEvento->bindParam(':breveDescricao', $dados_evento['breveDescricao']);
                       $editandoEvento->bindParam(':id', $idE, PDO::PARAM_INT);
                            if($editandoEvento->execute()){
                                    echo "ok atualizou !";
                                    header("Location: painelGuia.php");
                            }else{
                                echo "não gravoou !";
                                header("Location: painelGuia.php");
                            }


                    }
                }
            ?>
                <form id=editar-evento method="POST" action="">
                <br>
                <div class="row" style="padding: 20px;">
                    <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12">

                        <label> Nome </label>
                        <input class="form-control" type="text" name="nome" id="nome"
                        value="<?php if(isset($dados_evento['nome']))
                        { echo $dados_evento['nome'];}elseif(isset($row_evento['nome']))
                        { echo $row_evento['nome']; }?>"required> <br>
                    </div>

                    <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12">
                        <label>	Breve Descricao </label>
                        <input class="form-control" type="text" name="breveDescricao" id="breveDescricao"
                        value="<?php if(isset($dados_evento['breveDescricao']))
                        { echo $dados_evento['breveDescricao'];}elseif(isset($row_evento['breveDescricao']))
                        { echo $row_evento['breveDescricao']; }?>"required> <br>
                    </div>

                    <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12">
                        <label> Descrição </label>
                        <input class="form-control" type="text" style="height: 100px;" name="descricao" id="descricao"
                        value="<?php if(isset($dados_evento['descricao']))
                        { echo $dados_evento['descricao'];}elseif(isset($row_evento['descricao']))
                        { echo $row_evento['descricao']; }?>"required> <br>

                    </div>








                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="row" style="border: 1px solid black;">
                            <div id="formulario" class="col-xl-12 col-lg-12 col-md-12 col-sm-12" style="border: 2px solid red;">
                                    <div class="form-group" id="bloco" style="border: 1px solid green; padding:10px;">
                                            <label>  N° Vagas  </label>
                                                <!-- select AQUI   -->
                                                <select id="vagas" name="vagas[]" class="custom-select d-block w-100 " required>
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
                                                </select><br>

                                            <label> Total R$ </label>
                                                <input class="form-control" type="text"  name="total[]" id="total" value="" required>
                                            <button type="button" onclick="adicionarCampo()"> + </button>
                                    </div>
                            </div>
                        </div>
                    </div>












                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <label> Data inicial </label>
                        <input class="form-control" type="date" name="datah" id="datah"
                        value="<?php if(isset($dados_evento['datah']))
                        { echo $dados_evento['datah'];}elseif(isset($row_evento['datah']))
                        { echo $row_evento['datah']; }?>"required> <br>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <label> Data Encerramento </label>
                        <input class="form-control" type="date" name="datah" id="datah"
                        value="<?php if(isset($dados_evento['datah']))
                        { echo $dados_evento['datah'];}elseif(isset($row_evento['datah']))
                        { echo $row_evento['datah']; }?>"required> <br>
                    </div>


                    <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12">

                    <label> Ponto de encontro </label>
                    <input class="form-control" type="text" name="encontro" id="encontro"
                    value="<?php if(isset($dados_evento['encontro']))
                    { echo $dados_evento['encontro'];}elseif(isset($row_evento['encontro']))
                    { echo $row_evento['encontro']; }?>"required> <br>
                    </div>

                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6" style="padding: 10px;">

                        <div class="col-auto my-1">

                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="hotelaria" name="hotelaria" value="1">
                                <label class="custom-control-label" for="hotelaria"> Transporte <i class='fa-solid fa-hotel'></i></label>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6" style="padding: 10px;">

                        <div class="col-auto my-1">

                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="hotelaria" name="hotelaria" value="1">
                                <label class="custom-control-label" for="hotelaria"> Alimentação <i class='fa-solid fa-hotel'></i></label>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-6" style="padding: 10px;">
                        <label>Fotos do evento</label>
                        <i class="fa-regular fa-images"></i>
                        <input type="file" name="attachment" id="attachment" onchange="previewImagem()" required><br><br>

             			<input type="submit" value="Enviar" name="SendAddMsg" >
                    </div>



                </div>


                    <div class="col-12">
                        <input class="btn btn text-dark " type="submit" name="Editar-Evento" value="Salvar">
                    </div>

                    <div class="col-12">
                        <input class="btn btn text-dark " type="submit" name="deletaEvento" value="Deletar Evento">

                    </div>

                </form>
            </div>
        </div>
    </div>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="./js/custom.js"></script>
<script>


//BUSCA Imagem do evento
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

</body>
</html>