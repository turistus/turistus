<?php
//session_start();
define('ACCESS', true);
include_once './connection.php';

ob_start();


?>
<!DOCTYPE html>
<html lang="pt/br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" >
  <link rel="shortcut icon" type="imagex/png" href="../images/logooriginal.png">
  <link href='https://fonts.googleapis.com/css?family=EB Garamond' rel='stylesheet'>
  <title>Esqueci minha Senha</title>

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
  <!-- <link href="https://fonts.googleapis.com/css?family=Amiri:wght@400;700&amp;display=swap" rel="stylesheet"> -->
  <!-- Custom styles for this template -->

</head>

<body style="font-family: 'EB Garamond';font-size: 20px;">

  <?php
  include_once 'menuprincipal.php';
  ?>


    <main class="content" style="  padding-top:20px; padding-left: 20px; padding-right: 20px; background-color:#f1f1f3; opacity: .9;">

    <form method="POST" action="processa-cad.php">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
            <label >Celular </label>
                <input type="text" class="form-control" id="celular" placeholder="" name="celular" value="<?php
                            if (isset($dados['celular'])) {
                                echo $dados['celular'];
                            }?>
                ">
        </div>

        <div class="row" style="padding-left: 20px; margin-top:30px;">
            <div class="col-12">
                <input class="btn btn-primary" type="submit" value="Cadastrar"><br><br>
            </div>
        </div>
    </form>

    </main>
</body>
</html>
