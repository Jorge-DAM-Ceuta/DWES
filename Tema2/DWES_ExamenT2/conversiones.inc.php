<?php

    function binarioADecimal(&$numero){
        $digitos = array();
        $longitud ="";
        $longitud .= $numero;
        $operacion = "";

        for($i = 0; $i<count($numero); $i++){
            array_push($digitos, $numero[$i]);
        }

        foreach($digitos as $numero){
            echo $numero . "\n";
        }
    }

    function decimalABinario(&$numero){
        $restos = array();
        $resto = $numero % 2;
        $resultado = $numero / 2;

        while(true){
            array_push($restos, $numero % 2);
            $resultado = $numero / 2;
            $numero = $resultado; 
        }

        
        for($i = 0; $i<count($resto); $i--){
            
        }
    }
?>