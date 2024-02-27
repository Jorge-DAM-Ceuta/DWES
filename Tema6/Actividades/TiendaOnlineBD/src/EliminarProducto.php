<?php
    include_once("./Clases/Producto.php");

    if (isset($_GET['nombre'])) {
        $nombreProducto = urldecode($_GET['nombre']);
        Producto::eliminarProducto($nombreProducto);
    }
