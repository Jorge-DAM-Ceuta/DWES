<?php

/* En este bloque PHP se declara una variable que contendrá un
valor en Euros para convertirla posteriormente a un valor en Dólares. */

$valorEnEuros = 100.50;

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 4 v2</title>
    </head>
    <body>
        
        <!-- En este bloque se comprueba que la variable contenga un número
        válido, si es así se usa un párrafo para mostrar por pantalla
        el valor en Dólares multiplicando el valor de Euros por 1.0608. -->

        <?php 
            if(is_int($valorEnEuros) || is_double($valorEnEuros) || is_float($valorEnEuros)){
                echo "<p>" . $valorEnEuros . " euros son " . ($valorEnEuros * 1.0608) . " dólares.</p>";
            }
        ?>
    </body>
</html>