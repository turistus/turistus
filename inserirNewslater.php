<?php
//Sera feito um insert na tabela de newslatter só o email.

define('ACCESS', true);

include("./connection.php");
$formRodape = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$email = $formRodape['email'];

if ($formRodape['email'] != true){

    echo "não foi possivel inscriver !";

    }else{
    $newslater = "INSERT INTO newslatter (email) VALUES (:email)";
    $add_pagSeg = $conn->prepare($newslater);
    $add_pagSeg->bindParam(":email", $email, PDO::PARAM_STR);


    $add_pagSeg->execute();
    // FIM DA INSERT EM PAYMENTS PICPAY
    echo "Inscrito !";
 }


?>