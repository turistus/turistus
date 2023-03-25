<?php
session_start();
ob_start();
define('ACCESS', true);

include_once './validate.php';
include '../pg/config.php';

$reference_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);



        if (!empty($reference_id)) { 
        
            include_once './function.php';
        
        // Verificar o status do pagamento, salvar no BD e recuperar o authorizationId antes de cancelar a compra
        $data_result = paymentStatus($reference_id);

        //var_dump($data_result);
        
            // Verificar o status do pagamento e salvar no BD
            paymentStatus($reference_id);

                //Mensagem de sucesso
                    $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Evento Confirmado com sucesso!</div>";
                    //Redirecionar o usuário
                    header("Location: painelGuia.php");
                } else {
                //Mensagem de erro
                    echo "PASSEI AQUI no erro Confirma evento";
                    $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Evento não confirmado!</div>";
                    //Redirecionar o usuário
                    header("Location: painelGuia.php");
                }

               // Aqui deve mandar o email e o notificaçao sela
 