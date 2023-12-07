<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tienda Online</title>
    </head>
    <body>
        <h1>Videojuegos</h1>

        <?php
            $productos = array(
                "Mario" => array(
                    "nombre" => "EX1",
                    "descripcion" => "Descripción del Producto 1",
                    "precio" => "24.99€",
                    "imagen" => "./Images/producto1.jpg"
                ),
                "Mario2" => array(
                    "nombre" => "EX1",
                    "descripcion" => "Descripción del Producto 1",
                    "precio" => "24.99€",
                    "imagen" => "./Images/producto2.jpg"
                ),
                "Mario3" => array(
                    "nombre" => "EX1",
                    "descripcion" => "Descripción del Producto 1",
                    "precio" => "24.99€",
                    "imagen" => "./Images/producto3.jpg"
                ),
                "Mario4" => array(
                    "nombre" => "EX1",
                    "descripcion" => "Descripción del Producto 1",
                    "precio" => "24.99€",
                    "imagen" => "./Images/producto4.jpg"
                ),
                "Mario5" => array(
                    "nombre" => "EX1",
                    "descripcion" => "Descripción del Producto 1",
                    "precio" => "24.99€",
                    "imagen" => "./Images/producto5.jpg"
                ),
                "Mario6" => array(
                    "nombre" => "EX1",
                    "descripcion" => "Descripción del Producto 1",
                    "precio" => "24.99€",
                    "imagen" => "./Images/producto6.jpg"
                ),

            );

            //Mostrar productos
            foreach ($productos as $id => $producto) {
                echo "<p>
                        <img src='" . $producto['imagen'] . "' width='100' height='100'>
                        <br/>" . $producto['nombre'] . 
                        "<br/>"
                    
                    
                    
                    ;

                echo 'Precio: $' . $producto['precio'] . '<br>';
                echo $producto['descripcion'] . '<br>';
                echo '<a href="detalle.php?id=' . $id . '">Ver Detalle</a><br>';
                echo '<form action="agregar_al_carrito.php" method="post">';
                echo '<input type="hidden" name="id" value="' . $id . '">';
                echo '<input type="submit" value="Comprar">';
                echo '</form>';
                echo '</p><br/>';
            }
        ?>

        <h2>Carrito de Compra</h2>

        <?php
            // Mostrar productos en el carrito
            if (isset($_COOKIE['carrito'])) {
                $carrito = json_decode($_COOKIE['carrito'], true);

                foreach ($carrito as $id => $cantidad) {
                    $producto = $productos[$id];
                    echo '<div>';
                    echo $producto['nombre'] . ' x ' . $cantidad . '<br>';
                    echo '<form action="eliminar_del_carrito.php" method="post">';
                    echo '<input type="hidden" name="id" value="' . $id . '">';
                    echo '<input type="submit" value="Eliminar">';
                    echo '</form>';
                    echo '</div><br>';
                }
            } else {
                echo 'El carrito está vacío';
            }
        ?>
    </body>
</html>

