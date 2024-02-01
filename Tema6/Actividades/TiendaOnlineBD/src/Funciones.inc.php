<?php
    include_once("./Clases/Usuario.php");
    include_once("./Clases/Producto.php");

//USUARIOS
    function registrarUsuario($usuario){
        $conexionBD = new mysqli("localhost", "root", "", "tiendaonline");

        //Si hay un error se muestra el error y se cierra la conexión.
        if($conexionBD->connect_error){
            echo "Error de conexión: " . $conexionBD->connect_error;
            $conexionBD->close();
        }

        //Se comprueba que no exista ese username.
        $verificarUsuario = $conexionBD->query("SELECT COUNT(*) FROM usuario WHERE username = '" . $usuario->getUsername() ."';");
        $registroUsuario = $verificarUsuario->fetch_assoc();
        $usernameExistente = $registroUsuario['COUNT(*)'];

        /*Si en la tabla usuario se encuentra el username en concreto se muestra un mensaje 
        y se cierra la conexión, en caso contrario se verifica la contraseña*/
        if($usernameExistente > 0){
            echo "<h2>El nombre de usuario ya está registrado. Por favor, elige otro.</h2>";

            $conexionBD->close();
        }else{
            //Se cifra la contraseña obtenida del usuario.
            $passwordHash = password_hash($usuario->getPassword(), PASSWORD_ARGON2I);

            //Se inserta una fila en la tabla usuario con los valores obtenidos de los getters del objeto.
            $resultado = $conexionBD->query("INSERT INTO usuario (username, password, role) VALUES ('" . $usuario->getUsername() . "', '$passwordHash', '" . $usuario->getRole() . "');");

            //Mostrar comprobación.
            if($resultado == false){
                echo "<h2>No se ha podido registrar el usuario en este momento, inténtalo de nuevo.</h2>";
            }else{
                echo "<h2>Te has registrado correctamente.</h2>";
            }

            //Cerrar la conexión.
            $conexionBD->close();
        }
    }

    function iniciarSesion($usuario){
        $conexionBD = new mysqli("localhost", "root", "", "tiendaonline");
    
        //Si hay un error se muestra el error y se cierra la conexión.
        if($conexionBD->connect_error){
            echo "Error de conexión: " . $conexionBD->connect_error;
            $conexionBD->close();
        }
    
        //Obtenemos la información del usuario
        $consultaUsuario = $conexionBD->query("SELECT username, password, role FROM usuario WHERE username = '" . $usuario->getUsername() . "';");
    
        if($consultaUsuario == true){
            $registroUsuario = $consultaUsuario->fetch_assoc();
    
            //Verificar la contraseña
            if(password_verify($usuario->getPassword(), $registroUsuario['password']) == true){
                session_start();
    
                $_SESSION['usuario'] = [
                    'username' => $registroUsuario['username'],
                    'role' => $registroUsuario['role']
                ];
    
                $conexionBD->close();

                header("Location: Index.php");
                die();

            }else{
                // Cierre de la conexión y mensaje de error.
                $conexionBD->close();
                echo "<h2 style='color: red;'>La contraseña no es correcta</h2>";
            }
        }else{
            // Cierre de la conexión y mensaje de error.
            $conexionBD->close();
            echo "<h2 style='color: red;'>No se ha podido encontrar el usuario</h2>";
        }
    }

//TIENDA
/*
ADMIN:
    INDEX -> MOSTRAR PRODUCTOS
    PRODUCTO -> 
        MOSTRAR PRODUCTO
        INSERTAR PRODUCTO
        EDITAR PRODUCTO
        ELIMINAR PRODUCTO

CLIENTE:
*/

    function obtenerProductos(){
        $conexionBD = new mysqli("localhost", "root", "", "tiendaonline");
    
        //Si hay un error se muestra el error y se cierra la conexión.
        if($conexionBD->connect_error){
            echo "Error de conexión: " . $conexionBD->connect_error;
            $conexionBD->close();
        }
    
        //Obtenemos los productos de la base de datos
        $consultaProductos = $conexionBD->query("SELECT * FROM producto;");
    
        if($consultaProductos == true){
            $arrayProductos = array();

            while($producto = $consultaProductos->fetch_assoc()){
                array_push($arrayProductos, new Producto($producto["nombre"], $producto["descripcion"], $producto["precio"], $producto["imagen"]));
            }
            
            $conexionBD->close();
            return $arrayProductos;
        }else{
            $conexionBD->close();
        }
    }
    
    /*Esta función también recibe el array de productos y mediante un enlace se obtiene el 
    nombre del producto en específico. Se recorre el array y encuentra la coincidencia con
    dicho nombre para mostrar toda su información en una nueva instancia. Este solo 
    incluirá un enlace para añadirlo al carrito.*/
    function mostrarDetalles($productos){
        foreach($productos as $producto){
            $nombreProducto = $producto->getNombre();

            if($nombreProducto == $_GET['nombre']){
                echo "<div>
                        <img src='" . $producto->getImagen() . "'/>
                        <h1>" . $producto->getNombre() . "</h1>
                        <p>
                            Descripción: " . $producto->getDescripcion() . "</p>
                            Precio: " . $producto->getPrecio() . 
                        "</p>                 
                        <a href='Index.php'>Volver</a>
                        <a href='Comprar.php?nombre=" . urlencode($nombreProducto) . "'>Comprar</a>
                    </div>";

                return $producto;
            }
        }
    }

