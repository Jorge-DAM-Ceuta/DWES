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
        
                if ($filas > 0 && $columnas > 0) {
                    echo "<table border='1'>";

                    for ($i = 1; $i <= $filas; $i++) {
                        echo "<tr>";
                        
                        for ($j = 1; $j <= $columnas; $j++) {
                            $numero = $i + $j;
                            
                            if ($numero % 3 == 0){
                                $estilo = "color: red;";
                            
                            }else{
                                $estilo = "color: black;";    
                            }

                            echo "<td style='". $estilo . "'>" . $numero . "</td>";
                        }

                        echo "</tr>";
                    }

                    echo "</table>";
                
                }
            }
        ?>
    </body>
</html>