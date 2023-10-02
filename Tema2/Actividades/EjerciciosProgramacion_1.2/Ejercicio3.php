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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 3 v2</title>
    </head>
    <body>

        <!-- En esta variación del ejercicio 3 usaremos un bucle for que 
        tendrá el mismo objetivo, mostrar sus valores y las 4 operaciones
        correspondientes. En este caso mediante un bucle for, en cada vuelta 
        se da un caso en los condicionales, en los que cada uno realizará 
        una función y la imprimirá por pantalla. -->
        
        <?php
            for($i = 0; $i<=4; $i++){
                if($i == 0){
                    echo "<p>El valor número uno es: " . $primerNumero . " y el valor número dos es: " . $segundoNumero . "</p>";
                }else if($i == 1){
                    echo "<p>La suma de ambos números es: " . $primerNumero + $segundoNumero . "</p>";
                }else if($i == 2){
                    echo "<p>La resta de ambos números es: " . $primerNumero - $segundoNumero . "</p>";
                }else if($i == 3){
                    echo "<p>La multiplicación de ambos números es: " . $primerNumero * $segundoNumero . "</p>";
                }else{
                    echo "<p>La división de ambos números es: " . $primerNumero / $segundoNumero . "</p>";
                }
            
            }
        ?>
    </body>
</html>
