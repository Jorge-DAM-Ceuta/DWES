<?php
    include_once("./Clases/Usuario.php");
    include_once("./Clases/Producto.php");

    /*
        FALTA: 
            Usar fuente descargada / google fonts
    */

//USUARIOS

    //Esta función recibe un objeto usuario.
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

    //Esta función recibe un objeto usuario.
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
    
                //Se crea el usuario en la sesión con el username y el role.
                $_SESSION['usuario'] = [
                    'username' => $registroUsuario['username'],
                    'role' => $registroUsuario['role']
                ];
    
                //Se cierra la conexión de la base de datos y se redirige al index.
                $conexionBD->close();

                header("Location: Index.php");
                die();

            }else{
                //Se cierra la conexión de la base de datos y muestra un mensaje de error.
                $conexionBD->close();
                echo "<h2 style='color: red;'>La contraseña no es correcta</h2>";
            }
        }else{
            //Se cierra la conexión de la base de datos y muestra un mensaje de error.
            $conexionBD->close();
            echo "<h2 style='color: red;'>No se ha podido encontrar el usuario</h2>";
        }
    }

//TIENDA

    //Se obtienen los productos de la base de datos mediante una consulta.
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

            //Se crea un objeto Producto con los datos de cada registro de la base de datos y se añade al array.
            while($producto = $consultaProductos->fetch_assoc()){
                array_push($arrayProductos, new Producto($producto["nombre"], $producto["descripcion"], $producto["precio"], $producto["imagen"]));
            }
            
            //Se cierra la conexión y se devuelve el array con los productos.
            $conexionBD->close();
            return $arrayProductos;
        }else{
            $conexionBD->close();
        }
    }
    
    /*Esta función recibe el array de productos y mediante un enlace se obtiene el nombre del producto en específico. 
    Se recorre el array y encuentra la coincidencia con dicho nombre para mostrar toda su información en una nueva 
    instancia. Incluyendo un enlace para volver al index y otro para añadirlo al carrito.*/
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

    //Obtiene el array de productos y los muestra con las funciones de administrador mediante dos a href.
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

    //Se recibe un objeto Producto con los datos obtenidos del formulario.
    function insertarProducto($producto){
        $conexionBD = new mysqli("localhost", "root", "", "tiendaonline");
    
        //Si hay un error se muestra el error y se cierra la conexión.
        if($conexionBD->connect_error){
            echo "Error de conexión: " . $conexionBD->connect_error;
            $conexionBD->close();
        }
    
        //Se realiza la operación INSERT con los datos del producto.
        $insertarProducto = $conexionBD->query("INSERT INTO producto (`nombre`, `descripcion`, `precio`, `imagen`) VALUES ('" . $producto->getNombre() . "','" . $producto->getDescripcion() . "','" . $producto->getPrecio() . "','" . $producto->getImagen() . "');");
    
        if($insertarProducto == true){
            //Se cierra la conexión de la base de datos y se redirige al index.
            $conexionBD->close();
            header("Location: Index.php");
            die();
        }else{            
            //Se cierra la conexión y se muestra un mensaje de error.
            $conexionBD->close();
            echo "<h2 style='color: red;'>No se ha podido añadir el producto, inténtalo de nuevo.</h2>";
        }
    }

    //Se recibe el nombre del producto y el objeto producto con los nuevos valores obtenidos del formulario.
    function editarProducto($nombreProducto, $producto){
        $conexionBD = new mysqli("localhost", "root", "", "tiendaonline");
    
        //Si hay un error se muestra el error y se cierra la conexión.
        if($conexionBD->connect_error){
            echo "Error de conexión: " . $conexionBD->connect_error;
            $conexionBD->close();
        }

        //Se realiza la operación UPDATE con los nuevos datos para el producto al que pertenece el nombre obtenido.
        $editarProducto = $conexionBD->query("UPDATE producto SET `nombre`='" . $producto->getNombre() . "',`descripcion`='" . $producto->getDescripcion() . "',`precio`='" . $producto->getPrecio() . "',`imagen`='" . $producto->getImagen() . "' WHERE nombre='$nombreProducto';");

        if($editarProducto == true){
            //Se cierra la conexión de la base de datos y se redirige al index.
            $conexionBD->close();
            header("Location: Index.php");
            die();
        }else{
            //Se cierra la conexión y se muestra un mensaje de error.
            $conexionBD->close();
            echo "<h2 style='color: red;'>No se ha podido editar el producto, inténtalo de nuevo.</h2>";
        }
    }

    //Se recibe el nombre del producto a eliminar.
    function eliminarProducto($nombreProducto){
        $conexionBD = new mysqli("localhost", "root", "", "tiendaonline");
    
        //Si hay un error se muestra el error y se cierra la conexión.
        if($conexionBD->connect_error){
            echo "Error de conexión: " . $conexionBD->connect_error;
            $conexionBD->close();
        }

        //Se realiza la operación Delete para el nombre obtenido.
        $eliminarProducto = $conexionBD->query("DELETE FROM producto WHERE nombre='$nombreProducto';");

        if($eliminarProducto == true){
            //Se cierra la conexión de la base de datos y se redirige al index.
            $conexionBD->close();
            header("Location: Index.php");
            die();
        }else{
            //Se cierra la conexión y se muestra un mensaje de error.
            $conexionBD->close();
            echo "<h2 style='color: red;'>No se ha podido eliminar el producto, inténtalo de nuevo.</h2>";
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
                        <img src='" . $producto->getImagen() . "'/>
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
                                    <img src='" . $producto->getImagen() . "' width='100' height='140'>
                                    <br/>
                                    <strong>" . $producto->getNombre() . "</strong>
                                    <br/>
                                    Precio: " . $producto->getPrecio() . "
                                    <br/>
                                </div>
                                <div>
                                    <a class='botonCarrito1' href='EliminarUnidadCarrito.php?nombre=" . urlencode($nombreProducto) . "'>-</a>
                                    <span>&nbsp;</span>
                                    $cantidad
                                    <span>&nbsp;</span>
                                    <a class='botonCarrito2' href='AniadirUnidadCarrito.php?nombre=" . urlencode($nombreProducto) . "'>+</a>
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