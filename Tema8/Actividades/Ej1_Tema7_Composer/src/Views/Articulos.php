<div class="articulos-container">
    <?php
        
        //Obtenemos los artículos de la base de datos.
        $articulos = JorgeDwes\Blog\Model\Articulo::getArticulos();

        //Recorremos el array mostrando cada artículo en un div.
        foreach($articulos as $articulo){
            echo "<div class='articulo'>
                    <h2>" . $articulo->getTitulo() . "</h2>
                    <p>" . $articulo->getContenido() . "</p>
                    <p class='fecha'>" . $articulo->getFecha() . "</p>
                    <a class='eliminar' href='src/Controller/Controller.php?id=" . $articulo->getID() . "&numOperacion=2'>Eliminar artículo</a>
                </div>";
        }
    ?>
</div>