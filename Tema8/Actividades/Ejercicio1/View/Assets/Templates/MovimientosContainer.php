<h2>Movimientos</h2>

<div class='buscador'>
    <input type='text' placeholder='Buscar movimientos por nombre o fecha' id='search' name='search' oninput='cargarMovimientos()'>
</div>

<div id="movimientos">
    <?php
        foreach ($movimientos as $movimiento) {
            $tipo = ($movimiento['tipo'] == 'Ingreso') ? 'ingreso' : 'retiro';
            echo "<div id='movimiento' class='movimiento $tipo'>";
            echo "<p>Tipo: {$movimiento['tipo']}<br>";
            echo "Cantidad: {$movimiento['cantidad']} euros<br>";
            echo "Concepto: {$movimiento['concepto']}<br>";
            echo "Fecha: {$movimiento['fecha']}</p>";
            echo '</div>';
        }
    ?>
</div>