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

<body>
<main class="content" style="font-family: 'Acme'; font-size: 20px;" >
    <div class="shadow-lg p-3 mb-5 bg-white rounded" style="border: solid 1px black;"  >
        <!-- PRIMEIRA LINHA -->
        <div class="row" >

            <div class="container form-group col-12">

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
                        foreach($dados_evento['vagas'] as $chave => $valor){

                       $query_update_evento = "UPDATE eventos SET
                       nome=:nome,
                       breveDescricao=:breveDescricao
                       descricao=:descricao,
                       datai=:datai,
                       dataf=:dataf,
                       encontro=:encontro,
                       transporte=:transporte,
                       alimentacao=:alimentacao,
                       foto=:foto,
                       vagas=:vagas,
                       valor=:valor,
                       dataUp=:dataUp
                       WHERE id=:id";
                       $editandoEvento = $conn->prepare($query_update_evento);

                       $editandoEvento->bindParam(':nome', $dados_evento['nome'], PDO::PARAM_STR);
                       $editandoEvento->bindParam(':breveDescricao', $dados_evento['breveDescricao']);
                       $editandoEvento->bindParam(':descricao', $dados_evento['descricao'], PDO::PARAM_STR);
                       $editandoEvento->bindParam(':datai', $dados_evento['datai']);
                       $editandoEvento->bindParam(':dataf', $dados_evento['dataf']);
                       $editandoEvento->bindParam(':encontro', $dados_evento['encontro']);
                       $editandoEvento->bindParam(':transporte', $dados_evento['transporte']);
                       $editandoEvento->bindParam(':alimentacao', $dados_evento['alimentacao']);
                       $editandoEvento->bindParam(':foto', $dados_evento['foto']);
                       $editandoEvento->bindParam(':vagas', $valor);
                       $editandoEvento->bindParam(':valor', $dados_evento['valor'][$chave]);
                       $editandoEvento->bindParam(':dataUp', $dados_evento['dataUp']);
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
                        <label>	Breve descrição </label>
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

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <label> Data inicial </label>
                        <input class="form-control" type="date" name="datai" id="datai"
                        value="<?php if(isset($dados_evento['datai']))
                        { echo $dados_evento['datai'];}elseif(isset($row_evento['datai']))
                        { echo $row_evento['datai']; }?>"required> <br>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <label> Data final </label>
                        <input class="form-control" type="date" name="dataf" id="dataf"
                        value="<?php if(isset($dados_evento['dataf']))
                        { echo $dados_evento['dataf'];}elseif(isset($row_evento['dataf']))
                        { echo $row_evento['dataf']; }?>"required> <br>
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
                                <input type="checkbox" class="custom-control-input" id="transporte" name="transporte" value="1">
                                <label class="custom-control-label" for="transporte"> Transporte <i class='fa-solid fa-car'></i></label>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6" style="padding: 10px;">

                        <div class="col-auto my-1">

                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="alimentacao" name="alimentacao" value="1">
                                <label class="custom-control-label" for="alimentacao"> Alimentação <i class='fa-solid fa-eat'></i></label>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-6" style="padding: 10px;">
                        <label>Fotos do evento</label>
                        <i class="fa-regular fa-images"></i>
                        <input type="file" name="attachment" id="attachment" onchange="previewImagem()" required><br><br>

                    </div>


                        <div class="row col-12" >
                            <div id="formulario" class="col-xl-12 col-lg-12 col-md-12 col-sm-12" >
                                <div class="form-group form-inline" id="bloco" style="border: 1px solid green; padding:15px;">

                                            <label>  N° Vagas  </label>
                                                <!-- select AQUI   -->
                                                <select id="vagas" name="vagas[]" class="custom-select col-3" required>
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
                                            <label> Total R$ </label>
                                                <input class="form-control col-3" type="text"  name="total[]" id="total" value="" required>

                                            <button type="button" onclick="adicionarCampo()"> + </button>
                                </div>
                            </div>

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

<script src="./js/custom.js"></script>
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

</body>
</html>