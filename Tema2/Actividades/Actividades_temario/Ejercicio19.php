<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 19</title>
    </head>
    <body>
        <?php
            echo "<table>";

            while(current($_SERVER)){
                echo "<tr><td>" . key($_SERVER) . "</td><td>" . current($_SERVER) . "</td></tr>";
                next($_SERVER);
            }

            echo "</table>"
        ?>
    </body>
</html>