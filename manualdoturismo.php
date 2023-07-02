<?php
//session_start();
define('ACCESS', true);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" >
  <link rel="shortcut icon" type="imagex/png" href="../images/logooriginal.png">
  <title>Turismo - Curso Online</title>
  <!-- Font Awesome icons -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">

  <!-- Custom CSS -->
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f8f9fa;
    }

    .card {
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .card-img-top {
      border-radius: 10px 10px 0 0;
    }

    .btn-primary {
      background-color: #003366;
      border-color: #003366;
    }

    .btn-primary:hover {
      background-color: #00345a;
      border-color: #00345a;
    }

    .btn-secondary {
      background-color: #fff;
      border-color: #003366;
      color: #003366;
    }

    .btn-secondary:hover {
      background-color: #003366;
      border-color: #003366;
      color: #fff;
    }

    h2 {
      font-weight: bold;
      color: #003366;
    }

    .bg-light {
      background-color: #f8f9fa !important;
    }

    .social-icons i {
      font-size: 2rem;
      color: #fff;
      transition: all 0.3s;
      cursor: pointer;
    }

    .social-icons i:hover {
      color: #00345a;
      transform: translateY(-5px);
    }
  </style>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cursos de Turismo</title>
  <!-- Incluindo Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">
  <!-- Incluindo CSS personalizado -->
  <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include_once('./menuprincipal.php');
?>


<!-- Descoberta de serviços turísticos -->
<section class="bg-light py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2>Descubra serviços turísticos e atividades com nossa plataforma</h2>
        <p>Está planejando uma viagem? Nós podemos ajudá-lo a encontrar os melhores lugares para visitar em cada destino, desde os pontos turísticos mais populares até os tesouros escondidos.</p>
        <p>Além disso, se você é proprietário de um negócio turístico, pode usar nossa plataforma para divulgar seus serviços e atividades e alcançar um público mais amplo.</p>
        <p>Ao juntar-se a nós, você terá acesso a informações detalhadas sobre os serviços turísticos e atividades disponíveis em cada destino, ajudando-o a planejar sua viagem de forma mais eficiente e a garantir que você não perca nada durante sua estadia.</p>
        <p>Em resumo, nossa plataforma é uma ferramenta útil tanto para viajantes quanto para proprietários de negócios turísticos. Junte-se a nós para descobrir ou divulgar os melhores lugares para visitar e tornar sua próxima viagem uma experiência inesquecível.</p>
      </div>
    </div>
  </div>
</section>

<!-- Tutoriais para turistas -->
<section class="bg-light py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2>Para turistas: dicas para uma boa viagem</h2>
        <p>Aqui vão algumas dicas importantes para ter uma viagem mais tranquila e aproveitar ao máximo sua experiência:</p>
        <ul>
          <li>Faça uma lista do que levar na mala e verifique com antecedência as exigências de bagagem das companhias aéreas;</li>
          <li>Pesquise sobre a cultura e os costumes do lugar que irá visitar, para evitar situações desconfortáveis ou ofensivas;</li>
          <li>Planeje seu itinerário com antecedência, incluindo reservas de hospedagem, transporte e passeios;</li>
          <li>Leve um adaptador universal de tomadas, para não ficar sem bateria em seus aparelhos eletrônicos;</li>
          <li>Leve um mapa do local ou baixe um aplicativo de mapas offline, caso não tenha acesso à internet;</li>
          <li>Tenha sempre um seguro de viagem para imprevistos;</li>
          <li>Experimente a culinária local e interaja com os habitantes da região, para vivenciar a cultura de forma mais autêntica.</li>
        </ul>
      </div>
      <div class="col-md-12">
        <h2>Para profissionais: dicas para oferecer uma boa experiência aos turistas</h2>
        <p>Se você trabalha com turismo, seja como guia, agente de viagens ou empreendedor, aqui estão algumas dicas para proporcionar uma experiência inesquecível aos seus clientes:</p>
        <ul>
          <li>Conheça bem o destino e suas atrações, para oferecer informações precisas e úteis aos turistas;</li>
          <li>Personalize o atendimento de acordo com as preferências e necessidades do cliente;</li>
          <li>Seja atencioso e prestativo em todas as interações, oferecendo ajuda e suporte em caso de imprevistos;</li>
          <li>Esteja sempre atualizado sobre as novidades e tendências do setor de turismo, para oferecer serviços diferenciados e atrativos;</li>
          <li>Invista em treinamento e capacitação, para aprimorar suas habilidades e conhecimentos;</li>
          <li>Crie parcerias com outras empresas do setor, para oferecer pacotes de viagem mais completos e atrativos;</li>
          <li>Peça feedback dos clientes e utilize essas informações para melhorar seus serviços e fidelizar clientes.</li>
        </ul>
      </div>
    </div>
  </div>
  <!-- Jumbotron -->
  <div class="jumbotron jumbotron-fluid bg-info text-white">
    <div class="container">
      <h1 class="display-4">Cursos de Turismo</h1>
      <p class="lead">Aprenda sobre as melhores práticas do turismo e se prepare para atuar nessa área.</p>
    </div>
  </div>

  <!-- Cursos -->
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Turismo Sustentável</h5>
            <p class="card-text">Aprenda sobre as melhores práticas de turismo sustentável e como aplicá-las em suas atividades.</p>
            <a href="#" class="btn btn-primary">Saiba mais</a>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Turismo Cultural</h5>
            <p class="card-text">Conheça as diversas manifestações culturais do turismo e aprenda a valorizar e preservar o patrimônio cultural.</p>
            <a href="#" class="btn btn-primary">Saiba mais</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="row">
  <?php
    include_once("./RoadMapTuristus.pdf")
  ?>
<a href="./RoadMapTuristus.pdf">RoadMAp</a>
</div>

<?php
    include_once('./rodape.php')
?>