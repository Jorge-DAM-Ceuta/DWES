<?php 
    $dwes = new mysqli('localhost', 'dwes', 'abc123.', 'dwes');

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

        if(isset($_POST["mostrar"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
            $informacionStocks = obtenerStocksProducto($dwes);

            foreach ($informacionStocks as $stock) {
                echo "<h2>Producto: " . $stock['producto'] . "</h2>";
                echo "<p>En la tienda " . $stock['tienda'] . " hay " . $stock['unidades'] . " unidades</p>";            }
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

    function obtenerStocksProducto($dwes){
        $stocks = array();

        //Se obtienen los productos de la tabla Producto.
        $productos = obtenerCodigosProductos($dwes);

        $consulta = $dwes->stmt_init();
        $consulta->prepare("SELECT tienda, unidades FROM stock WHERE producto = ?;");
        
        //Se recorre cada producto en busca de la tienda que lo tiene y las unidades.
        foreach ($productos as $codigoProducto) {
            $consulta->bind_param("s", $codigoProducto);

            $consulta->execute();
            $consulta->bind_result($tienda, $unidades);

            while ($consulta->fetch()) {
                $stocks[] = array(
                    'producto' => $codigoProducto,
                    'tienda' => $tienda,
                    'unidades' => $unidades
                );
            }
        }

        $consulta->close();
        return $stocks;
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 7</title>
    </head>
    <body>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <label>Mostrar información de los productos:</label>

            <input type="submit" name="mostrar" value="Mostrar información">
        </form>
    </body>
</html>
