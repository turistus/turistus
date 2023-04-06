<?php

// verifica cada campo booleano individualmente e exibe apenas os que são verdadeiros
if ($lanchonete == 1) {
    echo "<li>";
    echo " Praça de Alimentação: <i class='fa-solid fa-burger-soda'></i> </li>";

  }
  if ($camping == 1) {
    echo " Camping: true <br>";
  }
  if ($hotelaria == 1) {
    echo " Hotelaria: true <br>";
  }
  if ($sanitarios == 1) {
    echo " Sanitarios: true <br>";
  }
  if ($risco == 1) {
    echo " Risco: true <br>";
  }
  if ($acessib == 1) {
    echo " Acessib: true <br>";
  }

?>