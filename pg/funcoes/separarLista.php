<?php

// verifica cada campo booleano individualmente e exibe apenas os que são verdadeiros
if ($lanchonete == 1) {
    echo "<li>";
    echo " Praça de Alimentação: <i class='fa-solid fa-burger'></i> ";
    echo "</li>";

  }
  if ($camping == 1) {
    echo "<li>";
    echo " Camping: <i class='fa-solid fa-campground'></i>";
    echo "</li>";

  }
  if ($hotelaria == 1) {
    echo "<li>";
    echo " Hotelaria: <i class='fa-solid fa-hotel'></i>";
    echo "</li>";
  }
  if ($sanitarios == 1) {
    echo "<li>";
    echo " Sanitarios: <i class='fa-solid fa-toilet-paper'></i>";
    echo "</li>";
  }
  if ($risco == 1) {
    echo "<li>";
    echo " Risco: <i class='fa-solid fa-triangle-exclamation'></i>";
    echo "</li>";
  }
  if ($acessib == 1) {
    echo "<li>";
    echo " Acessibilidade: <i class='fas fa-wheelchair'></i>";
    echo "</li>";
  }

?>