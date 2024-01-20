<?php

//USUARIOS
function registrarUsuario($username, $password){
    $usuarioExistente = false;

    $rutaJSON = "Usuarios.json";
    $jsonString = file_get_contents($rutaJSON);
    $usuarios = json_decode($jsonString, true);

    //Comprobar que no exista el usuario.
    foreach($usuarios as $elemento){
        if($username == $elemento['username']){
            $usuarioExistente = true;
        }
    }

    if($usuarioExistente == false){
        array_push($usuarios, array("username" => $username, "password" => password_hash($password, PASSWORD_ARGON2I), "role" => "Client"));

        $jsonString = json_encode($usuarios, JSON_PRETTY_PRINT);
        file_put_contents($rutaJSON, $jsonString);  

        echo "<h2>Te has registrado correctamente</h2>";
    }
}

function iniciarSesion($username, $password){
    $rutaJSON = "Usuarios.json";
    $jsonString = file_get_contents($rutaJSON);
    $usuarios = json_decode($jsonString, true);

    $autenticacion = false;

    foreach($usuarios as $elemento){
        if($elemento['username'] == $username && password_verify($password, $elemento['password']) == true){
            $autenticacion = true;

            session_start();

            $_SESSION['usuario'] = [
                'username' => $elemento['username'],
                'role' => $elemento['role']
            ];

            header("Location: Index.php");
            die();
        }else{
            $autenticacion = false;
        }
    }
    
    if($autenticacion == false){
        echo "<h2 style='color: red;'>Usuario o contraseña incorrectos</h2>";
    }
}

//TIENDA
    //Esta función se encarga de recuperar en un array el contenido del json de los productos.
    function decodificarJSON(){
        $ruta = "./Productos.json";
        $productos = json_decode(file_get_contents($ruta), true);
        
        return $productos;
    }

    function mostrarProductosAdmin($productos){
        foreach ($productos as $producto) {
            $nombreProducto = $producto['nombre'];

            echo "<div class='producto'>
                    <a style='color: black;' href='Producto.php?nombre=" . urlencode($nombreProducto) . "'>
                        <img src='" . $producto['imagen'] . "' width='200' height='200'>
                        <br/>
                        <strong>" . $nombreProducto . "</strong>
                    </a>

                    <br/>

                    " . $producto['precio'] . 

                    "<br/>

                    <a class='boton' style='text-decoration-line: none; margin-top: 15px; color: white;' href='Editar_producto.php?nombre=" . urlencode($nombreProducto) . "'>Editar</a>
                    <a class='boton' style='text-decoration-line: none; margin-top: 15px; color: white;' href='Eliminar_producto.php?nombre=" . urlencode($nombreProducto) . "'>Eliminar</a>
                </div>";
        }
    }

    /*Esta función que recibe el array de productos se encarga de recorrer mediante un foreach
    cada producto y mostrarlo mediante una estructura HTML en un div. Además de añadir dos 
    enlaces para cada producto que se encarguen de mostrar los detalles o añadir al carrito.*/
    function mostrarProductosClientes($productos){
        foreach ($productos as $producto) {
            $nombreProducto = $producto['nombre'];

            echo "<div class='producto'>
                    <a style='color: black;' href='Producto.php?nombre=" . urlencode($nombreProducto) . "'>
                        <img src='" . $producto['imagen'] . "' width='200' height='200'>
                        <br/>
                        <strong>" . $nombreProducto . "</strong>
                    </a>

                    <br/>

                    " . $producto['precio'] . 

                    "<br/>

                    <a class='boton' style='text-decoration-line: none; margin-top: 15px; color: white;' href='Producto.php?nombre=" . urlencode($nombreProducto) . "'>Detalle</a>
                    <a class='boton' style='text-decoration-line: none; margin-top: 15px; color: white;' href='Comprar.php?nombre=" . urlencode($nombreProducto) . "'>Comprar</a>
                </div>";
        }
    }

    /*Esta función también recibe el array de productos y mediante un enlace se obtiene el 
    nombre del producto en específico. Se recorre el array y encuentra la coincidencia con
    dicho nombre para mostrar toda su información en una nueva instancia. Este solo 
    incluirá un enlace para añadirlo al carrito.*/
    function mostrarDetalles($productos){
        foreach ($productos as $producto) {
            $nombreProducto = $producto['nombre'];

            if($nombreProducto == $_GET['nombre']){
                echo "<div>
                        <img src='" . $producto['imagen'] . "' width='200' height='200'>
                        <h1>" . $producto['nombre'] . "</h1>
                        <p>
                            Descripción: " . $producto['descripcion'] . "</p>
                            Precio: " . $producto['precio'] . 
                        "</p>                 
                        <a class='boton' style='text-decoration-line: none; margin-right: 20px; color: white;' href='Index.php'>Volver</a>
                        <a class='boton' style='text-decoration-line: none; color: white;' href='Comprar.php?nombre=" . urlencode($nombreProducto) . "'>Comprar</a>
                    </div>";
                return $producto;
            }
        }
    }

    /*Esta función también recibe el array de productos, se encarga de comprobar si la 
    cookie del carrito está seteada. En el caso de que si esté seteada se obtiene un 
    nuevo array llamado carrito con los valores de la cookie. Si el array obtenido no
    está vacío se recorre mostrando los detalles de cada producto. La cookie tendrá por
    cada producto otro elemento llamado cantidad.*/
    function mostrarCarrito($productos){
        if (isset($_COOKIE['carrito'])) {
            $carrito = json_decode($_COOKIE['carrito'], true);
    
            if (!empty($carrito)) {
                foreach ($carrito as $nombreProducto => $detalles) {
                    $cantidad = $detalles['cantidad'];
                    foreach ($productos as $producto) {
                        if ($producto['nombre'] == $nombreProducto) {
                            echo "<div class='producto-carrito' style='margin-left: 3vw; margin-top: 2vh;'>
                                    <img src='" . $producto['imagen'] . "' width='80' height='80'>
                                    <br/>
                                    <strong>" . $producto['nombre'] . "</strong>
                                    <br/>
                                    Precio: " . $producto['precio'] . "
                                    <br/>
                                </div>
                                <div>
                                    <a class='botonCarrito' style='margin-left: 3vw; margin-bottom: 1.5vh; text-decoration-line: none; font-size: 1.25em;' href='Eliminar.php?nombre=" . urlencode($nombreProducto) . "'>-</a>
                                    <span>&nbsp;</span>
                                    $cantidad
                                    <span>&nbsp;</span>
                                    <a class='botonCarrito' style='margin-bottom: 1.5vh; text-decoration-line: none; font-size: 1.15em;' href='Comprar.php?nombre=" . urlencode($nombreProducto) . "'>+</a>
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
?>