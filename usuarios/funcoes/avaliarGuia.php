<?php
session_start();
define('ACCESS', true);
include_once '../../connection.php';

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="../../images/logooriginal.ico" >
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" ></script>

        <title>Avaliação de Guia</title>
    </head>

    <body>

        <?php
            include_once '../../pg/menu.php';
        ?>
        <h1>Comente como foi</h1>

        <div class="content" style="margin:auto; padding: 20px;">
            <div class="row" style="border:1px solid black;">

                <br>
                <div class="col-xl-6 col-lg-8 col-md-8 col-sm-12" style="margin:auto; padding: 20px;">
                <h4> Avaliar Evento  </h4>
                    <form method="POST" action="avaliarGuia.php?id=<?php echo $id; ?>">
                        <div class="col-xl-12 col-lg-8 col-md-12 col-sm-12" >
                            <br>
                            <label>Comentário</label>


                                <textarea id="comentario" name="comentario" rows="5" cols="33" class="form-control">

                                </textarea>
                        </div>
                        <br>
                        <div class="col-xl-6 col-lg-6 col-md-4 col-sm-4">
                            <label> De 1 a 5 <span> ★★★★★ </span> </label>
                                    <select name="valorVoto" class="custom-select d-block w-100 " id="valorVoto">
                                        <option value="">Selecione</option>
                                        <option value="20"> 1 ★ - Não gostei</option>
                                        <option value="40"> 2 ★ - Ruim</option>
                                        <option value="60"> 3 ★ - Razoavel</option>
                                        <option value="80"> 4 ★ - Bom</option>
                                        <option value="100"> 5 ★ - Muito bom ( Recomendo )</option>
                                    </select>
                        </div>
                        <br>
                        <!-- BOTAO ENVIAR PICPAY-->
                        <button type="submit" name="BtnAvaliar" class="btn btn-primary" value="Enviar">Enviar Comentario</button>

                    </form>
                    <br>
            </div>
            </div>
        </div>

<!-- Agora devo fazer o PHP com Query de INSERT na CLASSIFICAÇÃO para calcular a media, para atualizar na Eventos -->

        <?php
        $logadoUser = $_SESSION['user_email'];
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($data['BtnAvaliar'])) {
                $query_votar_classi = "INSERT INTO classificacao (idEvento, idGuia, valorVoto, comentario, idUsuario)
                                            VALUES (00, :idGuia, :valorVoto, :comentario, :idUsuario) ";
                $add_Classi = $conn->prepare($query_votar_classi);
                //$add_Classi->bindParam(":idEvento", $id);
                $add_Classi->bindParam(":idUsuario", $logadoUser);
                $add_Classi->bindParam(":idGuia", $id);
                $add_Classi->bindParam(":valorVoto", $data['valorVoto']);
                $add_Classi->bindParam(":comentario", $data['comentario']);
                $add_Classi->execute();

                    $queryAltPontoGuia = "UPDATE servicos
                            SET pontos = (
                                SELECT SUM(valorVoto) / Count($id)
                                     FROM classificacao WHERE idGuia = $id)
                                WHERE servicos.id = $id ";
                $addVoto = $conn->prepare($queryAltPontoGuia);
                $addVoto->execute();

                echo " Obrigado por Avaliar !!";


            }else{
                echo " Precisamos que você avalie o evento !";
            }

        ?>

    </body>
</html>