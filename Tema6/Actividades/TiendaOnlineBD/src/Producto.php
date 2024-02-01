<?php
    include_once("./Funciones.inc.php");
    $productos = obtenerProductos();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/MostrarProducto.css">
        <title>Producto</title>
    </head>
    <body>
        <?php
            /*Si se ha recibido el nombre por GET se llama a la 
            función para mostrar los detalles del producto.*/
            if(isset($_GET['nombre'])) {
                mostrarDetalles($productos);
            }
        ?>
    </body>
</html>