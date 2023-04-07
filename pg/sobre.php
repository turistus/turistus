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

  <style>

    /* Imagem de fundo com efeito parallax */
		.parallax {
			background-image: url('../images/logooriginal.png');
			background-attachment: fixed;
			background-size: cover;
			background-position: center;
			min-height: 100%;
			overflow: auto;
		}
				/* Cabeçalho */
		.header {
			background-color: rgba(0,0,0,0.7);
			color: #fff;
			padding: 50px 0;
			text-align: center;
		}
		/* Animação do cabeçalho */
		@keyframes fadeIn {
			from {
				opacity: 0;
			}
			to {
				opacity: 1;
			}
		}
		.header h1 {
			animation: fadeIn 2s;
		}
		/* Imagem da empresa */
		.company-image {
			margin-top: 50px;
			margin-bottom: 50px;
		}
		/* Texto */
		.text {
			background-color: rgba(255,255,255,0.9);
			padding: 50px 0;
			text-align: justify;
			margin-bottom: 0;
		}
	</style>
</head>

<body>

  <?php
  include_once 'menu.php';
  ?>

    <main>
      <!-- Conteúdo da página -->
	  <div class="parallax">
        <!-- Cabeçalho -->
        <div class="header">
          <h1> Turist Us </h1>
          <p class="lead">Conexão com a natureza</p>
        </div>
        <div class="conteiner-fluid text" style="border: 1px solid black; margin: 20px; padding: 20px;">

        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <p>Nós somos uma empresa apaixonada pelo turismo e pela natureza. Nosso objetivo é proporcionar experiências únicas e memoráveis para nossos clientes, ao mesmo tempo em que cuidamos do meio ambiente e contribuímos para a conservação da natureza.</p>
            <p>Nós nos esforçamos para oferecer pacotes turísticos que permitam que nossos clientes explorem as belezas naturais de cada região de forma responsável e sustentável. Acreditamos que a natureza é nossa maior fonte de inspiração e que devemos preservá-la para as futuras gerações.</p>
            <p>Além disso, a nossa equipe é formada por guias experientes e apaixonados pelo que fazem. Eles estão sempre dispostos a compartilhar seus conhecimentos e histórias sobre a natureza e a cultura local, proporcionando uma experiência ainda mais rica e autêntica para nossos clientes.</p>
            <p>Nosso compromisso com a sustentabilidade é parte integral da nossa filosofia. Fazemos questão de minimizar nosso impacto ambiental e contribuir para as comunidades locais onde operamos. Acreditamos que o turismo pode ser uma força positiva para o desenvolvimento econômico e social, desde que seja feito de forma responsável e sustentável.</p>
          </div>
        </div>


        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <p>A Turist Us é uma plataforma inovadora que oferece soluções para a contratação de serviços turísticos em todo o Brasil.
      Sabemos que pode ser difícil para turistas encontrar o melhor serviço turístico em uma determinada região afastada das grandes cidades,
      assim como tambem é difícil para quem oferece ou quer oferecer serviços ou divulgar seus negócios.</p>
            <p>É por isso que na Turist Us, trabalhamos em estreita colaboração com os profissionais do setor para entender suas necessidades reais
       e oferecer soluções eficazes em questão de obter mais visitas a sua região local.</p>
            <p>Nossa plataforma permite que os profissionais do setor turístico cadastrem seus pontos turísticos gratuitamente,
      divulgando-os por cidade, região e tipo de turismo, trazendo visibilidade organizada aos pontos,
       mais incriveis do Brasil conhecido por poucos e tudo de graça.
      Além disso, os profissionais podem vincular serviços das diversas mobilidades de atividades existentes no turismo,
      gerando renda ao municipio e reconhecimento ao seu trabalho.</p>
            <p>É importante destacar que o ramo de serviços representa um total de 75% do setor de turismo,
      e já passou da hora de ter uma ferramenta que auxilie nas operações.</p>
            <p>A Turist Us surge como uma solução para essa demanda.</p>
            <p>O cadastro de profissionais, pontos, turistas e até eventos é gratuito e deve seguir as regras estipuladas, para suas publicações.
      A monetização da startup vem com a venda de eventos na plataforma, em que estipula uma taxa sobre o valor do serviço vendido,
      com uma participação variavel de 20% a 10% do valor. Além disso, oferecemos uma gamificação para fidelizar os profissionais e melhorar seus serviços,
      além de planos que viram no futuro para valorizar ainda mais nossos profissionais turisticos.</p>
            <p>Hoje, existem inúmeros sites em que profissionais vendem serviços de diversos setores, mas e o setor turistico?
      a Turist Us abrange diversos serviços, como passeios turísticos, trilhas, rapel, parapente, balonismo e mais de 50 atividades existentes no mercado.</p>
            <p>Somos uma equipe pequena, mas com uma grande visão de futuro para o setor de turismo. Nossa missão é gerar mais visibilidade e,
      consequentemente, renda para o setor, criando uma conexão natural entre todos os envolvidos.</p>
            <p>Em resumo, a Turist Us é uma plataforma inovadora que oferece soluções para o ramo de contratação de serviços turísticos,
      gerando mais visibilidade e renda para o setor. Com uma monetização baseada na venda de eventos na plataforma,
      oferecemos aos profissionais uma facilidade para fidelizá-los e melhorar seu serviço.</p>
            <p> Nossa plataforma abrange diversos serviços turísticos, promovendo uma conexão natural entre todos os envolvidos.
      Com a Turist Us, você pode escolher o melhor serviço turístico a qualquer hora em qualquer região do Brasil.</p>

          </div>
        </div>


      </div>
    </div>
    <br>
    <br>

    </div>
   </main><!-- /.container -->
  <?php
  include_once '../rodape.php';
  ?>

  <!-- Tenho que transformar o site em um jogo imagine o MARIO os quadradinhos formando as coisas molduras simples -->
</body>

</html>
