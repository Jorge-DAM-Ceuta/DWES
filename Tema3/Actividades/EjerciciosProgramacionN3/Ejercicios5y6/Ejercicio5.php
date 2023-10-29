<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 5</title>
    </head>
    <body>

        <h1>Mostrar imágenes</h1>

        <form name="form" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
            <input name="generar" value="Generar" type="submit">
        </form>
        
        <?php
            if(isset($_POST['generar'])){
    
                /*En este código se escanea la estructura y archivos del directorio ./imagenes 
                mediante scandir(), esta información se guarda como un array en $imagenes. Usamos
                un contador para dar la condición de parada en el bucle foreach que recorrerá cada
                elemento del array anteriormente creado e inicializado con los nombres de los ficheros. */
                $imagenes = scandir("./imagenes");

                $contador = 0;

                /*Se pinta una tabla que tendrá una fila y cuatro columnas, dentro del for se comprueba
                que el elemento del array contenga una extensión permitida usando pathinfo() de la posición 
                correspondiente del array y como segundo parámetro PATHINFO_EXTENSION que devolverá la extensión 
                de cada elemento. Si contiene alguna de las extensiones se pinta una fila HTML y en otro bucle for
                anidado se crean 4 columnas en su interior iterando a partir del valor de $i, la condición de parada 
                es un contador que empieza en 0 en cada vuelta del primer for y que debe llegar hasta 3 para pintar 4 
                imagenes en la fila. Al terminar de pintar las 4 filas se suma a $i el valor de $contador para que 
                continúe iterando desde la última foto mostrada. Por último se cierra la etiqueta de la fila y se sigue 
                en el primer bucle. */
                echo "<table border='1'>";

                for($i = 0; $i < count($imagenes); $i++){
                    $extension = pathinfo($imagenes[$i], PATHINFO_EXTENSION);
                    $contador = 0;

                    if($extension == "png" || $extension == "jpg" || $extension == "jpeg" || $extension == "gif"){
                        
                        echo "<tr>";

                        for($j = $i; $contador < 4; $j++){
                            if($j == count($imagenes) - 1){
                                echo "<td><img src='./imagenes/" . $imagenes[$j] . "' width='100%' height='100%'></td>";
                                break;    
                            }else{
                                echo "<td><img src='./imagenes/" . $imagenes[$j] . "' width='100%' height='100%'></td>";
                                $contador++;
                            }
                            
                        }

                        $i += $contador;

                        echo "</tr>";
                    }
                }
                
                echo "</table>";
            }
        ?>
    </body>
</html>