

<!-- Primeira LINHA Principal CONTEINER -->
<main class="container">
    <div class="shadow-sm p-3 mb-5 bg-white rounded"  >
        <div class="row">

<div class="row">
        <!-- Titulo-->
        <div class="row" style=" padding-left: 20px;  margin-bottom: 10px; ">
            <div class="col-12">
            <h1 style="padding-top: 10px;">Eventos </h1>
            </div>
        </div>
      <div class="col-md-12 ">
        <!-- Aqui Busca os eventos criado pelo Guia -->
        <?php
        $query_products = "SELECT *,
        eventos.id AS idE,
        eventos.nome AS nome,
        eventos.valor AS valor,
        eventos.idGuia AS idGuia,

        idPt,

        pontosturisticos.id,
        pontosturisticos.image AS img,

        servicos.id,
        servicos.nome AS nomeGuia,

        val.idEvento,
        val.total

        FROM eventos INNER JOIN pontosturisticos ON pontosturisticos.id = eventos.idPt
        INNER JOIN servicos ON servicos.id = eventos.idGuia
        INNER JOIN valores AS val ON val.idEvento = eventos.id
        WHERE pontosturisticos.id = $id GROUP BY val.idEvento";

        $result_products = $conn->prepare($query_products);
        $result_products->execute();
        ?>
        <div class="row col	col-sm-6 col-md-12 col-lg-12 col-xl-12">
          <?php
          while ($row_product = $result_products->fetch(PDO::FETCH_ASSOC)) {
            extract($row_product);
          ?>
            <div class="text-center" >
              <div class="card" >

              <a href="view-evento.php?id=<?php echo $idE;?>" class="btn ">
                <div class="card-body " style="padding: 10px;  ">



                <?php
                      $busca_Fotos = mysqli_query($conex, "SELECT * FROM foto_Eventos WHERE foto_Eventos.idEv = $idE limit 1");
                      $midias = array();
                      while ($row = mysqli_fetch_assoc($busca_Fotos)) {
                          $midias[] = $row['foto'];
                      }
                      foreach ($midias as $midia) {
                        $extensao = pathinfo($midia, PATHINFO_EXTENSION);
                        if ($extensao == 'mp4') { ?>
                              <div>
                                <video id="video-<?php echo $midia; ?>" src="../images/eventos/<?php echo $idE . '/' . $midia; ?>" controls style="height: 100px; width: 180px; text-align: center; margin-left:auto; margin-right: auto; border-radius: 10px;"></video>
                                <script>
                                    // Reproduzir automaticamente o vídeo e passar para o próximo
                                    document.addEventListener("DOMContentLoaded", function() {

                                        video.play();
                                    });
                                </script>
                              </div>
                          <?php }
                          else
                          { ?>
                            <div>
                              <img style="height: 80px; width: 100px; " src= <?php echo "'../images/eventos/$idE/$midia";?>'><br>
                            </div>
                        <?php } ?>
                      <?php } ?>







                    <h6 class="card-title"><?php echo $nome; ?></h6>
                    <p class="card-title">R$ <?php echo number_format($total, 2, ",", ".") ?></p>
                    <p class="card-title"><?php echo $nomeGuia; ?></p>


                </div>
              </a>

              </div>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
    <!-- FINAL ONDE BUSCA OS eventoS -->
        </div>
    </div>
  </main>