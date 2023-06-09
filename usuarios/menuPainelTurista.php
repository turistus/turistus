

<?php
$codigoUsuario = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
//echo "email no menu TURISTA " .$emailUsuario;

    $query_products = "SELECT id, image AS image, name, email AS emailTurista FROM turistas WHERE id = $Trid limit 1";
    $resultado = $conn->prepare($query_products);
    $resultado->execute();

    $row_product = $resultado->fetch(PDO::FETCH_ASSOC);
    extract($row_product);

?>
<header class="p-2 mb-2 border-bottom" style="font-family: 'EB Garamond';font-size: 20px; ">
  <div class="container" >
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start" >


      <a href="../index.php?id=<?php echo $Trid?>" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
        <img class="bi me-2" width="40" height="40" src="../images/logooriginal.png">
      </a>
      <h2 style="
      text-align: center;
      font-size: 35px;
      font-family: Georgia, serif;
      font-weight: bold;
      text-shadow: 1px 1px 2px rgba(0,0,0,0.2);">  TuristUs </h2>

      <ul  class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">

        <li><a href="#" class="nav-link px-2 link-dark"></a></li>
        <li><a href="#" class="nav-link px-2 link-dark"></a></li>
        <li><a href="../pg/pontos-turisticos.php" class="nav-link px-2 link-secondary"><ion-icon name="image-outline"></ion-icon> Pontos turisticos</a></li>
        <li><a href="../pg/eventos.php" class="nav-link px-2 link-secondary"><ion-icon name="leaf-outline"></ion-icon> Eventos</a></li>
        <!-- <li><a href="../guias/cadastrarguia.php" class="nav-link px-2 link-secondary"><ion-icon name="compass-outline"></ion-icon> Guia</a></li> -->
        <li><a href="../mapa.php" class="nav-link px-2 link-secondary"><ion-icon name="earth-outline"></ion-icon> Mapa </a></li>
        <li><a href="../sobre.php" class="nav-link px-2 link-secondary"><ion-icon name="finger-print-outline"></ion-icon> Sobre </a></li>
        <li><a href="../lgn/logout.php" class="nav-link px-2 link-secondary">Sair</a></li>
      </ul>
    </div>
  </div>
</header>


<!-- Icones do menu -->
<script  type = "module"  src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"> </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
