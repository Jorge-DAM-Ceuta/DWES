<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 20</title>
    </head>
    <body>
        <h1>Videojuego más barato en la tienda</h1>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type="submit" name="buscar" value="Buscar">
        </form>
    </body>
</html>

<?php
    $rutaJSON = "./Inventario.json";
    $jsonString = file_get_contents($rutaJSON);
    $elementos = json_decode($jsonString, true);

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['buscar'])) {
        function compararPrecios($a, $b) {
            return $a['precio'] <=> $b['precio'];
        }

        usort($elementos['inventario'], 'compararPrecios');
        
        $productoMasBarato = $elementos['inventario'][0];
    
        echo "<h2>Código: {$productoMasBarato['codigo']}, Título: {$productoMasBarato['titulo']}, Precio: {$productoMasBarato['precio']}</h2>";
    }

?>