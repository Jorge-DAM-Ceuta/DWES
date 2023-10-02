<?php

/* En este bloque PHP se usa una variable para almacenar el caracter ASCII del espacio 
en blanco para formar cada nivel de la pirámide de asteriscos mediante cuatro variables 
que almacenan los espacios y asteriscos necesarios. Una vez se ha conseguido realizar la 
relación entre espacios, asteriscos y niveles mediante las variables se almacenan en un array. */

$espacio = "&nbsp";

$nivelUno = $espacio . $espacio . $espacio . $espacio . $espacio . $espacio . $espacio . $espacio . $espacio . $espacio . $espacio . "*";  
$nivelDos =  $espacio . $espacio . $espacio . $espacio . $espacio . $espacio . $espacio . $espacio . $espacio . "*" . $espacio . $espacio . "*";
$nivelTres = $espacio . $espacio . $espacio . $espacio . $espacio . $espacio . "*" . $espacio . $espacio . $espacio . "*" . $espacio . $espacio . $espacio . "*";
$nivelCuatro = $espacio . $espacio . $espacio . "*" . $espacio . $espacio . $espacio . $espacio . $espacio . $espacio . "*" . $espacio . $espacio . $espacio . $espacio . $espacio . $espacio . "*";

$piramide = [$nivelUno, $nivelDos, $nivelTres, $nivelCuatro];
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 5 v2</title>
    </head>
    <body>

        <!-- Mediante un bucle foreach se consigue recorrer el array que contiene los 
        niveles de la pirámide, para escribirlos en un párrafo uno a uno en cada vuelta. -->
        <?php
            foreach($piramide as $nivel){
                echo "<p>" . $nivel . "</p>";
            }
        ?>
    </body>
</html>