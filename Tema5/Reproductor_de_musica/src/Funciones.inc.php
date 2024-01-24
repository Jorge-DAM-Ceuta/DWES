<?php
include_once("./clases/Cancion.php");

/*
    TERMINADO[
        REGISTRAR USUARIO
        INICIAR SESION
        CERRAR SESION
        CARGAR CANCIONES
        ELIMINAR CANCIONES
    ]

    FALTA[
        //CANCION
            EDITAR INFO CANCION
            DESMARCAR / MARCAR FAVORITA
            
        //LISTAS DE REPRODUCCION
            CREAR LISTA
            EDITAR NOMBRE DE LISTA
            ACCEDER A UNA LISTA Y CARGAR CANCIONES
            ELIMINAR UNA LISTA

        //DISCOS
            CREAR UN DISCO
            EDITAR UN DISCO
    ]
*/

//USUARIOS
    function registrarUsuario($username, $password){
        $usuarioExistente = false;

        $rutaJSON = "./json/Usuarios.json";
        $jsonString = file_get_contents($rutaJSON);
        $usuarios = json_decode($jsonString, true);

        //Comprobar que no exista el usuario.
        foreach($usuarios as $elemento){
            if($username == $elemento['username']){
                $usuarioExistente = true;
            }
        }

        if($usuarioExistente == false){
            array_push($usuarios, array("username" => $username, "password" => password_hash($password, PASSWORD_ARGON2I)));

            $jsonString = json_encode($usuarios, JSON_PRETTY_PRINT);
            file_put_contents($rutaJSON, $jsonString);  

            echo "<h2>Te has registrado correctamente</h2>";
        }
    }

    function iniciarSesion($username, $password){
        $rutaJSON = "./json/Usuarios.json";
        $jsonString = file_get_contents($rutaJSON);
        $usuarios = json_decode($jsonString, true);

        $autenticacion = false;

        foreach($usuarios as $elemento){
            if($elemento['username'] == $username && password_verify($password, $elemento['password']) == true){
                $autenticacion = true;

                session_start();

                $_SESSION['usuario'] = [
                    'username' => $elemento['username'],
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

/*------------------------------------------------------------------------------------------*/

//REPRODUCTOR

    function decodificarCanciones(){
        $ruta = "./json/Canciones.json";
        $canciones = json_decode(file_get_contents($ruta), true);
        
        return $canciones;
    }

    function instanciarCanciones($cancionesJSON){
        $arrayCanciones = array();

        foreach($cancionesJSON as $cancionJSON){
            $cancion = new Cancion($cancionJSON["id"], $cancionJSON["titulo"], $cancionJSON["artista"], $cancionJSON["colaboracion"], $cancionJSON["duracion"], $cancionJSON["favorita"], $cancionJSON["imagen"]);
            array_push($arrayCanciones, $cancion);
        }

        return $arrayCanciones;
    }

    function decodificarDiscos(){
        $ruta = "./json/Discos.json";
        $discos = json_decode(file_get_contents($ruta), true);
        
        return $discos;
    }

    /*MOSTRAR DETALLES / REPORDUCIR CANCIÓN*/
    function mostrarCanciones($canciones){ 
        echo "<div class='contenedorCanciones'>"; 
        
        foreach($canciones as $cancion){
            $imagen = $cancion->getRutaImagen() != "" ? $cancion->getRutaImagen() : "../assets/imagenes/imagen_defecto.jpg"; 
            $colaboradores = !empty($cancion->getColaboracion()) ? " ft. " . implode(', ', $cancion->getColaboracion()) : ""; 

            echo "<div class='cancion'>
                    <img src='$imagen'>
                    <p>" . $cancion->getTitulo() . $colaboradores . "</p> 
                    <p>" . $cancion->getArtista() . "</p> 
                    <p>Duración: " . $cancion->getDuracion() . " minutos</p> 
                    <p>Favorita: " . ($cancion->getFavorita() ? 'Sí' : 'No') . "</p> 
                
                    <div class='botones-accion'> 
                        <a class='boton' href='Editar_cancion.php?id=" . urlencode($cancion->getID()) . "'>Editar</a> 
                        <a class='boton' href='Eliminar_cancion.php?id=" . urlencode($cancion->getID()) . "'>Eliminar</a> 
                    </div> 
                </div>"; 
        } 

        echo "</div>"; 
    }

    /*MOSTRAR LAS LISTAS CORRESPONDIENTES OBTENIDAS DE LAS COOKIES*/
    function mostrarListasReproduccion($productos){
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