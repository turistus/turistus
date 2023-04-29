<?php
session_start();
define('ACCESS', true);
include_once '../connection.php';
//$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$id = 96;
?>
<div class="row">

    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6" >

                                <label for="total">  N° Vagas  </label>

                                    <?php
                                    $buscaValores = "SELECT valores.id AS idVal, idEvento, vagas, total FROM valores WHERE idEvento = $id ORDER BY idVal";
                                    $result = $conn->prepare($buscaValores);
                                    $result->execute();
                                    $res = $result->fetchAll(PDO::FETCH_ASSOC);

                                        foreach($res as $ln ){

                                    ?>
                                    <!-- Check box do VALOR TOTAL SELECIONADO na Compra -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6" style="padding: 10px;">
                                        <div class="col-auto my-1">
                                            <div class="custom-control custom-checkbox mr-sm-2">
                                                <input type="checkbox" class="custom-control-input" id="total" name="total" value="">
                                                <label class="custom-control-label" for="total"> <?php echo "IDV: ". $idVal ." - ". 'Vagas: ' .  $ln['vagas'] .' - Valor: '.$ln['total']?>  <i class='fa-solid fa-car'></i></label>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                        }

                                    ?>
                                    <br>
                            </div>

</div>