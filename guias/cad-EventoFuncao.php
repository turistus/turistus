<?php
include_once '../connection.php';


?>
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

            <!-- Titulo-->
        <div class="row" style="padding-left: 50px;  margin-bottom: 50px; background: url(../images/bussola.jpg) repeat-x top center;">
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
<div class="col-10" style=" margin: auto; padding-top: 20px; ">
    <div class="col-md-8 order-md-1">
    <!-- Aqui abaixo tenho um exemplo de como usar a
    função cadastrar Turista processado em outra pagina php -->
            <form method="POST" action="processa-cad-evento.php">
                    
                        <div class="row" >
                        <!-- as melhores colunas organizadas da maior para menor -->    
                                    <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12 mb-12">
                                    
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-mb-12">
                                            <p>Nome do turismo</p>
                                            <input type="text" class="form-control" id="nome" placeholder="" name="nome"
                                            value="<?php
                                                if (isset($dados['nome'])) {
                                                    echo $dados['nome'];
                                                }?>" required>
                                        </div>

                                        <div class="col-xl-6 col-lg-6  col-md-9 col-sm-7 col-mb-3">
                                            <p >Data Abertura </p>
                                            <input type="date" class="form-control" id="datah" placeholder="" name="datah" value="<?php
                                                if (isset($dados['datah'])) {
                                                    echo $dados['datah'];
                                                }?>">
                                            
                                            
                                        </div>
                                        <div class="col-xl-12 col-lg-12  col-md-12 col-sm-12 col-mb-12">
                                            <p >Breve Descrição</p>
                                            <input style=" height:100px;" type="textarea" class="form-control" id="breveDescricao" placeholder="maximo 80 caracteres" name="breveDescricao" value="<?php
                                                if (isset($dados['breveDescricao'])) {
                                                    echo $dados['breveDescricao'];
                                                }?>" required>
                                            
                                        </div>
                                        <div class="col-xl-12 col-lg-12  col-md-12 col-sm-12 col-mb-12">
                                            <p >Descrição</p>
                                            <input style=" height:100px;" type="textarea" class="form-control" id="descricao" placeholder="maximo 200 caracteres" name="descricao" value="<?php
                                                if (isset($dados['descricao'])) {
                                                    echo $dados['descricao'];
                                                }?>" required>
                                            
                                        </div>
                                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-mb-12">
                                            <p >Valor</p>
                                            <input type="text" class="form-control" id="valor" placeholder="R$" name="valor" 
                                            value="<?php
                                                if (isset($dados['valor'])) {
                                                    echo $dados['valor'];
                                                }?>" required>
                                            
                                        </div>
                                    </div>
                        </div><!-- Fim da ROW -->
                        
                <!-- SEGUNDA PARTE DO FORMULARIO DE CADASTRO DE EVENTO -->


                            
                <div class="col-md-6 mt-3">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-mb-12">

                                    <h5 >Ponto Turistico</h5> 
                                        <select class="form-select" name="idPt" style="border: 1px solid blue; border-radius: 10;" > <!-- importante esse NAME aqui pelo oque entendi levou o dado par o form idPT -->
                                            <option>Selecione</option>
                                            
                                                    <?php
                                                    
                                                        $result = $conn->prepare("SELECT * FROM pontosturisticos ORDER BY name ASC;");
                                                        $result->execute();
                                                        $res = $result->fetchAll(PDO::FETCH_ASSOC);
                                                    ?>
                                                    <?php   
                                                        foreach($res as $ln ){
                                                    ?>
                                                        <option value="<?php echo $ln['id'];?>" name="idPt" id="idPt" >
                                                    <?php 
                                                        // echo $ln['id'].' - <br/>';
                                                        echo $ln['name'].' - '.$ln['uf']; 
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
                                <input type="submit" class="btn btn-success" style="  width: 150px; margin-right: 10px;" value="Cadastrar">
                                <input type="reset" class="btn btn-info" style="  width: 100px;" name="bt_limpar" value="Novo">
                                    <div class="col-4">
                                        
                                    </div>

                                    <div class="col-6">           
                                        
                                    </div>
                                </div>
            </form> 
                                                
            
            

                </div>
            </div>
        </div><!-- Fim da linha ROW GERAL -->
    </div><!-- Fim da class Redonda -->
</main>
 
	</body>
</html>

