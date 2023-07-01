<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="../../images/logooriginal.png" >
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <title>Planos</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
            font-size: 18px;
        }

        .destaque {
            font-weight: bold;
        }

        .pacotes {
            margin-top: 20px;
            text-align: center;
        }

        .card {
            display: inline-block;
            width: 200px;
            border: 1px solid #ddd;
            padding: 20px;
            margin: 10px;
            text-align: center;
        }

        .card h3 {
            margin: 0;
        }

        .card p {
            margin-bottom: 10px;
        }

        .card .total {
            font-weight: bold;
        }

        .card button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin-top: 10px;
            cursor: pointer;
        }
    </style>
</head>

    <body>
        <?php
            include_once("../../guias/menu.php")
        ?>
        <div class="conteiner">
            <table>
                <tr>
                    <th colspan="5" style="text-align: center;">Upgrade de Planos</th>
                </tr>

                <tr>
                <td><b>Plano</b></td>
                    <td>Pedra</td>
                    <td>Semente</td>
                    <td>Broto</td>
                    <td>Árvore</td>
                </tr>
                <tr>
                <td><b>Taxa</b></td>
                    <td> 22% das vendas</td>
                    <td> 20% das vendas</td>
                    <td> 15% das vendas</td>
                    <td> 10% das vendas</td>
                </tr>
                <tr>
                <td><b>Prazo recebimento</b></td>
                    <td> 20 dias</td>
                    <td> 15 dias</td>
                    <td> 10 dias</td>
                    <td> 7 dias</td>
                </tr>
                <tr>
                <td><b>Minimo vendas Mensal</b></td>
                    <td>R$ 0,00</td>
                    <td>R$ 0,00</td>
                    <td>R$ 1.000,00</td>
                    <td>R$ 10.000,00</td>
                </tr>
        <!-- Linha Mensal -->
                <tr>
                    <td>
                        <b>
                            Mensal
                        </b>
                    </td>
                    <td>

                    </td>

                    <td>
                        <div class="card">
                            <h3>1 Mês</h3>
                            <p class="total">R$ 29,00</p>
                            <p>R$ 29,00 / mês</p>
                            <button>Selecionar</button>
                        </div>
                    </td>

                    <td>
                        <div class="card">
                            <h3>1 Mês</h3>
                            <p class="total">R$ 49,00</p>
                            <p>R$ 49,00 / mês</p>
                            <button>Selecionar</button>
                        </div>
                    </td>

                    <td>
                        <div class="card">
                            <h3>1 Mês</h3>
                            <p class="total">R$ 59,00</p>
                            <p>R$ 59,00 / mês</p>
                            <button>Selecionar</button>
                        </div>
                    </td>
                </tr>

                <!-- Linha ¨Semestral -->
                <tr>
                    <td>
                        <b>
                            Semestral
                        </b>
                    </td>
                    <td>

                    </td>

                    <td>
                        <div class="card">
                            <h3>6 Mês</h3>
                            <p class="total">R$ 59,00</p>

                            <button>Selecionar</button>
                        </div>
                    </td>

                    <td>
                        <div class="card">
                            <h3>6 Mês</h3>
                            <p class="total">R$ 139,00</p>

                            <button>Selecionar</button>
                        </div>
                    </td>

                    <td>
                        <div class="card">
                            <h3>6 Mês</h3>
                            <p class="total">R$ 229,00</p>

                            <button>Selecionar</button>
                        </div>
                    </td>
                </tr>

                <!-- Linha Anual -->
                <tr>
                    <td>
                        <b>
                            Anual
                        </b>
                    </td>
                    <td>

                    </td>

                    <td>
                        <div class="card">
                            <h3>1 Ano</h3>
                            <p class="total">R$ 149,00</p>

                            <button>Selecionar</button>
                        </div>
                    </td>

                    <td>
                        <div class="card">
                            <h3>1 Ano</h3>
                            <p class="total">R$ 249,00</p>

                            <button>Selecionar</button>
                        </div>
                    </td>

                    <td>
                        <div class="card">
                            <h3>1 Ano</h3>
                            <p class="total">R$ 329,00</p>

                            <button>Selecionar</button>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <?php
            include_once("../../rodape.php")
        ?>
    </body>
</html>