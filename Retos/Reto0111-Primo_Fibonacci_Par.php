<?php 

    $numero = 7;
    $resultado = "";
    
    function esFibonacci($numero, $resultado){
        
        $num1 = 0;
        $num2 = 1;

        while ($num2 < $numero) {
            $num3 = $num2;
            $num2 += $num1;
            $num1 = $num3;
        }

        if($num2 == $numero){
            $resultado .= "es fibonacci, ";
        }else{
            $resultado .= "no es fibonacci, ";
        }

        return $resultado;
    }

    function esPar($numero, $resultado){
        if($numero % 2 == 0){
            $resultado .= "y es par.";
        }else{
            $resultado .= "y es impar.";
        }

        return $resultado;
    }

    function esPrimo($numero, $resultado) {
        $comp = true;

        if ($numero < 2) {
            $comp = false;
        }

        for ($i = 2; $i <= sqrt($numero); $i++) {
            if (($numero % $i) == 0) {
                $comp = true;
            }
        }

        if($comp == true){
            $resultado = "es primo, ";
        }else{
            $resultado = "no es primo, ";
        }
        
        return $resultado;
    }

    echo $resultado = "El número $numero " . esPar($numero, esFibonacci($numero, esPrimo($numero, $resultado)));

?>