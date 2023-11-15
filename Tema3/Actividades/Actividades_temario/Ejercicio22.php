<?php

    $numeros = array(12, 18, 5, 11, 10, 95, 3);
    $multiplos = array(2, 3, 5);

    $esMultiplo = fn($numero) => count(array_filter($multiplos, fn($m) => $numero % $m === 0)) > 0;

    $resultado = array_filter($numeros, $esMultiplo);
    echo "<h2>Múltiplos de 2, 3 y 5: </h2><p>" . implode(", ", $resultado) . "</p>";

?>