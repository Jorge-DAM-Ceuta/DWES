<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 6</title>
    </head>
    <body>
        
        <h1>Subir/Mostrar imágenes</h1>

        <form name="form" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data" method="POST">

            <p>
                <label>Subir imagen:</label>
                <input name="imagen" type="file">
                <input name="subir" value="Subir" type="submit">
            </p>

            <input name="generar" value="Generar" type="submit">
        </form>
        
        <?php
            if(isset($_POST['subir'])){
                $errores = "";

                $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                $extensionesPermitidas = array('png', 'jpg', 'jpeg', 'gif');

                if(!in_array($extension, $extensionesPermitidas)){
                    $errores .= "- La imagen debe ser de la extensión .png, .jpg, .jpeg o .gif ";
                }

                if($_FILES['imagen']['size'] >= 10097152){ 
                    $errores .= "- La imagen debe tener un tamaño menor a 10MB.";
                }

                if(empty($errores)){
                    $path = "./imagenes/". basename($_FILES['imagen']['name']); 

                    if(move_uploaded_file($_FILES['imagen']['tmp_name'], $path)) {
                        echo "El archivo ".  basename( $_FILES['imagen']['name']). " ha sido subido";
                    } else{
                        echo "El archivo no se ha subido correctamente";
                    }
                }else{
                    echo $errores;
                }
            }

            /*En este código se escanea la estructura y archivos del directorio ./imagenes 
            mediante scandir(), esta información se guarda como un array en $imagenes. Usamos
            un contador para dar la condición de parada en el bucle foreach que recorrerá cada
            elemento del array anteriormente creado e inicializado con los nombres de los ficheros. */    
            if(isset($_POST['generar'])){
    
                $imagenes = scandir("./imagenes");

                $contador = 0;

                /*Se pinta una tabla que tendrá una fila y cuatro columnas, dentro del for se comprueba
                que el elemento del array contenga una extensión permitida usando pathinfo() de la posición 
                correspondiente del array y como segundo parámetro PATHINFO_EXTENSION que devolverá la extensión 
                de cada elemento. Si contiene alguna de las extensiones se pinta una fila HTML y en otro bucle for
                anidado se crean 4 filas en su interior iterando con el valor de $i, la condición de parada es un 
                contador que empieza en 0 en cada vuelta del primer for y que debe llegar hasta 3 para pintar 4 
                columnas. Al terminar de pintar las 4 filas se suma a $i el valor de $contador para que continúe 
                iterando desde la última foto mostrada. Por último se cierra la etiqueta de la fila y se sigue en
                el primer bucle. */
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

                        /*if($i >= count($imagenes) -1){
                            break;
                        }*/


                        echo "</tr>";
                    }
                }
                
                echo "</table>";
            }
        ?>
    </body>
</html>