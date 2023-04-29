<?php
session_start();
define('ACCESS', true);
include_once '../connection.php';
//$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$id = 96;
?>


<div class="col-10 " >

                                <label for="vagas">  N° Vagas  </label>

                                    <?php
                                    $buscaValores = "SELECT valores.id AS idVal, idEvento, vagas, total FROM valores WHERE idEvento = $id ORDER BY idVal";
                                    $result = $conn->prepare($buscaValores);
                                    $result->execute();
                                    $res = $result->fetchAll(PDO::FETCH_ASSOC);

                                        foreach($res as $ln ){

                                    ?>
                                    <!-- Check box do VALOR TOTAL SELECIONADO na Compra -->
                                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6" style="padding: 10px; border: 1px solid black;">
                                        <div class="col-auto my-1">
                                            <div class="custom-control custom-checkbox mr-sm-2">
                                                <input type="checkbox" class="custom-control-input" id="idVal" name="idVal" value="">
                                                <label class="custom-control-label" for="vagas"> <?php echo $ln['vagas']['0'] .' Pessoas - Valor '.$ln['total']['0'] ?>  <i class='fa-solid fa-car'></i></label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6" style="padding: 10px;  border: 1px solid black;">
                                        <div class="col-auto my-1">
                                            <div class="custom-control custom-checkbox mr-sm-2">
                                                <input type="checkbox" class="custom-control-input" id="vagas" name="vagas" value="">
                                                <label class="custom-control-label" for="vagas"> <?php echo $ln['vagas']['1'] .' Pessoas - Valor '.$ln['total']['1'] ?>  <i class='fa-solid fa-car'></i></label>
                                            </div>
                                        </div>
                                    </div>
                                        <hr>

                                    <?php
                                        }

                                    ?>
                                    <br>
                            </div>