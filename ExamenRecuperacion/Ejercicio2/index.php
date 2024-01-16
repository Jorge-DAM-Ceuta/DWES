<?php

    //Incluimos el fichero que contiene las funciones necesarias.
    include_once("./src/funciones.inc.php");

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 2</title>
    </head>
    <body>
        <?php
            //Si el método de envío de formulario es POST y el input submit está seteado:
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['analizar'])){
                //Recogemos el texto del input text.
                $texto = $_POST["texto"];

                //Para contar las palabras en el texto.
                contarPalabras($texto);

                //Media de longitud de las palabras del texto.
                longitudMediaPalabras($texto); 

                //Número de oraciones en el texto.
                numeroOracionesTexto($texto);

                //Encuentra la palabra más larga.
                palabraMasLarga($texto);
            }
        ?>

        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <input type="text" name="texto">
            <input type="submit" name="analizar">
        </form>
    </body>
</html>