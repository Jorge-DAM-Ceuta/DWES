<?php
    if(isset($_GET['nombre'])) {
        $nombreProducto = urldecode($_GET['nombre']);

        $rutaJSON = "Productos.json";
        $jsonString = file_get_contents($rutaJSON);
        $productos = json_decode($jsonString, true);

        foreach($productos as $key => $producto) {
            if($producto['nombre'] == $nombreProducto) {
                unset($productos[$key]);
                
                $jsonString = json_encode($productos, JSON_PRETTY_PRINT);
                file_put_contents($rutaJSON, $jsonString);
                
                header("Location: Index.php");
                exit();
            }
        }
    }
?>