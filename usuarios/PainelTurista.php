<?php
session_start();
define('ACCESS', true);
include_once '../connection.php';

ob_start();


//echo $_SESSION['user_id'];
$Trid = $_SESSION['user_id'];
$nome = $_SESSION['user_name'];
$emailUsuario = $_SESSION['user_email'];

//echo $emailUsuario;

?>

<!DOCTYPE html>
<html lang="pt/br">

<head>
  <title>Painel Do Turista</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->

  <link rel="shortcut icon" type="imagex/png" href="../images/logooriginal.png">
</head>

<body>

  <?php
  include_once 'menuPainelTurista.php';
  ?>
  <div class="row">
  </div>
  <main class="content" style="background-color: #A4D3EE; ">

    <!-- O GUIA tem um agendamento de um evento para fazer tbm -->

    <div class="container" style="padding-bottom: 20px;  ">
      <div class="dialog">
        <div class="modal-content">
          <div class="modal-body">

            <div class="row">
              <button id="Painel" type="button" class="btn btn text-dark"> Perfil </button>
              <button id="terceiroForm" type="button" class="btn btn text-dark "> Eventos Pagos </button>
              <!-- <button id="CriarEvento" type="button" class="btn btn text-dark "> Fotos </button>
              <button id="quartoForm" type="button" class="btn btn text-dark "> Favoritos </button>
              <button id="perfilForm" type="button" class="btn btn text-dark "> Pontos Classificação</button> -->

            </div>

            <h4 class="display-6 mt-3 mb-2">Boas Vindas, <?php echo $name ?> </h4>
            <p> Cód.Turista: 00<?php echo $Trid ?></p>

                    <!-- INICIO PAINEL    -->
                    <div class="modal-content" id=formPainel style="padding: 10px;">
                      <div class="row">
                            <!-- Lista -->
                            <div class="col-md-6" style="margin-bottom: 30px;">
                                  <div class="card">
                                    <?php
                                    include_once 'perfilPrivadoTurista.php';
                                    ?>
                                  </div>
                            </div>
                            <!-- Lista -->
                            <div class="col-md-6">
                              <div class="col mb-2 text-center">
                                <div class="card ">
                                  <div class="card-body">
                                    <h3>Pagos e aceitos</h3>



                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- Lista Agendados aceitos e PAGOS-->
                            <div class="col-md-12">
                              <div class="col mb-2 text-center">
                                <div class="card ">
                                  <div class="card-body">
                                    <h3>Solicitações de datas</h3>


                                  </div>
                                </div>
                              </div>
                            </div>
                      </div>
                    </div>

                    <!-- Pag. para listar eventos pagos e agendados -->
                    <div class="modal-content" id=formTerceiro style="padding: 10px;">

                      <?php
                      include_once 'funcoes/eventosLiberados.php';
                      ?>
                    </div>
                    <!-- Pag. para cadastro novo EVENTO desse guia -->
                    <div class="modal-content" id=formCriarEvento>


                      <div class="row">

                        <div class="col-md-6" style="margin-bottom: 30px;">
                          <div class="card ">
                            <div class="card-body">
                              PAINEL DE ALGO
                            </div>
                          </div>
                        </div>

                        <!-- Lista -->
                        <div class="col-md-6">
                          <div class="col mb-2 text-center">
                            <div class="card ">
                              <div class="card-body">
                                <h3>Solicitações de datas</h3>



                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Lista Agendados aceitos e PAGOS-->
                        <div class="col-md-6">
                          <div class="col mb-2 text-center">
                            <div class="card ">
                              <div class="card-body">
                                <h3>Pagos e aceitos</h3>


                              </div>
                            </div>
                          </div>
                        </div>
                        </div>
                    </div>

                    <!-- Pag. para listar eventos  Guia -->
                    <div class="modal-content" id=formQuarto style="padding-bottom: 20px;">

                      <?php
                      include_once '';
                      ?>

                    </div>

                    <div class="modal-content" id=formPerfil style="padding-bottom: 20px;">
                      <!-- Pag. para editar perfil guia -->
                      <?php
                      include_once '';
                      ?>

                    </div>
            </div>

        </div>
      </div><!-- Final da MODAL DIALOG BUTONES-->
    </div><!-- Final da segunda ROW Principal -->

  </main>

  <br>
  <br>
  <hr>
  <?php
  include_once '../rodape.php';
  ?>

</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {

    $("#formPainel").show();
    $("#formCriarEvento").hide();
    $("#formTerceiro").hide();
    $("#formQuarto").hide();
    $("#formSegundo").hide();
    $("#formPerfil").hide();

    $("#CriarEvento").click(function() {
      $("#formCriarEvento").show(500);
      $("#formPainel").hide();
      $("#formTerceiro").hide();
      $("#formQuarto").hide();
      $("#formSegundo").hide();
      $("#formPerfil").hide();
    });

    $("#Painel").click(function() {
      $("#formPainel").show(500);
      $("#formCriarEvento").hide();
      $("#formTerceiro").hide();
      $("#formQuarto").hide();
      $("#formSegundo").hide();
      $("#formPerfil").hide();
    });

    $("#segundoForm").click(function() {
      $("#formSegundo").show(500);
      $("#formPainel").hide();
      $("#formCriarEvento").hide();
      $("#formTerceiro").hide();
      $("#formQuarto").hide();
      $("#formPerfil").hide();
    });

    $("#terceiroForm").click(function() {
      $("#formTerceiro").show(500);
      $("#formPainel").hide();
      $("#formCriarEvento").hide();
      $("#formQuarto").hide();
      $("#formSegundo").hide();
      $("#formPerfil").hide();
    });

    $("#quartoForm").click(function() {
      $("#formQuarto").show(500);
      $("#formPainel").hide();
      $("#formCriarEvento").hide();
      $("#formTerceiro").hide();
      $("#formSegundo").hide();
      $("#formPerfil").hide();
    });

    $("#perfilForm").click(function() {
      $("#formPerfil").show(500);
      $("#formPainel").hide();
      $("#formCriarEvento").hide();
      $("#formTerceiro").hide();
      $("#formQuarto").hide();
      $("#formSegundo").hide();

    });



  });
</script>