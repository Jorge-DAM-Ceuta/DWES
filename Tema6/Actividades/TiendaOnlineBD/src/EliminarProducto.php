<?php
    include_once("Funciones.inc.php");
    
    if(isset($_GET['nombre'])) {
        $nombreProducto = urldecode($_GET['nombre']);
        eliminarProducto($nombreProducto);
    }
?>