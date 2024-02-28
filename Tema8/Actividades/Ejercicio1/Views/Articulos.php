<?php 
    include_once(__DIR__ . "/../Model/Articulo.php");

    $terminoBusqueda = isset($_GET['search']) ? trim($_GET['search']) : '';
    $articulos = $terminoBusqueda ? Articulo::buscarArticulos($terminoBusqueda) : Articulo::getArticulos();

    foreach($articulos as $articulo){
        echo "<div class='articulo'>
                <h2>" . $articulo->getTitulo() . "</h2>
                <h4>" . $articulo->getCategoria() . "</h4>
                <p>" . $articulo->getContenido() . "</p>
                <p class='fecha'>" . $articulo->getFecha() . "</p>
                <a class='eliminar' href='Controller/Controller.php?id=" . $articulo->getID() . "&numOperacion=2'>Eliminar artículo</a>
            </div>";
    }
?>