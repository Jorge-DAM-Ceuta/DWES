<?php

//NÚMEROS DECIMALES
    function decimal_Binario($decimal){
        $resultado = 0;
        $posicion = 1;

        while($decimal > 0){
            $resto = $decimal % 2;
            $resultado = $resultado + $resto * $posicion;
            $decimal = (int)$decimal / 2;
            $posicion = $posicion * 10;
        }

        return $resultado;
    }

    function decimal_Octal($decimal){
        $resultado = 0;
        $posicion = 1;

        while ($decimal > 0) {
            $resto = $decimal % 8;
            $resultado = $resultado + $resto * $posicion;
            $decimal = (int)$decimal / 8;
            $posicion = $posicion * 10;
        }

        return $resultado;
    }

    function decimal_Hexadecimal($decimal){
        $resultado = 0;
        $posicion = 1;

        while($decimal > 0){
            $resto = $decimal % 16;
            $resultado += $resto * $posicion;
            $decimal = $decimal / 16;
            $posicion *= 10;
        }

        return $resultado;
    }

    function decimal_Romano($decimal){
        $numerosRomanos = array(
            "M" => 1000,
            "CM" => 900,
            "D" => 500,
            "CD" => 400,
            "C" => 100,
            "XC" => 90,
            "L" => 50,
            "XL" => 40,
            "X" => 10,
            "IX" => 9,
            "V" => 5,
            "IV" => 4,
            "I" => 1
        );

        $resultado = "";

        foreach($numerosRomanos as $letra => $valor){
            while($decimal >= $valor){
                $resultado .= $letra;
                $decimal -= $valor;
            }
        }

        return $resultado;
    }

//NÚMEROS BINARIOS
    function binario_Decimal($binario){
        $resultado = 0;

        for($i = 0; $i < srtlen($binario); $i++){
            $resultado += $resultado * 2 + $binario[$i];
        }

        return $resultado;
    }

//NÚMEROS OCTALES
    function octal_Decimal($octal){
        $resultado = 0;
        $base = 1;
        
        while($octal > 0){
            $ultimoNumero = $octal % 10;
            $resultado += $ultimoNumero * $base;
            $octal = $octal / 10;
            $base *= 8;
        }

        return $resultado;
    }

//NÚMEROS HEXADECIMALES
    function hexadecimal_Decimal($hexadecimal){
        $resultado = 0;

        for($i = 0; $i < strlen($hexadecimal); $i++){
            $numero = $hexadecimal[$i];

            if($numero >= '0' && $numero <= '9'){
                $valor = $numero;
            }else if($numero >= 'A' && $numero <= 'F'){
                $valor = $numero - 'A' + 10;
            }else{
                $valor = 0;
            }

            $resultado = $resultado * 16 + $valor;
        }

        return $resultado;
    }

//NÚMEROS ROMANOS
    function romano_Decimal($romano){
        $numerosRomanos = [
            "M"  => 1000,
            "D"  => 500,
            "C"  => 100,
            "L"  => 50,
            "X"  => 10,
            "V"  => 5,
            "I"  => 1
        ];

        $resultado = 0;

        for ($i = strlen($romano) - 1; $i >= 0; $i--) {
            $valor = $numerosRomanos[$romano[$i]];
            
            if ($i > 0 && $numerosRomanos[$romano[$i - 1]] < $valor) {
                $resultado -= $valor;
            } else {
                $resultado += $valor;
            }    
        }

        return $resultado;
    }

?>