<?php
    function decodificarJSON(){
        $ruta = "./Carrito.json";
        $productos = json_decode(file_get_contents($ruta), true);
        
        return $productos;
    }

    function mostrarProductos($productos){
        foreach ($productos as $producto) {
            $nombreProducto = $producto['nombre'];

            echo "<div class='producto'>
                    <a style='color: black;' href='Producto.php?nombre=" . urlencode($nombreProducto) . "'>
                        <img src='" . $producto['imagen'] . "' width='200' height='200'>
                        <br/>
                        <strong>" . $nombreProducto . "</strong>
                    </a>

                    <br/>

                    Precio: " . $producto['precio'] . 

                    "<br/>

                    <a class='boton' href='Producto.php?nombre=" . urlencode($nombreProducto) . "'>Detalle</a>
                    <a class='boton' href='Comprar.php?nombre=" . urlencode($nombreProducto) . "'>Comprar</a>
                </div>";
        }
    }
    function mostrarCarrito($productos){
        if (isset($_COOKIE['carrito'])) {
            $carrito = json_decode($_COOKIE['carrito'], true);
    
            if (!empty($carrito)) {
                foreach ($carrito as $nombreProducto => $detalles) {
                    $cantidad = $detalles['cantidad'];
                    foreach ($productos as $producto) {
                        if ($producto['nombre'] == $nombreProducto) {
                            echo "<div class='producto-carrito'>
                                    <img src='" . $producto['imagen'] . "' width='80' height='80'>
                                    <br/>
                                    <strong>" . $producto['nombre'] . "</strong>
                                    <br/>
                                    Precio: " . $producto['precio'] . "
                                    <br/>
                                    Cantidad: $cantidad
                                </div>
                                <div>
                                    <a class='botonCarrito' href='Eliminar.php?nombre=" . urlencode($nombreProducto) . "'>Eliminar</a>
                                </div>
                                <br/>
                            ";
                        }
                    }
                }
            } else {
                echo "<p>El carrito está vacío.</p>";
            }
        }
    }

    function mostrarDetalles($productos){
        foreach ($productos as $producto) {
            $nombreProducto = $producto['nombre'];

            if ($nombreProducto == $_GET['nombre']) {
                echo "<div>
                        <img src='" . $producto['imagen'] . "' width='200' height='200'>
                        <h1>" . $producto['nombre'] . "</h1>
                        <p>
                            Descripción: " . $producto['descripcion'] . "</p>
                            Precio: " . $producto['precio'] . 
                        "</p>                 
                        <a class='boton' href='Comprar.php?nombre=" . urlencode($nombreProducto) . "'>Comprar</a>
                    </div>";
            }
        }
    }

    /*function comprarProducto($nombreProducto){
        $carrito = isset($_COOKIE['carrito']) ? json_decode($_COOKIE['carrito'], true) : array();

        if(isset($carrito[$nombreProducto])){
            $carrito[$nombreProducto]['cantidad'] += 1;
        }else{
            $carrito[$nombreProducto] = [
                'cantidad' => 1,
            ];
        }
    
        $carritoJson = json_encode($carrito);
        setcookie('carrito', $carritoJson, time() + 100000 * 60);
    
        header("Location: ./Index.php");
        exit();
    }*/

    /*function eliminarProducto($nombreProducto){
        $carrito = isset($_COOKIE['carrito']) ? json_decode($_COOKIE['carrito'], true) : array();
            
        if(isset($carrito[$nombreProducto])) {
            unset($carrito[$nombreProducto]);
        }
    
        $carritoJson = json_encode($carrito);
        setcookie('carrito', $carritoJson, time() + 100000 * 60);
    
        header("Location: ./Index.php");
        exit();    
    }*/

?>