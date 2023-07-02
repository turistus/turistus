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

        .conteiner{

            margin: auto;
            padding: 15px;
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
                    <th colspan="5" style="text-align: center;"> Planos</th>
                </tr>

                <tr>
                <td><b>Plano</b></td>
                    <td></td>
                    <td>Comum</td>
                    <td>Completo</td>
                    <td>Vip</td>
                </tr>
                <tr>
                <td><b>Taxa</b></td>
                    <td> </td>
                    <td> 20% </td>
                    <td> 15% </td>
                    <td> 10% </td>
                </tr>
                <tr>
                <td><b>Prazo recebimento</b></td>
                    <td> </td>
                    <td> 15 dias</td>
                    <td> 10 dias</td>
                    <td> 7 dias</td>
                </tr>
                <tr>
                <td><b>Minimo vendas Mensal</b></td>
                    <td></td>
                    <td>R$ 0,00</td>
                    <td>R$ 1.000,00</td>
                    <td>R$ 10.000,00</td>
                </tr>
                <tr>
                <td><b>Visibilidade</b></td>
                    <td></td>
                    <td>50%</td>
                    <td>75%</td>
                    <td>100%</td>
                </tr>

                <td><b>Valor</b></td>
                    <td></td>
                    <td>Grátis</td>
                    <td>Grátis</td>
                    <td>
                        <div class="card">
                            <b>Standart</b>
                            <p style="font-size: 8px;">Garante as melhores condições para suas vendas.</p>
                            <p class="total">R$ <span style="font-size: 20px;">29,00</span> / Mês </p>
                            <p style="font-size: 8px;">*Estimativa de gasto mensal durante 30 dias.</p>
                            <button>Comprar</button>
                        </div>
                        <div class="card">
                            <b>Platinum</b>
                            <p class="total">R$ <span style="font-size: 20px;">59,00</span> / Trimestral </p>
                            <p style="font-size: 8px;">*Estimativa de gasto durante 3 meses. 33% 59,00 os 7dias grátis</p>
                            <button>Comprar</button>
                        </div>
                        <div class="card">
                            <b>Infinity</b>
                            <p class="total">R$ <span style="font-size: 20px;">169,00</span> / Semestre </p>
                            <p style="font-size: 8px;">*Estimativa de gasto durante 6 meses.</p>
                            <button>Comprar</button>
                        </div>
                        <div class="card">
                            <b>Black</b>
                            <p class="total">R$ <span style="font-size: 20px;">199,00</span> / Anual </p>
                            <p style="font-size: 8px;">*Estimativa de gasto durante 12 meses.</p>
                            <button>Comprar</button>
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