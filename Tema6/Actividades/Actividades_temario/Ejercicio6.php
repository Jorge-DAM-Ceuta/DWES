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

        if(isset($_POST["buscar"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
            $codigoProducto = $_POST["producto"];

            $informacionStock = obtenerStockProducto($dwes, $codigoProducto);

            if(!empty($informacionStock)){
                echo "<h2>Información del producto $codigoProducto:</h2>";
    
                foreach($informacionStock as $stock){
                    echo "<p>En la tienda " . $stock['tienda'] . " hay " . $stock['unidades'] . " unidades.</p>";
                }
            }else{
                echo "<p>No se encontraron registros para el producto $codigoProducto</p>";
            }
        }

        //Cerrar conexión
        $dwes->close();
    }

    function obtenerCodigosProductos($dwes){
        $resultado = $dwes->query("SELECT cod FROM producto;");

        if($resultado == false){
            print "<p>No se han recibido datos.</p>";
            return array();

        }else{
            $codigosProductos = array();

            while($fila = $resultado->fetch_array()){
                $codigosProductos[] = $fila["cod"];
            }

            return $codigosProductos;
        }
    }

    function obtenerStockProducto($dwes, $codigoProducto){
        $resultado = $dwes->query("SELECT * FROM stock WHERE producto='$codigoProducto';");

        if($resultado == false){
            print "<p>No se han recibido datos.</p>";
            return array();

        }else{
            $stocks = array();

            while($fila = $resultado->fetch_array()){
                $stocks[] = $fila;
            }

            return $stocks;
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
