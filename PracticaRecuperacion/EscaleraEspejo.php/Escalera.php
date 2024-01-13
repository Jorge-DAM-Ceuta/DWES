<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Escalera espejo</title>
    </head>
    <body>
        <?php
            if(isset($_POST["generar"])){
                $numeroMaximo = $_POST["numero"];

                for($i = 1; $i<=$numeroMaximo; $i++){
                    
                    // Imprimir la escalera de números
                    for($j = 1; $j<=$i; $j++){
                        echo $j . " ";
                    }

                    // Imprimir espacios para separar la escalera y su reflejo
                    for ($espacios = 3 * ($numeroMaximo - $i); $espacios > 0; $espacios--) {
                        echo "&nbsp;&nbsp;";
                    }

                    // Imprimir el reflejo
                    for ($j = $i; $j >= 1; $j--) {
                        echo $j . " ";
                    }

                    echo "<br/>";
                }
            }
        ?>

        <h2>Introduce el número máximo de pisos para la escalera: </h2>
        
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <label>Número: <input type="number" name="numero"></label>

            <input type="submit" name="generar" value="Generar escalera">
        </form>
    </body>
</html>