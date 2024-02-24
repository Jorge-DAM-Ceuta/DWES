<div class="articulos-container">
    <div id="filtro">
        <input type="text" id="busqueda" oninput="filtrarArticulos()" placeholder="Buscar artículo...">
    </div>
    
    <div id="articulos-lista">
        <?php include_once("Views/Paginacion.php"); ?>
    </div>

    <?php
        $totalArticulos = Articulo::getNumeroArticulos();
        $totalPaginas = ceil($totalArticulos / 6);

        echo "<div class='paginacion'>";
        for($i = 1; $i <= $totalPaginas; $i++){
            echo "<a href='index.php?pagina=$i'>$i</a>";
        }
        echo "</div>";
    ?>
</div>