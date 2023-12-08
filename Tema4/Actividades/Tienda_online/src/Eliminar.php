<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Eliminar del carrito</title>
    </head>
    <body>
        <?php
            if(isset($_GET['nombre'])) {
                $nombreProducto = $_GET['nombre'];
                
                $carrito = isset($_COOKIE['carrito']) ? json_decode($_COOKIE['carrito'], true) : array();
            
                if(isset($carrito[$nombreProducto])) {
                    unset($carrito[$nombreProducto]);
                }
            
                $carritoJson = json_encode($carrito);
                setcookie('carrito', $carritoJson, time() + 100000 * 60);
            
                header("Location: ./Index.php");
                exit();
            }
        ?>
    </body>
</html>