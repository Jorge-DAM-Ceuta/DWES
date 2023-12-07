<!DOCTYPE html>
<html>
<head>
    <title>Detalle del Producto</title>
</head>
<body>

<?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $producto = $productos[$id];

        echo '<h1>' . $producto['nombre'] . '</h1>';
        echo '<img src="' . $producto['imagen'] . '" alt="' . $producto['nombre'] . '" width="200" height="200"><br>';
        echo 'Precio: $' . $producto['precio'] . '<br>';
        echo $producto['descripcion'] . '<br>';

        echo '<form action="agregar_al_carrito.php" method="post">';
        echo '<input type="hidden" name="id" value="' . $id . '">';
        echo '<input type="submit" value="Agregar al Carrito">';
        echo '</form>';
    } else {
        echo 'Producto no encontrado';
    }
?>

</body>
</html>
