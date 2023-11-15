<?php

    /*El operador Null Coalesce '??' se usa para proporcionar un valor predeterminado
    si la variable es null. Si no es null devuelve su valor, en caso de no ser null 
    devuelve el valor que hay después del operador.

    El operador Null Safe '?->' se usa para acceder a propiedades y métodos de un objeto
    aunque este sea null. Permite realizar operaciones sin producir errores si alguna parte
    es null.*/

    $rutaJSON = "./Inventario.json";
    $jsonString = file_get_contents($rutaJSON);
    $elementos = json_decode($jsonString, true);

    //Si la clave no existe o el contenido es null muestra 'Título no disponible'.
    $titulo = $elementos['inventario'][0]['titulo'] ?? 'Título no disponible';
    echo "<h2>Título: $titulo</h2>";
    
    //Intenta acceder a la variable aunque no exista o sea null.
    $precioPrimerElemento = $elementos?->inventario[0]?->precio ?? 'Precio no disponible';
    echo "<h2>Precio del primer elemento: $precioPrimerElemento</h2>";
?>