<?php
$usuarioId = isset($_SESSION['user_id']);

?>
<!doctype html>
<html lang="pt/br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="icon" href="../images/icon/logo.png">
  <title>SOBRE</title>


  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.rtl.min.css" rel="stylesheet" integrity="sha384-trxYGD5BY4TyBTvU5H23FalSCYwpLA0vWEvXXGm5eytyztxb+97WzzY+IWDOSbav" crossorigin="anonymous">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="https://fonts.googleapis.com/css?family=Amiri:wght@400;700&amp;display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/blog.rtl.css" rel="stylesheet">

</head>

<body>

  <?php
  include_once 'menu.php';
  ?>

    <main>
    <div class="conteiner" style="border: 1px solid black; margin: 20px; padding: 20px;">
    <p>
      A Turist Us é uma plataforma inovadora que oferece soluções para a contratação de serviços turísticos em todo o Brasil.
      Sabemos que pode ser difícil para turistas encontrar o melhor serviço turístico em uma determinada região afastada das grandes cidades,
      assim como tambem é difícil para quem oferece ou quer oferecer serviços ou divulgar seus negócios.
      <br>
      É por isso que na Turist Us, trabalhamos em estreita colaboração com os profissionais do setor para entender suas necessidades reais
       e oferecer soluções eficazes em questão de obter mais visitas a sua região local.
      <br>
      Nossa plataforma permite que os profissionais do setor turístico cadastrem seus pontos turísticos gratuitamente,
      divulgando-os por cidade, região e tipo de turismo, trazendo visibilidade organizada aos pontos,
       mais incriveis do Brasil conhecido por poucos e tudo de graça.
      Além disso, os profissionais podem vincular serviços das diversas mobilidades de atividades existentes no turismo,
      gerando renda ao municipio e reconhecimento ao seu trabalho.
      <br>
      É importante destacar que o ramo de serviços representa um total de 75% do setor de turismo,
      e já passou da hora de ter uma ferramenta que auxilie nas operações.
      <br>
      A Turist Us surge como uma solução para essa demanda.
      <br>
      O cadastro de profissionais, pontos, turistas e até eventos é gratuito e deve seguir as regras estipuladas, para suas publicações.
      A monetização da startup vem com a venda de eventos na plataforma, em que estipula uma taxa sobre o valor do serviço vendido,
      com uma participação variavel de 20% a 10% do valor. Além disso, oferecemos uma gamificação para fidelizar os profissionais e melhorar seus serviços,
      além de planos que viram no futuro para valorizar ainda mais nossos profissionais turisticos.
      <br>
      Hoje, existem inúmeros sites em que profissionais vendem serviços de diversos setores, mas e o setor turistico?
      a Turist Us abrange diversos serviços, como passeios turísticos, trilhas, rapel, parapente, balonismo e mais de 50 atividades existentes no mercado.
      <br>
      Somos uma equipe pequena, mas com uma grande visão de futuro para o setor de turismo. Nossa missão é gerar mais visibilidade e,
      consequentemente, renda para o setor, criando uma conexão natural entre todos os envolvidos.
      <br>
      Em resumo, a Turist Us é uma plataforma inovadora que oferece soluções para o ramo de contratação de serviços turísticos,
      gerando mais visibilidade e renda para o setor. Com uma monetização baseada na venda de eventos na plataforma,
      oferecemos aos profissionais uma facilidade para fidelizá-los e melhorar seu serviço.
      <br>
      Nossa plataforma abrange diversos serviços turísticos, promovendo uma conexão natural entre todos os envolvidos.
      Com a Turist Us, você pode escolher o melhor serviço turístico a qualquer hora em qualquer região do Brasil.
    </p>



    </div>
   </main><!-- /.container -->
  <?php
  include_once '../rodape.php';
  ?>

  <!-- Tenho que transformar o site em um jogo imagine o MARIO os quadradinhos formando as coisas molduras simples -->
</body>

</html>
