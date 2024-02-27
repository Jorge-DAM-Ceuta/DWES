<?php
    include_once("Templates/Apertura.inc.php");

    if (isset($_GET['nombre'])) {
        $nombreProducto = $_GET['nombre'];
        $carrito = isset($_COOKIE['carrito']) ? json_decode($_COOKIE['carrito'], true) : array();


        if (isset($carrito[$nombreProducto])) {

            if ($carrito[$nombreProducto]['cantidad'] > 0) {
                $carrito[$nombreProducto]['cantidad'] -= 1;
            }

            //Si la cantidad llega a cero se elimina el producto del carrito.
            if ($carrito[$nombreProducto]['cantidad'] == 0) {
                unset($carrito[$nombreProducto]);
            }
        }


        $carritoJson = json_encode($carrito);
        setcookie('carrito', $carritoJson, time() + 100000 * 60);


        header("Location: ./Index.php");
        exit();
    }

    include_once("Templates/Cierre.inc.php");