<?php
    $listaDeNumeros = array();
    
    for($i = 0; $i<10; $i++){
        $numero = readline("Introduce un número:");
        array_push($listaDeNumeros, $numero);
    }

    mostrarNumerosEnTabla($listaDeNumeros);

    pasarNumerosPrimosAlFinal($listaDeNumeros);

    mostrarNumerosEnTabla($listaDeNumeros);

    function mostrarNumerosEnTabla($listaDeNumeros){
        foreach($listaDeNumeros as $clave => $numero){
            echo $clave . " | " . $numero . "\n";
        }
    }

    //!
    function pasarNumerosPrimosAlFinal(&$listaDeNumeros){
        foreach($listaDeNumeros as $clave => $numero){
            if($numero % 1 == 0 && $numero % $numero == 0){
                $numeroPrimo = $numero;

                unset($listaDeNumeros[$clave]);
                array_push($listaDeNumeros, $numeroPrimo);
            }
        }
    }

?>