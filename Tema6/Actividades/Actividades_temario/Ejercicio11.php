<?php
    $dwes = new PDO("mysql:host=localhost;dbname=dwes", "dwes", "abc123.");

    function obtenerCodigosProductos($conexion){
        $consulta = $conexion->query("SELECT cod FROM producto");

        return $consulta->fetchAll(PDO::FETCH_COLUMN);
    }

    function obtenerStockProducto($conexion, $codigoProducto){
        $consulta = $conexion->prepare("SELECT * FROM stock WHERE producto = :codigoProducto");
        $consulta->bindParam(':codigoProducto', $codigoProducto, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["buscar"])){
        $codigoProducto = $_POST["producto"];
        $informacionStock = obtenerStockProducto($dwes, $codigoProducto);
        
        echo "<h2>Se ha encontrado el producto $codigoProducto</h2>";

        foreach ($informacionStock as $stock) {
            echo "<p>En la tienda " . $stock['tienda'] . " hay " . $stock['unidades'] . " unidades</p>";
        }
    }

    $codigosProductos = obtenerCodigosProductos($dwes);
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 11</title>
    </head>
    <body>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <label>Selecciona un producto para ver el stock:</label>

            <select name="producto">
                <?php
                foreach ($codigosProductos as $codigo) {
                    echo "<option value='$codigo'>$codigo</option>";
                }
                ?>
            </select>

            <input type="submit" name="buscar" value="Comprobar stock">
        </form>
    </body>
</html>