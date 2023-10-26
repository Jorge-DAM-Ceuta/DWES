<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 5</title>
    </head>
    <body>
        <?php
            $imagenes = scandir("./imagenes");

            $contador = 0;

            echo "<table border='1'><tr>";

            foreach($imagenes as $imagen){
                $extension = pathinfo($imagen, PATHINFO_EXTENSION);

                if($extension == "png" || $extension == "jpg" || $extension == "jpeg" || $extension == "gif"){
                    echo "<td><img src='./imagenes/" . $imagen . "' width='100%' height='100%'></td>";
                    $contador++;
                }

                if($contador == 4){
                    break;
                }
            }

            echo "</tr></table>";
        ?>
    </body>
</html>