<?php
    include_once("./Clases/Producto.php");
    $productos = Producto::obtenerProductos();

    include_once("Templates/Apertura.inc.php");

    if(isset($_GET['nombre'])){
        Producto::mostrarDetalles($productos);
    }

    include_once("Templates/Cierre.inc.php");
?>
