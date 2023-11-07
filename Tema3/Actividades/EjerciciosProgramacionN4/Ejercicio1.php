<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 1</title>
    </head>
    <body>
        <h1>Control de acceso: Caja fuerte</h1>

        <form name="form" id="form" action="<?php echo $_SERVER['PHP_SELF']; ?>">

            <p>
                <label for="combinacion">Prueba una combinación: </label>
                <input type="number" name="combinacion" id="combinacion">
            </p>

            <?php
                if (!empty($combinacion)) {
                    foreach($combinacion as $valor){
                        echo "<input type='hidden' name='combinaciones[]' value='" . $combinaciones . "'>";
                    }
                }
                echo "<input type='hidden' name='combinacion' value='" . $combinacion . "'>";
            ?>

            <p>
                <input type="submit" name="enviar" id="enviar" value="Probar combinación">
            </p>
        </form>

        <?php
            $combinacionCorrecta = 2345;
            $intentos = 4;

            if(isset($_POST['enviar'])){
                $combinaciones = isset($_POST['combinaciones']) ? $_POST['numeros'] : array();
                array_push($numeros, $_POST['numero']);
                
                if($combinacion == $combinacionCorrecta){
                    echo "<h2>Combinación correcta!</h2>";
                }else if($combinacion != $combinacionCorrecta && $intentos > 0){
                    $intentos--;
                    echo "<h3>Combinación incorrecta, prueba otra. Quedan " . $intentos . " intentos.</h3>";
                }else if($intentos <= 0){
                    echo "<h3>Combinación incorrecta, prueba otra. Quedan " . $intentos . " intentos.</h3>";
                }
            }
        ?>
    </body>
</html>