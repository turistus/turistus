<?php
if(!defined('ACCESS')){
    header("Location: /");
    die("Erro: Pagina nao encontrada!<br>");
}

function paymentStatus($reference_id) {

    //Conexão com banco dados
    include '../connection.php';
    $result = $reference_id;

    // Ler o conteúdo da resposta
    $data_result = json_decode($result);

    // Imprimir o conteúdo da resposta
    //var_dump($data_result);

    $query_pay_status = "SELECT id, confirmado FROM payments_picpays WHERE id = $reference_id LIMIT 1";
    $result_pay_status = $conn->prepare($query_pay_status);
    $result_pay_status->execute();

    if ($result_pay_status->rowCount() != 0) {
        $row_pay_status = $result_pay_status->fetch(PDO::FETCH_ASSOC);
        //var_dump($row_pay_status);
        extract($row_pay_status);
        //var_dump($status_id);

        $query_pay_status = "SELECT id, confirmado FROM payments_picpays WHERE id = $reference_id LIMIT 1 ";
        $result_pay_status = $conn->prepare($query_pay_status);
        $result_pay_status->execute();

                if ($result_pay_status->rowCount() != 0) {
                    $row_pay_status = $result_pay_status->fetch(PDO::FETCH_ASSOC);
                    //var_dump($row_pay_status);
                    extract($row_pay_status);


                //Editar a compra informado o status da compra no PicPay
                $query_up_pay_picpay = "UPDATE payments_picpays SET confirmado = 1, modified = NOW() WHERE id = $reference_id LIMIT 1";
                $up_pay_picpay = $conn->prepare($query_up_pay_picpay);
                $up_pay_picpay->execute();
                }


    }
    return $data_result;
}