<?php
// verifica cada campo booleano individualmente e exibe apenas os que são verdadeiros
if ($alimentacao == 1) {
    echo "<li style='margin-right: 15px; list-style: none;'>";
    echo " Refeição: <i class='fa-solid fa-burger'></i> ";
    echo "</li>";

  }
  if ($transporte == 1) {
    echo "<li style='list-style: none;'>";
    echo " Transporte: <i class='fa-solid fa-car'></i> ";
    echo "</li>";

  }


  ?>