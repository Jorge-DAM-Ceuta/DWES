<?php
    
    /*En este código se usa un campo hidden donde guardar los números que se introducen en
    el campo 'numero', cuando entra al if no mostrará información hasta que el número 
    introducido sea negativo. Se usa un array para obtener los valores que hay en el input
    hidden y luego mediante un foreach se producen las comprobaciones para realizar las 
    estadísticas si el número obtenido es mayor que 0. Luego se realiza la media de los 
    números impares y mediante otro foreach se comprueba si hay un número negativo para 
    mostrar los datos obtenidos de las operaciones y setear de nuevo el array de números. */
    $totalImpares = 0;
    $numeroParMayor = 0;

    if(isset($_POST['guardar'])){
        $numeros = isset($_POST['numeros']) ? $_POST['numeros'] : array();
        array_push($numeros, $_POST['numero']);

        $cantidadNumeros = count($numeros)-1;
        
        foreach($numeros as $numero){
            if($numero >= 0){
                if($numero % 2 == 1){
                    $totalImpares += $numero;
                    
                }else if($numero % 2 == 0){
                    if($numero > $numeroParMayor){
                        $numeroParMayor = $numero;
                    }
                }
            }
        }
            
        if($cantidadNumeros > 0){
            $mediaImpares = $totalImpares / $cantidadNumeros;
        }else{
            $mediaImpares = 0;
        }
        
        foreach($numeros as $numero){
            if($numero < 0){
                echo "<p>Se han introducido " . $cantidadNumeros . " números.</p>";
                echo "<p>La media de los números impares introducidos es: " . $mediaImpares . "</p>";
                echo "<p>El número par mayor es: " . $numeroParMayor . "</p>";
                $numeros = array();
                break;                
            }
        }
            
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 10</title>
    </head>
    <body>
        <h1>Números</h1>

        <form name="form" action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data" method="POST">
            <p>
                <label>Introduce números, para finalizar escribe un número negativo</label>
                <input name="numero" type="number">

                <?php
                    if (!empty($numeros)) {
                        foreach($numeros as $numero){
                            echo "<input type='hidden' name='numeros[]' value='" . $numero . "'>";
                        }
                    }
                    
                ?>
                <input name="guardar" value="Guardar número" type="submit">
            </p>
        </form>

    </body>
</html>