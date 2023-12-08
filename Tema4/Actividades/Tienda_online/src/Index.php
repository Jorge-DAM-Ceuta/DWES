<?php
    include_once("./Funciones.inc.php");
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/Style.css">
        <title>Tienda Online</title>
    </head>
    <body>
        <h2>Carrito de Compra</h2>

        <?php
            mostrarCarrito();
        ?>

        <h1>Videojuegos</h1>

        <?php
            $productos = decodificarJSON();

            mostrarProductos($productos);
        ?>
    </body>
</html>

