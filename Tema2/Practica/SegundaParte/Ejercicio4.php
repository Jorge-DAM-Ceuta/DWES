<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 4</title>
    </head>
    <body>
        <?php

            /*Se usa la include_once para llamar a la función deseada a la
            que se le pasará por parámetros un array de nombres. */
            include_once "./Funciones.inc.php";
            
            $nombres = array("Jorge Muñoz", "Iván Núnez", "Alfredo Pérez", "Julio Ximenez", "Javier Almenta");

            listarArrayOrdenado($nombres);
        ?>
    </body>
</html>