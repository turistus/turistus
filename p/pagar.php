
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
        <title>PIX - PagSeguro</title>
    </head>
    <body>

    <div class="container">

            <div class="row">
                <div class="col-md-8 order-md-1">

                    <!-- <div class="meio-pag">A</div> -->
                    <span id="msg"></span>
                    <form name="formPagamento" action="gerarPix.php?id=<?php echo $id; ?>" id="formPagamento">
                        <span id="msg"></span>
                        <h4 class="mb-3">Dados do Comprador</h4>
                        <div class="mb-3">
                            <label>Nome</label>
                            <input type="text" name="senderName" id="senderName" placeholder="Nome completo" value="Jose Comprador" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>CPF</label>
                            <input type="text" name="senderCPF" id="senderCPF" placeholder="CPF sem traço" value="22111944785" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>E-mail</label>
                            <input type="email" name="senderEmail" id="senderEmail" placeholder="E-mail do comprador" value="<?php echo $emailSessaoAberta;?>" class="form-control" required>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label>DDD</label>
                                <input type="text" name="senderAreaCode" id="senderAreaCode" placeholder="DDD" value="11" class="form-control" required>
                            </div>
                            <div class="col-md-9 mb-3">
                                <label>Telefone</label>
                                <input type="text" name="senderPhone" id="senderPhone" placeholder="Somente número" value="56273440" class="form-control" required>
                            </div>
                        </div>

                        <h4 class="mb-3 creditCard">Endereço do titular do cartão</h4>
                        <div class="row creditCard">
                            <div class="col-md-9 mb-3 creditCard">
                                <label class="creditCard">Logradouro</label>
                                <input type="text" name="billingAddressStreet" id="billingAddressStreet" placeholder="Av. Rua" value="Av. Brig. Faria Lima" class="creditCard form-control">
                            </div>
                            <div class="col-md-3 mb-3 creditCard">
                                <label class="creditCard">Número</label>
                                <input type="text" name="billingAddressNumber" id="billingAddressNumber" placeholder="Número" value="1384" class="creditCard form-control">
                            </div>
                        </div>

                        <div class="mb-3 creditCard">
                            <label class="creditCard">Complemento</label>
                            <input type="text" name="billingAddressComplement" id="billingAddressComplement" placeholder="Complemento" value="5o andar" class="creditCard form-control">
                        </div>

                        <div class="row creditCard">
                            <div class="col-md-5 mb-3 creditCard">
                                <label class="creditCard">Bairro</label>
                                <input type="text" name="billingAddressDistrict" id="billingAddressDistrict" placeholder="Bairro" value="Jardim Paulistano" class="creditCard form-control">
                            </div>
                            <div class="col-md-5 mb-3 creditCard">
                                <label class="creditCard">Cidade</label>
                                <input type="text" name="billingAddressCity" id="billingAddressCity" placeholder="Cidade" value="Sao Paulo" class="creditCard form-control">
                            </div>
                            <div class="col-md-2 mb-3 creditCard">
                                <label class="creditCard">Estado</label>
                                <select name="billingAddressState" class="custom-select d-block w-100 creditCard" id="billingAddressState">
                                    <option value="">Selecione</option>
                                    <option value="AC">AC</option>
                                    <option value="AL">AL</option>
                                    <option value="AP">AP</option>
                                    <option value="AM">AM</option>
                                    <option value="BA">BA</option>
                                    <option value="CE">CE</option>
                                    <option value="DF">DF</option>
                                    <option value="ES">ES</option>
                                    <option value="GO">GO</option>
                                    <option value="MA">MA</option>
                                    <option value="MT">MT</option>
                                    <option value="MS">MS</option>
                                    <option value="MG">MG</option>
                                    <option value="PA">PA</option>
                                    <option value="PB">PB</option>
                                    <option value="PR">PR</option>
                                    <option value="PE">PE</option>
                                    <option value="PI">PI</option>
                                    <option value="RJ">RJ</option>
                                    <option value="RN">RN</option>
                                    <option value="RS">RS</option>
                                    <option value="RO">RO</option>
                                    <option value="RR">RR</option>
                                    <option value="SC">SC</option>
                                    <option value="SP">SP</option>
                                    <option value="SE">SE</option>
                                    <option value="TO">TO</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="creditCard">CEP</label>
                            <input type="text" name="billingAddressPostalCode" class="form-control creditCard" id="billingAddressPostalCode" placeholder="CEP sem traço" value="01452002">
                        </div>

                        <input type="hidden" name="reference" id="reference" value="<?php echo $idEvento; ?>">
                        <input type="hidden" name="amount" id="amount" value="<?php echo $total_venda; ?>">

                            <!-- BOTAO ENVIAR PagSeguro -->
                        <button type="submit" name="BtnPagSeguro" class="btn btn-primary" value="Enviar">Gerar Pix</button>
                        <input id="BotaoPagamento" type="image" src="https://stc.pagseguro.uol.com.br/public/img/botoes/pagamentos/209x48-pagar-azul-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />

                    </form>
                </div>
            </div>
        </div>


        <?php
        include_once '../rodape.php';
        ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    </body>
</html>