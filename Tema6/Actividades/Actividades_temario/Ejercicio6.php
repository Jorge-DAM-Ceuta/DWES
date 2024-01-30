<?php 
    $dwes = new mysqli('localhost', 'dwes', '000000', 'dwes');

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
        $codigosProductos = obtenerCodigosProductos($dwes);

        if(isset($_POST["buscar"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
            $codigoProducto = $_POST["producto"];

            $informacionStock = obtenerStockProducto($dwes, $codigoProducto);

            echo "<h2>Se ha encontrado el producto $codigoProducto en la tienda " . $informacionStock['tienda'] . "</h2>"
            . "<h3>Hay " . $informacionStock['unidades'] . " unidades</h3>";
        }

        //Cerrar conexión
        $dwes->close();
    }

    function obtenerCodigosProductos($dwes){
        $resultado = $dwes->query("SELECT cod FROM producto;", MYSQLI_USE_RESULT);

        if($resultado == false){
            print "<p>No se han recibido datos.</p>";
            return array();

        }else{
            $codigosProductos = array();

            while($fila = $resultado->fetch_array()){
                $codigosProductos[] = $fila["cod"];
            }

            $resultado->close();
            return $codigosProductos;
        }
    }

    function obtenerStockProducto($dwes, $codigoProducto){
        $resultado = $dwes->query("SELECT * FROM stock WHERE producto='$codigoProducto';", MYSQLI_USE_RESULT);

        if($resultado == false){
            print "<p>No se han recibido datos.</p>";
            return array();

        }else{
            $fila = $resultado->fetch_array();

            $resultado->close();
            return $fila;
        }
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
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <label>Selecciona un producto para ver el stock:</label>

            <select name="producto">
                <?php
                    foreach($codigosProductos as $codigo){
                        echo "<option value='$codigo'>$codigo</option>";
                    }
                ?>
            </select>

            <input type="submit" name="buscar" value="Comprobar stock">
        </form>
    </body>
</html>
