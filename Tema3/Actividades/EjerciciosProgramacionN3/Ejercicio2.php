<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 2</title>
    </head>
    <body>

        <h1>Generar tabla de números</h1>
        
        <form name="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <input type="submit" name="generar" value="Generar">
        </form>

        <?php
            if(isset($_POST['generar'])){
                $array = array();
                $numerosAleatorios = array();

                /*Añadir números aleatorios al array con dos bucles for. En el primero se generan 6 
                subarrays y en el segundo for se generan números aleatorios que no existan en el array 
                de números aleatorios y se añade al subarray de $array correspondiente en la vuelta */
                for($i = 0; $i < 6; $i++){
                
                    $array[$i] = array();
                    
                    for($j = 0; $j < 9; $j++){
                        
                        $numeroAleatorio = random_int(100, 999);

                        while(in_array($numeroAleatorio, $numerosAleatorios)){
                            $numeroAleatorio = random_int(100, 999);
                        }

                        array_push($array[$i], $numeroAleatorio);
                    }
                }

                /*Comparando cada número de los arrays con el valor máximo guardamos el mínimo 
                encontrado en la variable valorMinimo para pintarlo en azul. */
                $valorMinimo = 999;
                $posicionValorMinimo_Fila = 0;
                $posicionValorMinimo_Columna = 0;

                for($i = 0; $i < 6; $i++){
                    for($j = 0; $j < 9; $j++){
                        
                        if($array[$i][$j] < $valorMinimo){
                            $valorMinimo = $array[$i][$j];
                            $posicionValorMinimo_Fila = $i;
                            $posicionValorMinimo_Columna = $j;
                        }
                    }
                }

                /*Se crea una tabla y se recorre el array para mostrar sus números en las celdas, 
                si las iteraciones de fila y columna coinciden con la posición donde se encuentra 
                el número mínimo se pinta el número de azul mediante el atributo style color. */
                echo "<table border='1'>";

                for($i = 0; $i < 6; $i++){
                    echo "<tr>";
                
                    for($j = 0; $j < 9; $j++){
                        $numero = $array[$i][$j];

                        if($i == $posicionValorMinimo_Fila && $j == $posicionValorMinimo_Columna){
                            echo "<td style='color: blue;'>" . $numero . "</td>";
                        }else{
                            echo "<td style='color: black;'>" . $numero . "</td>";
                        }
                        
                    }

                    echo "</tr>";
                }

                echo "</table>";
            }
        ?>
        
    </body>
</html>