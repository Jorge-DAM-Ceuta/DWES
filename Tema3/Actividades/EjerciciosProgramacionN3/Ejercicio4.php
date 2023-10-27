<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 4</title>
    </head>
    <body>
        
        <form name="input" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <p>
                <label name="inputFilas">Número de filas:</label>
                <input name="filas" id="filas" type="number">
            </p>
            
            <p>
                <label name="inputColumnas">Número de columnas:</label>
                <input name="columnas" id="columnas" type="number">
            </p>
            
            <p>
                <input name="enviar" value="Generar tabla" type="submit">
            </p>
        </form>

        <?php
            if (isset($_POST["enviar"])) {
                $filas = $_POST["filas"];
                $columnas = $_POST["columnas"];
                
                /*Mediante un número de filas y columnas obtenidas del formulario se crea una 
                tabla con valores obtenidos de sumar la fila con la columna en cada celda.
                
                El primer bucle recorre las filas y crea una fila HTML, seguido en el segundo
                bucle for se crea un número por cada columna de la fila y lo pinta de rojo si
                es múltiplo de 3, en caso contrario aparecerán en color negro, esto se aplica
                mediante el atributo style color dentro de la celda en concreto. */
                
                if ($filas > 0 && $columnas > 0) {
                    echo "<table border='1'>";

                    for ($i = 1; $i <= $filas; $i++) {
                        echo "<tr>";
                        
                        for ($j = 1; $j <= $columnas; $j++) {
                            $numero = $i + $j;
                            
                            if ($numero % 3 == 0){
                                echo "<td style='color: red;'>" . $numero . "</td>";
                            }else{
                                echo "<td style='color: black;'>" . $numero . "</td>";
                            }

                            
                        }

                        echo "</tr>";
                    }

                    echo "</table>";
                
                }
            }
        ?>
    </body>
</html>