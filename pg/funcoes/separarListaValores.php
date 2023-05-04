<?php
// verifica cada campo booleano individualmente e exibe apenas os que são verdadeiros
if ($alimentacao == 1) {
    echo "<li style='margin-right: 22px; display:none;'>";
    echo " Refeição: <i class='fa-solid fa-burger'></i> ";
    echo "</li>";

  }
  if ($transporte == 1) {
    echo "<li style=' display:none;'>";
    echo " Transporte: <i class='fa-solid fa-car'></i> ";
    echo "</li>";

  }


  ?>