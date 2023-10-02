<?php

/* En este bloque PHP se declaran dos variables que contendrán un 
número entero en cada caso. */

$primerNumero = 144;
$segundoNumero = 999;

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 3</title>
    </head>
    <body>
        <!-- En este bloque se declaran 5 párrafos para mostrar distintas
        operaciones con las dos variables anteriores en cada uno de ellos.

        En el primer párrafo se muestra el valor de ambos números.
        En el segundo párrafo se muestra la suma de ambos.
        En el tercer párrafo se muestra la resta de ambos.
        En el cuarto párrafo se muestra la división de ambos.
        En el quinto párrafo se muestra la multiplicación de ambos. -->

        <p><?php echo "Valor del primer número: " . $primerNumero . "<br>Valor del segundo número: " . $segundoNumero?></p>
        <p><?php echo "La suma de ambos es: " . ($primerNumero + $segundoNumero) ?></p>
        <p><?php echo "La resta de ambos es: " . ($primerNumero - $segundoNumero) ?></p>
        <p><?php echo "La división de ambos es: " . ($primerNumero / $segundoNumero) ?></p>
        <p><?php echo "La multiplicación de ambos es: " . ($primerNumero * $segundoNumero) ?></p>
    </body>
</html>