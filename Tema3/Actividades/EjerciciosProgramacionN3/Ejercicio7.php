<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 7</title>
    </head>
    <body>
        <h1>Secuencia Fibonacci</h1>

        <form name="form" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data" method="POST">

            <p>
                <label>Elige la cantidad de dígitos a mostrar de la secuencia Fibonacci:</label>
                <input name="numero" type="number">
            </p>

            <input name="generar" value="Generar" type="submit">
        </form>

        <?php
            /*En este código se recoge el número introducido en el formulario y se crea un array que
            contendrá los primeros dos dígitos de la secuencia Fibonacci para calcular posteriormente 
            la secuencia en un bucle for que empiece a rellenar a partir de la posición 2 del array. Los
            números que se añadirán se calculan sumando el último último número del array con el anterior. */
            if(isset($_POST['generar'])){
                $numero = $_POST['numero'];

                $fibonacci = array(0, 1);

                for($i = 2; $i < $numero; $i++){
                    $fibonacci[$i] = $fibonacci[$i-1] + $fibonacci[$i-2];
                }

                echo "<p>Los primeros" .  $numero . "digitos de la secuencia Fibonacci son:</p>";
                echo implode(", ", $fibonacci);
            }
        ?>

    </body>
</html>