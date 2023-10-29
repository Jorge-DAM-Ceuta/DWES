<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 8</title>
    </head>
    <body>
        <h1>Pirámide de caracteres:</h1>

        <form name="form" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data" method="POST">

            <p>
                <label>Elige el caracter a pintar en la pirámide:</label>
                <input name="caracter" type="text">
            </p>
            
            <p>
                <label>Elige la altura de la pirámide:</label>
                <input name="altura" type="number">
            </p>

            <input name="generar" value="Generar" type="submit">
        </form>

        <?php
            /*En este código se recoge la altura y caracter de la pirámide que se ha 
            introducido en el formulario. Mediante un bucle que generará cada nivel de
            la pirámide se calculan los espacios en blanco que debe contener en cada vuelta.
            
            Mediante el primer bucle anidado se generan los espacios en blanco que hay que 
            generar antes de escribir el caracter. Para su correcto funcionamiento se deben
            pintar 2 espacios por cada vuelta. 
            
            El segundo bucle anidado imprime el número de caracteres necesarios comprobando el
            nivel de la pirámide actual que multiplicado por 2 menos 1 indica los caracteres que
            deben haber en el nivel.
            
            Por último se produce un salto de línea para pintar el siguiente nivel.*/
            if(isset($_POST['generar'])){
                $altura = $_POST['altura'];
                $caracter = $_POST['caracter'];

                for($i = 1; $i <= $altura; $i++){
                    $espacios = $altura - $i;

                    for($j = 0; $j <= $espacios; $j++){
                        echo "&nbsp&nbsp";
                    }

                    for($j = 1; $j <= 2 * $i - 1; $j++){
                        echo $caracter;
                    }

                    echo "<br>";
                }

            }
        ?>
    </body>
</html>