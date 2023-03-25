<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once './connection.php';
require './lib/vendor/autoload.php';

define('ACCESS', true);


?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <title>Chico Bel Seguros</title>
    </head>
    <body >




<div class="container">
  <div class="row">
    <img src="img/BGindex.jpg" class="img-fluid" alt="...">
  </div>
</div>





<div class="container border" style="font-family: 'Acme'; min-height: 200px;">
    <h1>Seguradora de veiculos - Seven Francisco Beltrão</h1>
<br>
    <div class="container">
  <div class="row">
    <div class="col align-self-start" style="border-color: solid red 1px;">
      <h3>Segurança para motorista !</h3>
    </div>
    <div class="col align-self-center">
      <h3>Confiança no socorrista !</h3>
    </div>
    <div class="col align-self-end">
      <h3>Sem burocracia !</h3>
    </div>
  </div>
</div>

</div>

<div class="container" style="font-family: 'Acme'; border-color: black; min-height: 200px;">

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
        <img src="img/explicacao.jpg" class="img-fluid" alt="...">
        </div>
<br>  
        <div class="col-lg-6 col-md-6 col-sm-12">
            <img src="img/comofunciona.jpg" class="img-fluid" alt="...">
        </div>
<br>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <img src="img/assistencia.jpg" class="img-fluid" alt="...">
        </div>
<br>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <img src="img/bonus.jpg" class="img-fluid" alt="...">
        </div>
<br>
        <div class="col-12 ">
            <img src="img/paginaMapa.jpg" class="img-fluid" alt="...">
        </div>
        <br>
      </div>
</div>

<br><br><br>




<!-- DIV CONTAINER FORMULARIO -->
        <div class="container"  style="font-family: 'Acme'; font-size: 20px;">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            
            <row>
    	
        <h2>Solicitar Orçamento</h2> 
            <p>(Falar com Gustavo)</p>
        <?php


        //aqui e onde vai SALVAR no }BANCOOOOOOO{

        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($data['SendAddMsg'])) {

            $query_msg = "INSERT INTO contacts_msgs (name, email, subject, content, placa, created) VALUES (:name, :email, :subject, :content, :placa, NOW())";
            $add_msg = $conn->prepare($query_msg);

            $add_msg->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $add_msg->bindParam(':email', $data['email'], PDO::PARAM_STR);
            $add_msg->bindParam(':subject', $data['subject'], PDO::PARAM_STR);
            $add_msg->bindParam(':content', $data['content'], PDO::PARAM_STR);
            $add_msg->bindParam(':placa', $data['placa'], PDO::PARAM_STR);

            $add_msg->execute();

 //aqui e onde vai SALVAR no }BANCOOOOOOO{ ATE AQUII


            if ($add_msg->rowCount()) {
                $mail = new PHPMailer(true);
                try {
                    $mail->CharSet = 'UTF-8';
                    $mail->isSMTP();
                    $mail->Host = 'smtp.mailtrap.io';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'f581c59f2d8c13';
                    $mail->Password = 'f44bc5d3ce676a';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 2525;

                    //Enviar e-mail para o cliente
                    $mail->setFrom('gustavo_ramos96@hotmail.com', 'Atendimento');
                    $mail->addAddress($data['email'], $data['name']);

                    $mail->isHTML(true);
                    $mail->Subject = 'Recebi a mensagem de contato';
                    $mail->Body = "Prezado(a) " . $data['name'] . "<br><br>Recebi o seu e-mail.<br>
                    Será lido o mais rápido possível.<br>
                    Em breve será respondido.<br><br>
                    Assunto: " . $data['subject'] . "<br>Conteúdo: " . $data['content'];
                    $mail->AltBody = "Prezado(a) " . $data['name'] . "\n\nRecebi o seu e-mail.\nSerá feito orçamento em breve será respondido.\n\nAssunto: " . $data['subject'] . "\nConteúdo: " . $data['content'];

                    $mail->send();
                    
                    $mail->clearAddresses();

                    //Enviar e-mail para o colaborador da empresa
                    //Primeiro de quem manda
                    $mail->setFrom('gustavo_ramos96@hotmail.com', 'OUTRO');
                    //Depois para QUEM vai mandar
                    $mail->addAddress('gustavo_ramos96@hotmail.com', 'enderecoemailsipa');


                    $mail->isHTML(true);
                    $mail->Subject = $data['subject'];
                    $mail->Body = "Nome: " . $data['name'] . "<br>E-mail: " . $data['email'] . "<br>Assunto: " . $data['subject'] . "<br>Conteúdo: " . $data['content'] . "<br>Placa: " . $data['placa'];
                    $mail->AltBody = "Nome: " . $data['name'] . "\nE-mail: " . $data['email'] . "\nAssunto: " . $data['subject'] . "\nConteúdo: " . $data['content'];

                    $mail->send();
                    unset($data);
                  //  echo "Mensagem de contato enviada com sucesso!<br>";                    
                } catch (Exception $e) {
                    //echo "Erro: Mensagem de contato não enviada com sucesso 1 !<br>" . $e;
                }
            } else {
                //echo "Erro: Mensagem de contato não enviada com sucesso! 2<br>";
            }
        }
        ?>

<row>
    <div class="col-lg-12 col-md-12 col-sm-12">
        <form name="add_msg" action="" method="POST">
            <row>
                <div class="col-lg-12 col-md-12 col-sm-12">
            <label>Nome: </label>
            <input type="text" name="name" id="name" placeholder="Nome completo" value="<?php
            if (isset($data['name'])) {
                echo $data['name'];
            }
            ?>" autofocus required><br><br>
        </div>
</row>

<row>
                <div class="col-lg-12 col-md-12 col-sm-12">
            <label>E-mail: </label>
            <input type="email" name="email" id="email" placeholder="O melhor e-mail"  value="<?php
            if (isset($data['email'])) {
                echo $data['email'];
            }
            ?>" required><br><br>
</div>
</row>

<row>
                <div class="col-lg-12 col-md-12 col-sm-12">
            <label>Assunto: </label>
            <input type="text" name="subject" id="subject" placeholder="Carro ou moto"  value="<?php
            if (isset($data['subject'])) {
                echo $data['subject'];
            }
            ?>" required><br><br>
</div>
</row>

<row>
                <div class="col-lg-12 col-md-12 col-sm-12">
            <label>Telefone: </label>
            <input type="text" name="content" id="content" placeholder="Telefone"  value="<?php
                   if (isset($data['content'])) {
                       echo $data['content'];
                   }
                   ?>" required><br><br>

</div>
</row>

<row>
                <div class="col-lg-12 col-md-12 col-sm-12">
			<label>Placa do Veiculo: </label>
            <input type="text" name="placa" id="placa" placeholder="Somente letras e números" value="<?php
            if (isset($data['placa'])) {
                echo $data['placa'];
            }
            ?>" autofocus required><br><br>

</div>
</row>
            <input type="submit" value="Enviar" name="SendAddMsg">
                    

                    </row>
                </div>
            </div>
        </form>
</div>
</row>
        <br>
        <br>

<div class="p-3 mb-2 bg-primary text-white">Seguradora Seven.</div>


    </body>
</html>
