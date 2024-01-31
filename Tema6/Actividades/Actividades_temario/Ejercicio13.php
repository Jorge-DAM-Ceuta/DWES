<?php 
    $dwes = new PDO("mysql:host=localhost;dbname=dwes", "dwes", "abc123.");
    $dwes->beginTransaction();

    //Restamos en uno las unidades del producto en la tienda 1
    $consultaRestarUnidad = $dwes->query("UPDATE stock SET unidades = unidades - 1 WHERE producto = 'PAPYRE62GB' AND tienda = 1;");
    $consultaRestarUnidad->execute();

    //Insertamos una nueva fila con el producto en la tienda 2 con una unidad.
    $consultaInsertarNuevaFila = $dwes->query("INSERT INTO stock (producto, tienda, unidades) VALUES ('PAPYRE62GB', 2, 1);");
    $consultaInsertarNuevaFila->execute();
    
    $dwes->commit();
    echo "<p>Se han repartido las unidades del producto entre las 3 tiendas.</p>";
?>
