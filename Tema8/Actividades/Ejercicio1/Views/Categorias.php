<?php
    include_once(__DIR__ . "/../Model/Articulo.php");

    // Obtenemos todas las categorías de los artículos.
    $categorias = Articulo::getCategorias();

    // Generamos las opciones del select.
    foreach($categorias as $categoria){
        echo "<option value='" . $categoria . "'>" . $categoria . "</option>";
    }
?>