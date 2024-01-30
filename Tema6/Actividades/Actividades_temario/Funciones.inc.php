<?php 
    //Comprobamos la conexión
    function comprobarConexion($dwes){    
        $numeroError = $dwes->connect_errno;
        $mensajeError = $dwes->connect_error;

        $errores = array(
            $numeroError,
            $mensajeError
        );

        return $errores;
    }

    //Si la comprobación devuelve errores se cierra la conexión y se detiene la ejecución del script.
    if(comprobarConexion($dwes)[0] != null || comprobarConexion($dwes)[1] != null){
        echo "<p>Error $numeroError, $mensajeError conectando a la base de datos: $dwes->connect_error</p>";
        
        $dwes->close();
        exit();
    }else{
        //Operaciones CRUD
     
        //Cerrar conexión
        $dwes->close();
    }

    function obtenerCodigosProductos($dwes){
        $resultado = $dwes->query("SELECT cod FROM producto;", MYSQLI_USE_RESULT);
        $productos = $resultado->fetch_array();

        if($resultado == false){
            print "<p>No se han recibido datos.</p>";
        }else{
            $codigosProducto = array();

            foreach($productos as $codigoProducto){
                array_push($codigosProducto, $codigoProducto);
            }
        }

        return $codigosProducto;
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 6</title>
    </head>
    <body>
        <select>
            <?php
                foreach(obtenerCodigosProductos($dwes) as $codigo){
                    echo "<option value='$codigo'>$codigo</option>";
                }
            ?>
        </select>
    </body>
</html>
    
