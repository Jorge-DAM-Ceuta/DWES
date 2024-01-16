<?php

    /*Esta función obtiene el texto del formulario por parámetros
    y muestra el total de palabras por pantalla.*/
    function contarPalabras($texto){
        //Convertimos el texto a array.
        $arrayTexto = explode(" ", $texto);

        //Usamos count para saber el número de elementos del array.
        echo "<h2>El texto tiene " . count($arrayTexto) . " palabras.</h2>";
    }

    /*Esta función obtiene el texto del formulario por parámetros
    y trabaja con él para obtener la media de longitud de las palabras.*/
    function longitudMediaPalabras($texto){
        //Convertimos el texto a array.
        $arrayTexto = explode(" ", $texto);
        $longitudPalabras = array();
        $longitudTotal = 0;
        $mediaLongitud = 0;

        //Se recorre el array palabra a palabra y se almacena la
        //longitud de la palabra obtenida con strlen() en otro array.
        foreach($arrayTexto as $palabra){
            array_push($longitudPalabras, strlen($palabra));
        }

        //Se recorre el array de longitudes para obtener la suma de las longitudes.
        foreach($longitudPalabras as $longitudActual){
            $longitudTotal += $longitudActual;
        }

        //Obtenemos la media de entre el total de las longitudes y el total de palabras.
        $mediaLongitud = $longitudTotal / count($longitudPalabras);

        echo "<h2>La longitud media de las palabras es de $mediaLongitud.</h2>";
    }

    /*Esta función obtiene el texto del formulario por parámetros
    y trabaja con él para obtener la cantidad de oraciones que tiene.*/
    function numeroOracionesTexto($texto){
        //Convertimos el texto a array.
        $arrayTexto = explode(" ", $texto);
        $numeroOraciones = 1;

        //Se recorre el array palabra a palabra y si en la palabra se
        //encuentra un "." se suma uno al número de oraciones.
        foreach($arrayTexto as $palabra){
            if(str_contains($palabra, ".")){
                $numeroOraciones++;
            }
        }

        echo "<h2>El texto contiene $numeroOraciones oraciones.</h2>";
    }

    /*Esta función obtiene el texto del formulario por parámetros
    y trabaja con él para obtener la palabra más larga.*/
    function palabraMasLarga($texto){
        //Convertimos el texto a array.
        $arrayTexto = explode(" ", $texto);
        $palabraMasLarga = "";

        //Se recorre el array palabra a palabra y si la longitud de la palabra
        //obtenida con strlen es mayor a la longitud de la variable que almacena
        //la palabra más larga, se sustituye su valor.
        foreach($arrayTexto as $palabra){
            if(strlen($palabra) > strlen($palabraMasLarga)){
                $palabraMasLarga = $palabra;
            }
        }

        echo "<h2>La palabra más larga en el texto es: '$palabraMasLarga'.</h2>";
    }

    //
    function comprobarHeterograma($texto){
        //Convertimos el texto a array.
        $arrayTexto = explode(" ", $texto);

        //Obtenemos el número de cada ocurrencia en el array.
        $numeroOcurrencias = array_count_values($arrayTexto);

        foreach($numeroOcurrencias as $ocurrencia => $valor){
            if($valor > 1){
                echo "<h2></h2>";
            }
        }
    }

?>