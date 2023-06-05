
<div id="popup" class="popup">
  <div class="popup-content">
    <!-- Conteúdo do pop-up -->
    <h2>Cadastre seu Ponto Turistico !</h2>

    <a href="./solicitacaoNovoPontoTuristico.php">
        <button class="btn" id="cad" style="border: 1px solid green; border-radius: 5px;"> Cadastrar </button>
    </a>
    <a href="#">
        <button class="btn" id="close-button" style="border: 1px solid green; border-radius: 5px;"> Fechar </button>
    </a>
  </div>
</div>


<style>

.popup {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: none;
  justify-content: center;
  align-items: center;
}

.popup-content {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
}

.popup-content h2 {
  margin-top: 0;
}


</style>
<script>
// Obter elementos do DOM
var popup = document.getElementById('popup');
var closeButton = document.getElementById('close-button');

// Função para exibir o pop-up
function openPopup() {
  popup.style.display = 'flex';
}

// Função para fechar o pop-up
function closePopup() {
  popup.style.display = 'none';
}

// Adicionar ouvintes de eventos
window.addEventListener('load', function() {
  // Exibir o pop-up quando o mouse passar no topo da página
  window.addEventListener('mousemove', function(event) {
    if (event.clientY < 50) {
      openPopup();
    }
  });

  // Fechar o pop-up ao clicar no botão de fechar
  closeButton.addEventListener('click', closePopup);
});

</script>