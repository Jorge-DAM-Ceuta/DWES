<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 9</title>
    </head>
    <body>
        <h1>Pirámide hueca</h1>

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
            /*En este código se añaden tres comprobaciones en el bucle que pinta los
            caracteres, la primera comprueba que es el caracter del primer nivel, la 
            segunda comprueba si es el último caracter del nivel y la tercera indica
            que si estamos en la última vuelta del bucle principal se pinten todos 
            los caracteres. */
            if(isset($_POST['generar'])){
                $altura = $_POST['altura'];
                $caracter = $_POST['caracter'];

                for($i = 1; $i <= $altura; $i++){
                    $espacios = $altura - $i;

                    for($j = 0; $j <= $espacios; $j++){
                        echo "&nbsp&nbsp";
                    }

                    for($j = 1; $j <= 2 * $i - 1; $j++){
                        if($j == 1 || $j == 2 * $i - 1 || $i == $altura){
                            echo $caracter;
                        }else{
                            echo "&nbsp&nbsp";
                        }
                        
                    }

                    echo "<br>";
                }

            }
        ?>
    </body>
</html>