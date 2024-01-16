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
            $numerosIntroducidos = "";

            //Si el método de envío de formulario es POST y el input submit está seteado:
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['analizar'])){
                $numeroActual = $_POST['numero'];

                //Se comprueba si el input hidden tiene algún valor y se obtiene, 
                //en caso contrario la variable será una cadena vacía. 
                $numerosIntroducidos = isset($_POST['numeros']) ? $_POST['numeros'] : "";

                //Si la variable no está vacía se le añade una coma y el siguiente número,
                //en caso de que esté vacía se añade el únicamente el número como el primero.
                $numerosIntroducidos .= $numerosIntroducidos != "" ? ", $numeroActual" : $numeroActual;

                //Si se introduce el valor -1 se muestra cuáles números son felices o no.
                if(str_contains($numerosIntroducidos, "-1")){
                    esNumeroFeliz($numerosIntroducidos);
                }
            }
        ?>

        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <input type="number" name="numero">
            <input type="hidden" name="numeros" value="<?php echo $numerosIntroducidos?>">
            <input type="submit" name="analizar">
        </form>
    </body>
</html>