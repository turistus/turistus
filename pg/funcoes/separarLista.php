<?php
// Criar uma matriz contendo suas variáveis
$variaveis = array(
    $lanchonete,
    $camping,
    $hotelaria,
    $sanitarios,
    $risco,
    $acessib
);

// Definir um método de provedor de dados para gerar todas as combinações possíveis
function combDataProvider(){
    $comb = array();
    for ($i = 0; $i < pow(2, count($this->variaveis)); $i++) {
        $row = array();
        for ($j = 0; $j < count($this->variaveis); $j++) {
            if (pow(2, $j) & $i) {
                $row[] = 1;
            } else {
                $row[] = 0;
            }
        }
        $comb[] = $row;
    }
    return $comb;
}

// Usar o método de provedor de dados para gerar as combinações possíveis
foreach ($this->combDataProvider() as $comb) {
    // Aqui você pode usar as variáveis de cada combinação para criar o seu código


    $itens = array(
    'lanchonete' => 'Praça de Alimentação',
    'camping' => 'Camping',
    'hotelaria' => 'Hotelaria a 5KM',
    'sanitarios' => 'Sanitarios',
    'risco' => 'Risco de vida',
    'acessib' => 'Acesso Rampas'
    );

    for ($i = 0; $i < count($comb); $i++) {
        $combStr = '';
        for ($j = 0; $j < count($this->variaveis); $j++) {
            $var = $this->variaveis[$j];
            $val = $comb[$i][$j];
            if ($val == 1) {
                $combStr .= "<li>{$itens[$var]}</li>";
            }
        }
        echo "<ul>{$combStr}</ul>";
    }

}
?>