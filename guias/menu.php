
<?php
//$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
//PAGINA DO MENUSUPERIOR DO GUIA
?>

<header class="p-2 mb-2 border-bottom" style="font-family: 'EB Garamond';font-size: 20px; ">
  <div class="container" >
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start" >


      <a href="../index.php?Uid=<?php echo $Uid?>" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
        <img class="bi me-2" width="40" height="40" src="../images/logooriginal.png">
      </a>
      <h2>TuristUs </h2>

      <ul  class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">

        <li><a href="#" class="nav-link px-2 link-dark"></a></li>
        <li><a href="#" class="nav-link px-2 link-dark"></a></li>
        <li><a href="../pg/pontos-turisticos.php" class="nav-link px-2 link-secondary"><ion-icon name="image-outline"></ion-icon> Pontos turisticos</a></li>
        <li><a href="../pg/eventos.php" class="nav-link px-2 link-secondary"><ion-icon name="leaf-outline"></ion-icon> Eventos</a></li>
        <!-- <li><a href="../guias/cadastrarguia.php" class="nav-link px-2 link-secondary"><ion-icon name="compass-outline"></ion-icon> Guia</a></li> -->
        <li><a href="../pg/mapa.php" class="nav-link px-2 link-secondary"><ion-icon name="earth-outline"></ion-icon> Mapa </a></li>
        <li><a href="../pg/sobre.php" class="nav-link px-2 link-secondary"><ion-icon name="finger-print-outline"></ion-icon> Sobre </a></li>
        <li><a href="#" class="nav-link px-2 link-secondary"><ion-icon name=""></ion-icon> </a></li>
        <li><a href="../lgn/logout.php?id=<?php echo $Uid?>" class="nav-link px-2 link-secondary">Sair</a></li>
      </ul>
      <!-- existia um Pesquisar aqui


      -->


    </div>
  </div>
</header>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" ></script>


<!-- Icones do menu -->
<script  type = "module"  src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js" > </script>
<script  nomodule  src="https://unpkg .com/ionicons@5.5.2/dist/ionicons/ionicons.js" > </script>
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