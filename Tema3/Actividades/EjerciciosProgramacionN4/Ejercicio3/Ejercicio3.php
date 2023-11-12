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
            /*En este código los números aleatorios se generan y se almacenan en un
            fichero de texto para evitar que al pulsar el submit se generen de nuevo.*/        

            /*Con esta funcion se generan los números aleatorios 
            y se almacenan en un fichero de texto*/
            function generarNumeros() {
                $numeros = array();
                for ($i = 0; $i < 100; $i++) {
                    array_push($numeros, random_int(0, 20));
                }

                file_put_contents('./numeros.txt', implode(' ', $numeros));
            }
            
            /*Esta función obtiene los números del fichero y los devuelve*/
            function obtenerNumeros() {
                $contenido = file_get_contents('./numeros.txt');

                return explode(' ', $contenido);
            }
            
            /*Se ejecuta antes de que se pulse el submit y muestra los números en 
            un párrafo separados por espacios en blanco.*/
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
            /*Mediante los input se le indica el valor que se va a sustituir y por el
            número que se sustituirá. Se usa un foreach para obtener cada número. 
            En caso de que el número sea igual al valor que se va a sustituir se intercambia
            por el número sustituto y se le aplica un color rojo mediante una etiqueta span.
            
            Por último se muestran los números separado por espacios de nuevo.*/
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