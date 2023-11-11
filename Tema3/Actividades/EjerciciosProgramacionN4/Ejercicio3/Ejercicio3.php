<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 3</title>
    </head>
    <body>
        <h1>Numeros:</h1>

        <?php
            function generarNumeros() {
                $numeros = array();
                for ($i = 0; $i < 100; $i++) {
                    array_push($numeros, random_int(0, 20));
                }

                file_put_contents('./numeros.txt', implode(' ', $numeros));
            }
            
            function obtenerNumeros() {
                $contenido = file_get_contents('./numeros.txt');

                return explode(' ', $contenido);
            }
            
            if(!isset($_POST['enviar'])){
                generarNumeros();
            }

            $numeros = obtenerNumeros();
            echo "<p>Números: " . implode(" ", $numeros) . "</p>";
        ?>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <p>
                <label>Valor a sustituir:</label>
                <input type="number" name="primerValor" required>
            </p>
            
            <p>
                <label>Valor de reemplazo:</label>
                <input type="number" name="segundoValor" required>
            </p>

            <input type="submit" name="enviar" value="Cambiar">
        </form>

        <?php
            
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['enviar'])) {
                
                $primerValor = $_POST["primerValor"];
                $segundoValor = $_POST["segundoValor"];

                foreach ($numeros as &$numero) {
                    if ($numero == $primerValor) {
                        $numero = "<span style='color: red;'>$segundoValor</span>";
                    }
                }

                echo "<p>Números modificados: " . implode(" ", $numeros) . "</p>";
            }
        ?>

    </body>
</html>