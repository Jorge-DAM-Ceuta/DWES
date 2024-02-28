<?php
    include_once(__DIR__ . "/../Model/BlogDB.php");
    include_once(__DIR__ . "/../Model/Articulo.php");

    //Cuando el ajax haga una petición a este archivo se le devuelve el resultado de las categorias de la base de datos en formato json.
    echo json_encode(Articulo::getCategorias());
?>