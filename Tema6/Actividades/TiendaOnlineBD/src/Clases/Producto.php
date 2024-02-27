<?php
    include_once("TiendaDB.php");
    include_once("Usuario.php");

    ob_start();
    
    class Producto{
        private string $nombre;
        private string $descripcion;
        private string $precio;
        private string $imagen;

        public function __construct($nombre, $descripcion, $precio, $imagen = ""){
            $this->nombre = $nombre;
            $this->descripcion = $descripcion;
            $this->precio = $precio;
            $this->imagen = $imagen;
        }

        public function getNombre(){
            return $this->nombre;
        }
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        public function getDescripcion(){
            return $this->descripcion;
        }
        public function setDescripcion($descripcion){
            $this->descripcion = $descripcion;
        }

        public function getPrecio(){
            return $this->precio;
        }
        public function setPrecio($precio){
            $this->precio = $precio;
        }

        public function getImagen(){
            return $this->imagen;
        }
        public function setImagen($imagen){
            $this->imagen = $imagen;
        }
        
        public static function obtenerProductos(){
            $conexionBD = $conexionBD = TiendaDB::obtenerConexionBD();
            //Obtenemos los productos de la base de datos
            $consultaProductos = $conexionBD->query("SELECT * FROM producto;");

            if ($consultaProductos == true) {
                $arrayProductos = array();

                //Se crea un objeto Producto con los datos de cada registro de la base de datos y se añade al array.
                while ($producto = $consultaProductos->fetch_assoc()) {
                    array_push($arrayProductos, new Producto($producto["nombre"], $producto["descripcion"], $producto["precio"], $producto["idimagen"]));
                }

                //Se cierra la conexión y se devuelve el array con los productos.
                $conexionBD->close();
                return $arrayProductos;
            } else {
                $conexionBD->close();
            }
        }

        public static function mostrarDetalles($productos){
            $conexionBD = TiendaDB::obtenerConexionBD();
            $imagen = "";

            foreach ($productos as $producto) {
                $nombreProducto = $producto->getNombre();

                if ($nombreProducto == $_GET['nombre']) {
                    // Guardar los valores originales del producto en variables temporales
                    $nombreOriginal = $producto->getNombre();
                    $descripcionOriginal = $producto->getDescripcion();
                    $precioOriginal = $producto->getPrecio();
                    $idImagen = $producto->getImagen();

                    // Realiza una consulta para obtener la imagen del producto mediante el id de la imagen.
                    $consultaImagen = $conexionBD->query("SELECT imagen FROM imagen WHERE id = " . $idImagen . ";");

                    if ($consultaImagen == true) {
                        $fila = $consultaImagen->fetch_assoc();
                        $imagen = isset($fila) && $fila != null ? $fila['imagen'] : "";
                    }

                    // Muestra los detalles del producto con los valores originales
                    echo "<div>
                            <h1>" . $nombreOriginal . "</h1>
                            <img src='data:image/jpeg;base64," . base64_encode($imagen) . "'/>
                            <p>Descripción: " . $descripcionOriginal . "</p>
                            <p>Precio: " . $precioOriginal . "</p>                 
                            <a href='Index.php'>Volver</a>
                            <a href='AniadirUnidadCarrito.php?nombre=" . urlencode($nombreProducto) . "'>Comprar</a>
                        </div>";

                    return $producto;
                }
            }
        }
        
        public static function mostrarDetallesEditar($productos){
            foreach ($productos as $producto) {
                $nombreProducto = $producto->getNombre();

                if ($nombreProducto == $_GET['nombre']) {
                    // Guardar los valores originales del producto en variables temporales
                    $nombreOriginal = $producto->getNombre();
                    $descripcionOriginal = $producto->getDescripcion();
                    $precioOriginal = $producto->getPrecio();
   
                    // Muestra los detalles del producto con los valores originales
                    echo "<div>
                            <h1>" . $nombreOriginal . "</h1>
                            <p>Descripción: " . $descripcionOriginal . "</p>
                            <p>Precio: " . $precioOriginal . "</p>                 
                            <a href='Index.php'>Volver</a>
                            <a href='AniadirUnidadCarrito.php?nombre=" . urlencode($nombreProducto) . "'>Comprar</a>
                        </div>";

                    return $producto;
                }
            }
        }

        public static function mostrarProductosAdmin($productos){
            echo "<div class='contenedor-productos'>";

            foreach ($productos as $producto) {
                $nombreProducto = $producto->getNombre();

                $conexionBD = TiendaDB::obtenerConexionBD();

                //Realiza una consulta para obtener la imagen del producto mediante el id de la imagen.
                $consultaImagen = $conexionBD->query("SELECT imagen FROM imagen WHERE id = " . $producto->getImagen() . ";");

                if ($consultaImagen == true) {
                    $fila = $consultaImagen->fetch_assoc();
                    $imagen = isset($fila) && $fila != null ? $fila['imagen'] : "";
                }

                echo "<div class='producto'>
                            <a class='visualizar' href='Producto.php?nombre=" . urlencode($nombreProducto) . "'>
                                <img src='data:image/jpeg;base64," . base64_encode($imagen) . "'/>
                                <br/>
                                <strong>" . $nombreProducto . "</strong>
                            </a>
            
                            <p>" . $producto->getDescripcion() . "</p>
            
                            " . $producto->getPrecio() .

                    "<br/>
            
                            <a class='boton' href='EditarProducto.php?nombre=" . urlencode($nombreProducto) . "'>Editar</a>
                            <a class='boton' href='EliminarProducto.php?nombre=" . urlencode($nombreProducto) . "'>Eliminar</a>
                        </div>";


                $conexionBD->close();
            }

            echo "</div>";
        }

        public static function insertarImagen($producto){
            $conexionBD = TiendaDB::obtenerConexionBD();

            // Asegúrate de verificar si la imagen está presente antes de intentar insertar.
            if (!empty($producto->getImagen())) {
                $insertarImagen = $conexionBD->query("INSERT INTO imagen (`imagen`) VALUES ('" . $producto->getImagen() . "');");
                if ($insertarImagen == true) {
                    $resultado = $conexionBD->query("SELECT LAST_INSERT_ID() as last_id;");
                    $fila = $resultado->fetch_assoc();
                    $id = $fila["last_id"];
                    $conexionBD->close();
                    Producto::insertarProducto($producto, $id);
                    return;
                }
            }
            $conexionBD->close();
            echo "<h2 style='color: red;'>No se ha podido añadir la imagen, inténtalo de nuevo.</h2>";
        }

        public static function insertarProducto($producto, $ultimoID){
            $conexionBD = TiendaDB::obtenerConexionBD();
            $insertarProducto = $conexionBD->query("INSERT INTO producto (`nombre`, `descripcion`, `precio`, `idimagen`) VALUES ('" . $producto->getNombre() . "','" . $producto->getDescripcion() . "','" . $producto->getPrecio() . "','" . $ultimoID . "');");
            if ($insertarProducto == true) {
                $conexionBD->close();
                // Usa ob_start al inicio del script si aún experimentas problemas con los headers.
                header("Location: Index.php");
                exit();
            } else {
                $conexionBD->close();
                echo "<h2 style='color: red;'>No se ha podido añadir el producto, inténtalo de nuevo.</h2>";
            }
        }

        public static function editarProducto($nombreProducto, $producto){
            $conexionBD = TiendaDB::obtenerConexionBD();

            // Obtén el ID de la imagen actual asociada al producto.
            $consultaIdImagen = $conexionBD->query("SELECT idimagen FROM producto WHERE nombre='$nombreProducto';");
            $filaIdImagen = $consultaIdImagen->fetch_assoc();
            $idImagen = $filaIdImagen['idimagen'];

            // Prepara la consulta de actualización del producto sin la imagen primero.
            $queryActualizarProducto = "UPDATE producto SET `nombre`='" . $producto->getNombre() . "', `descripcion`='" . $producto->getDescripcion() . "', `precio`='" . $producto->getPrecio() . "' WHERE nombre='$nombreProducto';";

            // Ejecuta la actualización del producto.
            $editarProducto = $conexionBD->query($queryActualizarProducto);

            // Verifica si se ha proporcionado una nueva ruta de imagen.
            $rutaImagen = $producto->getImagen();
            if (!empty($rutaImagen)) {
                // Solo actualiza la imagen si se ha proporcionado una nueva ruta.
                $actualizarImagen = $conexionBD->query("UPDATE imagen SET `imagen`='" . $producto->getImagen() . "' WHERE id='$idImagen';");
            } else {
                // Considera la actualización exitosa si no se necesita actualizar la imagen.
                $actualizarImagen = true;
            }

            if ($editarProducto == true && $actualizarImagen == true) {
                // Si todo fue exitoso, cierra la conexión de la base de datos y redirige.
                $conexionBD->close();
                header("Location: Index.php");
                exit();
            } else {
                // Si hubo un error, cierra la conexión y muestra un mensaje de error.
                $conexionBD->close();
                echo "<h2 style='color: red;'>No se ha podido editar el producto, inténtalo de nuevo.</h2>";
                // No redirigir aquí para permitir ver el mensaje de error.
            }
        }


        public static function eliminarProducto($nombreProducto){
            $conexionBD = $conexionBD = TiendaDB::obtenerConexionBD();

            //Se realiza la operación Delete para el nombre obtenido.
            $eliminarProducto = $conexionBD->query("DELETE FROM producto WHERE nombre='$nombreProducto';");

            if ($eliminarProducto == true) {
                //Se cierra la conexión de la base de datos y se redirige al index.
                $conexionBD->close();
                header("Location: Index.php");
                die();
            } else {
                //Se cierra la conexión y se muestra un mensaje de error.
                $conexionBD->close();
                echo "<h2 style='color: red;'>No se ha podido eliminar el producto, inténtalo de nuevo.</h2>";
            }
        }

        public static function mostrarProductosClientes($productos){
            echo "<div class='contenedor-productos'>";

            foreach ($productos as $producto) {
                $nombreProducto = $producto->getNombre();

                $conexionBD = $conexionBD = TiendaDB::obtenerConexionBD();

                //Realiza una consulta para obtener la imagen del producto mediante el id de la imagen.
                $consultaImagen = $conexionBD->query("SELECT imagen FROM imagen WHERE id = " . $producto->getImagen() . ";");

                if ($consultaImagen == true && isset($consultaImagen)) {
                    $fila = $consultaImagen->fetch_assoc();
                    $imagen = isset($fila) && $fila != null ? $fila['imagen'] : "";
                }

                echo "<div class='producto'>
                            <a class='visualizar' href='Producto.php?nombre=" . urlencode($nombreProducto) . "'>
                                <img src='data:image/jpeg;base64," . base64_encode($imagen) . "'/>
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

        public static function mostrarCarrito($productos){
            if (isset($_COOKIE['carrito'])) {
                $carrito = json_decode($_COOKIE['carrito'], true);

                if (!empty($carrito)) {
                    foreach ($carrito as $nombreProducto => $detalles) {
                        $cantidad = $detalles['cantidad'];
                        foreach ($productos as $producto) {
                            $conexionBD = $conexionBD = TiendaDB::obtenerConexionBD();
                            //Realiza una consulta para obtener la imagen del producto mediante el id de la imagen.
                            $consultaImagen = $conexionBD->query("SELECT imagen FROM imagen WHERE id = " . $producto->getImagen() . ";");

                            if ($consultaImagen == true) {
                                $fila = $consultaImagen->fetch_assoc();
                                $imagen = isset($fila) && $fila != null ? $fila['imagen'] : "";
                            }

                            if ($producto->getNombre() == $nombreProducto) {
                                echo "<div class='producto-carrito' style='margin-left: 3vw; margin-top: 2vh;'>
                                            <img src='data:image/jpeg;base64," . base64_encode($imagen) . "' width='100' height='140'>
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
    }

    ob_end_flush();
