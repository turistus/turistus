


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
                    <!-- form vazio pra abrir limpo-->
                    <div class="modal-content" id=formPrimeiro>


                    </div>

                    <!--o id é acessado pelo JS quando o botao com id turista é clicado e busca o include -->
                    <div class="modal-content" id=acessaTurista>

                        <?php
                          include_once './lgn/entrarTurista.php';
                        ?>
                    </div>

                    <!--o id é acessado pelo JS quando o botao com id GUIA é clicado e busca o include -->
                    <div class="modal-content" id=acessaGuia>
                        <?php
                          include_once './lgn/entrarGuia.php';
                        ?>
                    </div>




                    </div>
                </div>
            </div>
            <button type='button' class='btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#loginModal'>
              Acessar
            </button>
         </div>



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