//FUNCIONES DE ADMINISTRADOR
    function mostrarProductosAdmin($productos){
        echo "<div class='contenedor-productos'>";
        
        foreach($productos as $producto){
            $nombreProducto = $producto->getNombre();
    
            echo "<div class='producto'>
                    <a class='visualizar' href='Producto.php?nombre=" . urlencode($nombreProducto) . "'>
                        <img src='" . $producto->getImagen() . "'/>
                        <br/>
                        <strong>" . $nombreProducto . "</strong>
                    </a>
    
                    <br/>
    
                    " . $producto->getPrecio() . 
    
                    "<br/>
    
                    <a class='boton' href='EditarProducto.php?nombre=" . urlencode($nombreProducto) . "'>Editar</a>
                    <a class='boton' href='EliminarProducto.php?nombre=" . urlencode($nombreProducto) . "'>Eliminar</a>
                </div>";
        }
        
        echo "</div>";
    }

    function insertarProducto($producto){
        $conexionBD = new mysqli("localhost", "root", "", "tiendaonline");
    
        //Si hay un error se muestra el error y se cierra la conexión.
        if($conexionBD->connect_error){
            echo "Error de conexión: " . $conexionBD->connect_error;
            $conexionBD->close();
        }
    
        //Obtenemos los productos de la base de datos
        $insertarProducto = $conexionBD->query("INSERT INTO producto (`nombre`, `descripcion`, `precio`, `imagen`) VALUES ('" . $producto->getNombre() . "','" . $producto->getDescripcion() . "','" . $producto->getPrecio() . "','" . $producto->getImagen() . "');");
    
        if($insertarProducto == true){
            $conexionBD->close();
            header("Location: Index.php");
            die();
        }else{
            echo "<h2 style='color: red;'>No se ha podido añadir el producto, inténtalo de nuevo.</h2>";
            $conexionBD->close();
        }
    }

    function editarProducto($nombreProducto, $producto){
        $conexionBD = new mysqli("localhost", "root", "", "tiendaonline");
    
        //Si hay un error se muestra el error y se cierra la conexión.
        if($conexionBD->connect_error){
            echo "Error de conexión: " . $conexionBD->connect_error;
            $conexionBD->close();
        }

        $editarProducto = $conexionBD->query("UPDATE producto SET `nombre`='" . $producto->getNombre() . "',`descripcion`='" . $producto->getDescripcion() . "',`precio`='" . $producto->getPrecio() . "',`imagen`='" . $producto->getImagen() . "' WHERE nombre='$nombreProducto';");

        if($editarProducto == true){
            $conexionBD->close();
            header("Location: Index.php");
            die();
        }else{
            echo "<h2 style='color: red;'>No se ha podido editar el producto, inténtalo de nuevo.</h2>";
            $conexionBD->close();
        }
    }

    function eliminarProducto($nombreProducto){
        $conexionBD = new mysqli("localhost", "root", "", "tiendaonline");
    
        //Si hay un error se muestra el error y se cierra la conexión.
        if($conexionBD->connect_error){
            echo "Error de conexión: " . $conexionBD->connect_error;
            $conexionBD->close();
        }

        $eliminarProducto = $conexionBD->query("DELETE FROM producto WHERE nombre='$nombreProducto';");

        if($eliminarProducto == true){
            $conexionBD->close();
            header("Location: Index.php");
            die();
        }else{
            echo "<h2 style='color: red;'>No se ha podido eliminar el producto, inténtalo de nuevo.</h2>";
            $conexionBD->close();
        }
    }
 
//FUNCIONES DE CLIENTES
    /*Esta función que recibe el array de productos se encarga de recorrer mediante un foreach
    cada producto y mostrarlo mediante una estructura HTML en un div. Además de añadir dos 
    enlaces para cada producto que se encarguen de mostrar los detalles o añadir al carrito.*/
    function mostrarProductosClientes($productos){
        echo "<div class='contenedor-productos'>";

        foreach ($productos as $producto) {
            $nombreProducto = $producto->getNombre();

            echo "<div class='producto'>
                    <a class='visualizar' href='Producto.php?nombre=" . urlencode($nombreProducto) . "'>
                        <img src='" . $producto->getImagen() . "' width='200' height='200'>
                        <br/>
                        <strong>" . $nombreProducto . "</strong>
                    </a>

                    <br/>

                    " . $producto->getPrecio() . 

                    "<br/>

                    <a class='boton' href='Producto.php?nombre=" . urlencode($nombreProducto) . "'>Detalle</a>
                    <a class='boton' href='AniadirUnidadCarrito.php?nombre=" . urlencode($nombreProducto) . "'>Comprar</a>
                </div>";
        }
        
        echo "</div>";
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
                        if ($producto->getNombre() == $nombreProducto) {
                            echo "<div class='producto-carrito' style='margin-left: 3vw; margin-top: 2vh;'>
                                    <img src='" . $producto->getImagen() . "' width='80' height='80'>
                                    <br/>
                                    <strong>" . $producto->getNombre() . "</strong>
                                    <br/>
                                    Precio: " . $producto->getPrecio() . "
                                    <br/>
                                </div>
                                <div>
                                    <a class='botonCarrito' style='margin-left: 3vw; margin-bottom: 1.5vh; text-decoration-line: none; font-size: 1.25em;' href='EliminarUnidadCarrito.php?nombre=" . urlencode($nombreProducto) . "'>-</a>
                                    <span>&nbsp;</span>
                                    $cantidad
                                    <span>&nbsp;</span>
                                    <a class='botonCarrito' style='margin-bottom: 1.5vh; text-decoration-line: none; font-size: 1.15em;' href='AniadirUnidadCarrito.php?nombre=" . urlencode($nombreProducto) . "'>+</a>
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