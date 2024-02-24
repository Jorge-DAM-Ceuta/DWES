<?php
    $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
    $articulos = Articulo::getArticulos($pagina);

    foreach($articulos as $articulo){
        echo "<div class='articulo'>
                <h2>" . $articulo->getTitulo() . "</h2>
                <p>" . $articulo->getContenido() . "</p>
                <p class='fecha'>" . $articulo->getFecha() . "</p>
                <a class='eliminar' href='Controller/Controller.php?id=" . $articulo->getID() . "&numOperacion=2'>Eliminar artículo</a>
              </div>";
    }
?>