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
            <th colspan="4">Planos</th>
        </tr>
        <tr>
            <td></td>
            <td>Semente</td>
            <td>Broto</td>
            <td>Árvore</td>
        </tr>
        <tr>
            <td>Taxa: 20% das vendas</td>
            <td>Taxa: 15% das vendas</td>
            <td>Taxa: 10% das vendas</td>
        </tr>
        <tr>
            <td>Prazo de recebimento: 15 dias</td>
            <td>Prazo de recebimento: 10 dias</td>
            <td>Prazo de recebimento: 7 dias</td>
        </tr>
        <tr>
            <td>Mínimo de venda mensal</td>
            <td>R$ 0,00</td>
            <td>R$ 1.000,00</td>
            <td>R$ 0,00</td>
        </tr>
    </table>

                <div class="card">


                    <div class="pacotes">
                        <div class="card">
                            <h3>Plano 1 Mês</h3>
                            <p class="total">R$ 29,00</p>
                            <p>R$ 29,00 / mês</p>
                            <button>Selecionar</button>
                        </div>
                        <div class="card">
                            <h3>Plano 3 Meses</h3>
                            <p class="total">R$ 59,00</p>
                            <p>R$ 19,67 / mês</p>
                            <button>Selecionar</button>
                        </div>
                        <div class="card">
                            <h3>Plano 1 Mês</h3>
                            <p class="total">R$ 29,00</p>
                            <p>R$ 29,00 / mês</p>
                            <button>Selecionar</button>
                        </div>
                        <div class="card">
                            <h3>Plano 3 Meses</h3>
                            <p class="total">R$ 59,00</p>
                            <p>R$ 19,67 / mês</p>
                            <button>Selecionar</button>
                        </div>
                        <div class="card">
                            <h3>Plano 6 Meses</h3>
                            <p class="total">R$ 99,00</p>
                            <p>R$ 16,50 / mês</p>
                            <button>Selecionar</button>
                        </div>
                        <div class="card">
                            <h3>Plano 1 Ano</h3>
                            <p class="total">R$ 149,00</p>
                            <p>R$ 12,42 / mês</p>
                            <button>Selecionar</button>
                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>