<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 1</title>
    </head>
    <body>
        <h1>Control de acceso: Caja fuerte</h1>

        <form name="form" id="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

            <?php
                if (!empty($combinaciones)) {
                    foreach($combinaciones as $valor){
                        echo "<input type='hidden' name='combinaciones[]' value='" . $valor . "'>";
                    }
                }
            ?>
            
            <p>
                <label for="combinacion">Prueba una combinación: </label>
                <input type="number" name="combinacion" id="combinacion">
            </p>

            <p>
                <input type="submit" name="enviar" id="enviar" value="Probar combinación">
            </p>
        </form>

        <?php
            $combinacionCorrecta = 2345;

            $intentos = file_get_contents("./intentos.txt");

            if($intentos <= 1){
                file_put_contents("./intentos.txt", 4);
            }
            
            if(isset($_POST['enviar'])){
                $combinaciones = isset($_POST['combinaciones']) ? $_POST['combinaciones'] : array();
                array_push($combinaciones, $_POST['combinacion']);
                
                if($intentos >= 1 && $intentos <= 4){
                    if($_POST['combinacion'] == $combinacionCorrecta){
                        echo "<h2>Combinación correcta! La caja fuerte se ha abierto</h2>";
                        file_put_contents("./intentos.txt", 4);
                    }else{
                        echo "<p>La combinación no es correcta: Te quedan " . ($intentos - 1) . " intentos.</p>";
                        file_put_contents("./intentos.txt", $intentos - 1);

                        if($intentos <= 1){
                            echo "<p>Has agotado todos los intentos. La caja sigue cerrada.</p>";
                        }
                    }
                }
            }
        ?>
    </body>
</html>