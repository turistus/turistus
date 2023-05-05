
<!--  O K PAGINA ESTA Funcional apresentando apenas os EVENTOs do GUIA LOGADO -->
          <div class="box-search" >
            <div class="row ">
                <div class=" col-xl-10 col-lg-10 col-md-10 col-sm-10 col-mb-10">
                    <input style="border: 1px solid black;" type="search" class="form-control " id="pesquisar">
                </div>
                <div class=" col-lg-2 col-md-2 col-sm-2 col-mb-2">
                    <button onclick="searchData()"  class="btn btn-primary">Buscar</button>

                </div>

            </div>
            <label>Pesquise o evento por Nome ou cidade</label>
        </div>
    <br>


  <div class="conteiner"  style="border-top: 4px solid green; margin: auto;">
    <div class="row">
      <div class="col-12" style="margin:AUTO; padding-top: 10px; padding-bottom: 10px;">
        <!-- Aqui Busca os eventos criado pelo Guia -->
        <?php

        if(!empty($_GET['search'])){
          $palavra = $_GET['search'];
          $query = " SELECT *,
          eventos.id AS idE,
          eventos.nome AS nome,
          eventos.valor AS valor,
          eventos.idGuia AS idGuia,
          eventos.idPt,
          eventos.pontos AS pontos,


          datah,

          pontosturisticos.id,
          pontosturisticos.image AS img,
          pontosturisticos.cidade

          FROM eventos INNER JOIN pontosturisticos ON pontosturisticos.id = eventos.idPt WHERE eventos.nome

          LIKE '%$palavra%' OR pontosturisticos.cidade LIKE '%$palavra%' ORDER BY pontosturisticos.name ASC";

          $result_products = $conn->prepare($query);
          $result_products->execute();
        }else{
          //Aqui busca os eventos com Boa Pontuação.
          $query_products = "SELECT *,
        eventos.id AS idE,
        eventos.nome AS nome,
        eventos.valor AS valor,
        eventos.idGuia AS idGuia,
        eventos.idPt,
        eventos.pontos,

        dataUp,

        pontosturisticos.id,

        val.idEvento,
        val.total,

        ft.id AS idFoto,
        ft.foto AS img,
        ft.idEv



        FROM eventos
        INNER JOIN pontosturisticos ON pontosturisticos.id = eventos.idPt
        INNER JOIN valores AS val ON val.idEvento = eventos.id GROUP BY val.idEvento
        INNER JOIN foto_Eventos AS ft ON ft.idEv = eventos.id ";

        //WHERE eventos.pontos != 0

        $result_products = $conn->prepare($query_products);
        $result_products->execute();
        }




        ?>

        <div class="row row-cols-1 row-cols-md-3">
            <?php
            while ($row_product = $result_products->fetch(PDO::FETCH_ASSOC)) {
              extract($row_product);
            ?>


              <div class="col-12 col-sm-6 mb-4 text-center " >
                    <div class="card-body" >
                      <h5 class="card-title " style="height: 40px;" ><?php echo $nome; ?></h5>

                      <img style="height: 100px; width: 180px; " src= <?php echo "'../images/eventos/$idE/$img";?>'><br>
                      <div class="col-12" >
                            <div class="star-ratings" style=" margin: auto; " >
                                <div class="fill-ratings" style="width: <?php echo $pontos .'%'?>; ">
                                    <span>★★★★★</span>
                                </div>
                                <div class="empty-ratings">
                                    <span>★★★★★</span>
                                    <p style="font-size: xx-small; color: black;"><?php echo $pontos ."%"?></p>
                                </div>

                            </div>
                      </div>


                    <h5 class="card-title">R$ <?php echo number_format($total, 2, ",", ".") ?></h5>
                      <a href="view-evento.php?id=<?php echo $idE; ?>" class="btn btn-primary">Detalhes</a>

                  </div>



            </div>


            <?php
            }
            ?>
        </div>
      </div>
    </div>
  </div>
    <!-- FINAL ONDE BUSCA OS eventoS -->
