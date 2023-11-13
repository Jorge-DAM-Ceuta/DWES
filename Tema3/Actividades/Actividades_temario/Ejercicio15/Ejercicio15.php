<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 15</title>
    </head>
    <body>

        <?php
            

            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['calcular'])) {
              
                $rutaJSON = "./Notas.json";
                $jsonString = file_get_contents($rutaJSON);
                $alumnos = json_decode($jsonString, true);

                foreach($alumnos as $nombre => $notas){
                    echo "<p>Notas de $nombre: $notas</p>";

                    $sumaNotas += explode(", ", $notas);
                    $media = $sumaNotas / 5;

                    echo "<p>Media de notas de $nombre: $media</p>";
                    
                }

            /*
                $jsonString = json_encode($notas, JSON_PRETTY_PRINT);
                $fichero = fopen($rutaJSON, 'w');
                fwrite($fichero, $jsonString);
                fclose($fichero);
            */
        }
        ?>

        <form name="calcularMedia" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            


            <input type="submit" name="calcular" value="Calcular">
        </form>

        <form name="addAlumn" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            
            <input type="submit" name="add" value="Add">
        </form>
    </body>
</html>