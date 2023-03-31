<?php
session_start();
//define('ACCESS', true);
include_once './connection.php';
//$idS = $_SESSION['user_id'];

if(!isset ($_SESSION['user'])){

  //var_dump($_SESSION['user_email']);
  //echo $_SESSION['user_email'];

  $emailSessaoAberta = $_SESSION['user_email'];

  //echo " Op: " . $emailSessaoAberta;
   }else{
    $_SESSION['user_email'] = "des@d.com";
   }


//Pesquisar o usuário Guia BD
$query_user = "SELECT id AS idG, servicos.email FROM servicos WHERE servicos.email = :email  LIMIT 1";
$result_user = $conn->prepare($query_user);
$result_user->bindParam(':email', $emailSessaoAberta);
$result_user->execute();
$row_user = $result_user->fetch(PDO::FETCH_ASSOC);
$emailG = isset($row_user['email']);
$idG = isset($row_user['idG']);
//echo "<br>".isset($row_user['email']) . ">GUIA <br>";



//Pesquisar o usuário Turista BD
$query_turista = "SELECT id AS idT, turistas.email FROM turistas WHERE turistas.email = :email  LIMIT 1";
$result_turista = $conn->prepare($query_turista);
$result_turista->bindParam(':email',$emailSessaoAberta);
$result_turista->execute();
$row_turista = $result_turista->fetch(PDO::FETCH_ASSOC);
$emailT = isset($row_turista['email']);
$idT = isset($row_turista['idT']);
//echo isset($row_turista['email']) . "Turista <br>";

?>


<header class="p-2 mb-2 border-bottom" style="font-family: 'EB Garamond'; font-size: 20px;  background-color:#f1f1f3;">
  <div class="container" >
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start" >


      <a href="index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
        <img class="bi me-2" width="40" height="40" src="./images/logooriginal.png">
      </a>
      <h2>TuristUs </h2>

      <ul  class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">

        <li><a href="#" class="nav-link px-2 link-dark"></a></li>
        <li><a href="#" class="nav-link px-2 link-dark"></a></li>
        <li><a href="pg/pontos-turisticos.php" class="nav-link px-2 link-secondary"><ion-icon name="image-outline"></ion-icon> Pontos turisticos</a></li>
        <li><a href="pg/eventos.php" class="nav-link px-2 link-secondary"><ion-icon name="leaf-outline"></ion-icon> Eventos</a></li>
        <li><a href="guias/cadastrarguia.php" class="nav-link px-2 link-secondary"><ion-icon name="compass-outline"></ion-icon> Guia</a></li>
        <li><a href="pg/mapa.php" class="nav-link px-2 link-secondary"><ion-icon name="earth-outline"></ion-icon> Mapa </a></li>
        <li><a href="pg/sobre.php" class="nav-link px-2 link-secondary"><ion-icon name="finger-print-outline"></ion-icon> Sobre </a></li>

      </ul>
      <!-- existia um Pesquisar aqui


      -->

      <!-- BOTAO de ACESSAR o LOGUIN MODAL -->
        <div id="dados-usuario" style="margin: 10px; ">
          <?php
        if( $emailT == $emailSessaoAberta){

          if($emailG != $emailSessaoAberta){
            echo  "<div class='dropdown text-end'>";
            echo  "<a href='#' class='d-block link-dark text-decoration-none dropdown-toggle' id='dropdownUser1' data-bs-toggle='dropdown' aria-expanded='false'> ";
            echo  "<img src='./images/user.png' alt='mdo' width='32' height='32' class='rounded-circle'> </a>";

                echo "<ul class='dropdown-menu text-small' aria-labelledby='dropdownUser1'>";
                  echo "<li><a class='dropdown-item' href='./usuarios/painelTurista.php'>Perfil</a></li>";
                  echo "<li><a class='dropdown-item' href='./lgn/logout.php'>Sair</a></li>";
                echo "</ul>";
            echo "</div>";
          }else{

            echo "<button type='button' class='btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#loginModal'>";
            echo   "Acessar";
            echo "</button>";
          }

        }elseif($emailG == $emailSessaoAberta){
          if($emailT != $emailSessaoAberta){
            echo  "<div class='dropdown text-end'>";
            echo  "<a href='#' class='d-block link-dark text-decoration-none dropdown-toggle' id='dropdownUser1' data-bs-toggle='dropdown' aria-expanded='false'> ";
            echo  "<img src='./images/user.png' alt='mdo' width='32' height='32' class='rounded-circle'> </a>";

                echo "<ul class='dropdown-menu text-small' aria-labelledby='dropdownUser1'>";
                  echo "<li><a class='dropdown-item' href='../guias/painelGuia.php'>Perfil</a></li>";
                  echo "<li><a class='dropdown-item' href='./lgn/logout.php'>Sair</a></li>";
                echo "</ul>";
            echo "</div>";
          }else{

            echo "<button type='button' class='btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#loginModal'>";
            echo   "Acessar";
            echo "</button>";
          }

        }else{

          echo "<button type='button' class='btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#loginModal'>";
          echo   "Acessar";
          echo "</button>";
        }

        ?>

          </div>

          <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel">Área Restrita</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    <div class="row">
                      <p></p>
                      <button id="turista" type="button" class="btn btn-light text-dark me-2">Turista</button>
                      <button id="guia" type="button" class="btn btn-light text-dark me-2">Guia</button>
                    </div>
                    <br>

                    <div class="modal-content" id=formPrimeiro>


                    </div>
                    <div class="modal-content" id=acessaTurista>

                        <?php
                          include_once './lgn/entrarTurista.php';
                        ?>
                    </div>
                    <div class="modal-content" id=acessaGuia>
                        <?php
                          include_once './lgn/entrarGuia.php';
                        ?>
                    </div>




                    </div>
                </div>
            </div>
         </div>

        <div class="text-end">


          <a href="./usuarios/cadastrarturista.php"> <button type="button" class="btn btn-outline-primary">Cadastrar</button></a>
        </div>









    </div>
  </div>
</header>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


<!-- Icones do menu -->
<script  type = "module"  src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js" > </script>
<script  nomodule  src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js" > </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){

    $("#acessaTurista").hide();
    $("#acessaGuia").hide();
    $("#formPrimeiro").show();

  $("#turista").click(function () {
    $("#acessaTurista").show(1000);
    $("#acessaGuia").hide();
    $("#formPrimeiro").hide();

	});

  $("#guia").click(function () {
		$("#acessaGuia").show(1000);
    $("#acessaTurista").hide();
    $("#formPrimeiro").hide();
	});


  });




</script>