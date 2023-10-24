<?php

    /*
        password_algos(): Devuelve un array con el ID de cada cifrado de contraseñas disponible.

        Los valores devueltos son: 
            1. 2y 
            2. argon2i
            3. argon2id
    */

    $algoritmos = password_algos();
    
    foreach($algoritmos as $clave => $valor){
        print "Clave: " . $clave . ", Valor: " . $valor . "<br>";
    }

?>