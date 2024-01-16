<?php

    /*Esta función obtiene el texto del formulario por parámetros
    y trabaja con él para obtener la media de longitud de las palabras.*/
    function esNumeroFeliz($numeros){
        //Pasamos todos los números a un array.
        $arrayNumeros = explode(", ", $numeros);
        $informacionNumeros = array();

        //Obtenemos el número actual del array.
        foreach($arrayNumeros as $numero){
            //Usamos otro array para saber los dígitos del número.
            $digitosNumeroActual = array();
            $resultado = 0;

            //Si el número actual tiene más de un digito:
            if(strlen($numero) > 1 && $numero != -1){

                //Guardamos cada dígito en una posición del array de dígitos.
                for($i = 0; $i<strlen($numero); $i++){
                    array_push($digitosNumeroActual, $numero[$i]);
                }

                //Ahora se recorre cada dígito y se eleva al cuadrado, sumando el 
                //valor obtenido a la variable resultado.
                for($i = 0; $i=$numero; $i++){
                    foreach($digitosNumeroActual as $digito){
                        $resultado .= pow($digito, 2);
                    }

                    if($resultado == 1){
                        array_push($informacionNumeros, "$numero => 'Es feliz'");
                    }
                }
                if($resultado != 1){
                    $digitosNumeroActual = array();

                    //Guardamos cada dígito en una posición del array de dígitos.
                    for($i = 0; $i<strlen($resultado); $i++){
                        array_push($digitosNumeroActual, $resultado[$i]);
                    }
                }
                
                echo "Números felices e infelices: " . var_dump($digitosNumeroActual);
            }
        }
    }
?>