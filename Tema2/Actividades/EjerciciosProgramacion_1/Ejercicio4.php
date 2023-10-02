<?php

/* En este bloque PHP se declara una variable que contendrá un
valor en Euros para convertirla posteriormente a un valor en Dólares. */

$valorEnEuros = 100.50;

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 4</title>
    </head>
    <body>
        <!-- En este bloque se usa un párrafo para mostrar por pantalla
        el valor obtenido en Dólares multiplicando el valor por 1.0608. -->
        <p><?php echo $valorEnEuros . " euros son " . ($valorEnEuros * 1.0608) . " dólares."?></p>
    </body>
</html>