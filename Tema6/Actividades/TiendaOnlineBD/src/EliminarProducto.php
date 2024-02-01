<?php
    include_once("Funciones.inc.php");
    
    //Se obtiene el nombre del producto para eliminarlo.
    if(isset($_GET['nombre'])) {
        $nombreProducto = urldecode($_GET['nombre']);
        eliminarProducto($nombreProducto);
    }
?>