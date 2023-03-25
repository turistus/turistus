<?php
session_start();
define('ACCESS', true);
include_once '../connection.php';

$uf=filter_input(INPUT_GET, "uf", FILTER_SANITIZE_URL);
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="../images/icon/logo.ico" >
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

        <title>Pontos de <?php echo $uf;?></title>
    </head>
<body>
        <?php
            include_once '../pg/menu.php';
        ?>
    <main class="container" >

        
        <div class="container">
            <h2 class="display-4 mt-5 mb-5">Pontos Turisticos</h2>


            <?php
            $query_products = "SELECT id, name, price, image, uf FROM pontosturisticos WHERE uf = '$uf' ORDER BY id ASC";
            $result_products = $conn->prepare($query_products);
            $result_products->execute();
            ?>
            <div class="row row-cols-1 row-cols-md-3">
                <?php
                while ($row_product = $result_products->fetch(PDO::FETCH_ASSOC)) {
                    extract($row_product);
                    /* echo "<img src='./images/$id/$image'><br>";
                      echo "ID: $id<br>";
                      echo "Nome: $name<br>";
                      echo "Preço: R$ " . number_format($price, 2, ",", ".") . "<br>";
                      echo "<hr>"; */
                    ?>
                    <div class="col mb-4 text-center">
                        <div class="card" >

                            <img style="max-height: 200px" src='<?php echo "../images/pontosturisticos/$id/$image"; ?>' class="card-img-top" alt="...">

                            <div class="card-body">
                                <h5 class="card-title"><?php echo $name; ?></h5>
                                
                                <a href="view-products.php?id=<?php echo $id; ?>" class="btn btn-primary">Detalhes</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                
                ?>
            </div>


        </div>

        
        

        



</main>
<?php
        include_once '../rodape.php';
        ?>
    </body>
</html>
