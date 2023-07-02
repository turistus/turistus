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
            padding: 15px;
        }

        .carousel {
            position: relative;
            width: 400px;
            height: 300px;
            overflow: hidden;
        }

        .carousel-inner {
            width: 1600px; /* Largura total dos cartões (400px * 4) */
            height: 300px;
            display: flex;
            transition: transform 0.3s ease;
        }

        .carousel-indicators {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .carousel-indicators span {
            display: inline-block;
            width: 10px;
            height: 10px;
            background-color: #bbb;
            border-radius: 50%;
            margin: 0 5px;
            cursor: pointer;
        }

        .carousel-indicators span.active {
            background-color: #333;
            display: block; /* Exibe o card ativo */
        }

        .carousel .card {
        flex: 0 0 100%;
        display: none;
        }

        .scaled {
        transform: scaleX(0.8) scaleY(0.8); /* Equal to scaleX(0.7) scaleY(0.7) */
        }
    </style>
</head>

    <body>
        <?php
            include_once("../../guias/menu.php")
        ?>
        <div class="conteiner scaled">
            <table>
                <tr>
                    <th colspan="5" style="text-align: center;"> Planos </th>
                </tr>

                <tr>
                <td><b>Plano</b></td>
                    <td></td>
                    <td style="text-align: center; font-size: 18px;"><i>Comum</i></td>
                    <td style="text-align: center; font-size: 18px;"><i>Completo</i></td>
                    <td style="text-align: center; font-size: 18px;"><i>Vip</i></td>
                </tr>
                <tr>
                <td><b>Taxa</b></td>
                    <td> </td>
                    <td> 20% </td>
                    <td> 15% </td>
                    <td style="text-align: center;"> 10% </td>
                </tr>
                <tr>
                <td><b>Prazo recebimento</b></td>
                    <td> </td>
                    <td> 15 dias</td>
                    <td> 10 dias</td>
                    <td style="text-align: center;"> 7 dias</td>
                </tr>
                <tr>
                <td><b>Minimo vendas Mensal</b></td>
                    <td></td>
                    <td>R$ 1.000,00</td>
                    <td>R$ 1.000,00</td>
                    <td style="text-align: center;">R$ 0,00</td>
                </tr>
                <tr>
                <td><b>Visibilidade</b></td>
                    <td></td>
                    <td>50%</td>
                    <td>75%</td>
                    <td style="text-align: center;">100%</td>
                </tr>





                <td><b>Valor</b></td>
                    <td></td>
                    <td>Grátis</td>
                    <td>Grátis</td>

                    <td><div class="row">


                    <div class="carousel-fluid w-3" >
                        <div class="carousel-inner">
                            <div class="card">
                                <b>Standart</b>
                                <p style="font-size: 8px;">Garante as melhores condições para suas vendas.</p>
                                <p class="total">R$ <span style="font-size: 20px;">29,00</span> / Mensal </p>
                                <p style="font-size: 12px;">R$ 0,96 por dia.</p>
                                <p style="font-size: 8px;">*Estimativa de gasto mensal durante 30 dias. Aproveite já e aumente os ganhos.</p>
                                <button>Comprar</button>
                            </div>

                            <div class="card">
                                <b>Platinum</b>
                                <p style="font-size: 8px;">Garante as melhores formas para suas vendas.</p>
                                <p class="total" style="width: 180px;">R$ <span style="font-size: 20px; ">59,00</span> / Trimestral </p>
                                <p style="font-size: 12px;">R$ 20,00 por mês.</p>
                                <p style="font-size: 8px;">*Estimativa de gasto durante 3 meses. Os 7 primeiros dias grátis.</p>
                                <button>Comprar</button>
                            </div>

                            <div class="card">
                                <b>Infinity</b>
                                <p style="font-size: 8px;">Garante mais segurança no pagamento. Conte com o PicPay.</p>
                                <p class="total" style="width: 180px;">R$ <span style="font-size: 20px;">99,00</span> / Semestre </p>
                                <p style="font-size: 12px;">R$ 16,50 por mês.</p>
                                <p style="font-size: 8px;">*Estimativa de gasto durante 6 meses. Os 7 primeiros dias grátis.</p>
                                <button>Comprar</button>
                            </div>

                            <div class="card">
                                <b>Black</b>
                                <p style="font-size: 8px;">Garante as melhores custo benefício para suas vendas.</p>
                                <p class="total">R$ <span style="font-size: 20px; ">159,00</span> / Anual </p>
                                <p style="font-size: 12px;">R$ 13,25 por mês.</p>
                                <p style="font-size: 8px;">*Estimativa de gasto durante 12 meses. Os 7 primeiros dias grátis.</p>
                                <button>Comprar</button>
                            </div>

                        </div>
                    </div>
            <br><br>
                            <p><div class="carousel-indicators">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            </p>
                    </div></td>


                </tr>


            </table>



        </div>
        <?php
            include_once("../../rodape.php")
        ?>

<script>
    const carouselInner = document.querySelector('.carousel-inner');
    const indicators = document.querySelectorAll('.carousel-indicators span');
    const cards = document.querySelectorAll('.carousel-inner .card');

    // Adicionar evento de clique aos indicadores
    indicators.forEach((indicator, index) => {
    indicator.addEventListener('click', () => {
        const cardWidth = cards[0].offsetWidth;

        // Ocultar cards não ativos e mostrar card ativo
        cards.forEach((card, cardIndex) => {
        if (cardIndex === index) {
            card.style.display = 'inline-block';
        } else {
            card.style.display = 'none';
        }
        });

        // Atualizar a transformação do carousel
        carouselInner.style.transform = `translateX(-${cardWidth * index}px)`;

        // Ativar indicador selecionado
        indicators.forEach((indicator) => {
        indicator.classList.remove('active');
        });
        indicator.classList.add('active');
    });
});
</script>
    </body>
</html>