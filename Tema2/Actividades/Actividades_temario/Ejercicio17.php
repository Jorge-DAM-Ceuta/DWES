<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 17</title>
    </head>
    <body>

        <?php
            
            echo "<table border='2'>";

            foreach($_SERVER as $clave => $valor){
    
                echo "<tr><td align='center'>{$clave}</td><td align='center'>{$valor}</td></tr>";
            }
            
            echo "</table>";
        ?>
    </body>
</html>