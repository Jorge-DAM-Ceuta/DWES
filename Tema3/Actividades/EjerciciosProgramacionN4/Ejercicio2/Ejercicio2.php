<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 2</title>
    </head>
    <body>
        <h2>Temperatura media de cada mes:</h2>
        
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            
            <?php
                $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

                for ($i = 0; $i < count($meses); $i++) {
                    echo "<p>
                            <label>$meses[$i]:</label>
                            <input type='number' name='temperaturas[]' required>
                        </p>";
                }
            ?>

            <input type="submit" name="enviar" value="Generar">
        </form>

        <?php
            /*En este código se introducen las temperaturas medias de cada mes en sus 
            respectivos input, sus valores se recogen como un array y se muestran junto 
            al mes debajo de cada imagen de la barra horizontal que obtiene el ancho 
            mediante el valor de la temperatura media*/

            if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['enviar'])) {
                $temperaturas = $_POST["temperaturas"];

                echo "<h2>Diagrama de Barras:</h2>";

                for ($i = 0; $i < count($meses); $i++) {
                    echo "<figure>
                            <img src='./Imagenes/barra.png' width='$temperaturas[$i]'>
                            <figcaption>$meses[$i] $temperaturas[$i]°C</figcaption>
                        </figure>";
                }
               
            }
        ?>
    </body>
</html>