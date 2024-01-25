<?php
include_once("./clases/Cancion.php");

/*
    TERMINADO[
        REGISTRAR USUARIO
        INICIAR SESION
        CERRAR SESION

        CARGAR CANCIONES
        AÑADIR CANCIÓN
        ELIMINAR CANCIóN
        EDITAR CANCIÓN
    ]

    FALTA[
        //USUARIOS
            Añadir email.
            Al registrar un usuario añadir: array listas de reproducción y el subarray favoritos

        //CANCION
            Al editar añadir un boton para restablecer la imagen por defecto

            DESMARCAR / MARCAR FAVORITA
                Al mostrar las canciones no aparecen favoritas,
                al marcar una en favoritas no se modificara su valor
                en el objeto que se muestra ni en el json canciones.
                En caso de marcar favorita se cambia el icono y en el
                json usuarios se añade una lista de reproduccion llamada
                favoritos, se coge el objeto de la canción, y se clona,
                luego se hace un setFavoritos true y se añade el objeto a
                la lista de reproduccion. 
            
        //LISTAS DE REPRODUCCION
            CREAR LISTA
            EDITAR NOMBRE DE LISTA
            ACCEDER A UNA LISTA Y CARGAR CANCIONES
            ELIMINAR UNA LISTA

        //DISCOS
            CREAR UN DISCO
            EDITAR UN DISCO
                EDITAR TITULO
                EDITAR CANCIONES
                EDITAR CARATULA
                CAMBIAR AUTOR
                CAMBIAR DISCOGRAFIA
            BORRAR UN DISCO
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
            $colaboradores = obtenerColaboracion($cancion) != "" ? " ft. " . obtenerColaboracion($cancion) : "";

            echo "<div class='cancion'>
                    <img src='$imagen'/>
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

    //MOSTRAR CANCIÓN POR ID
    function obtenerCancion($arrayCanciones, $idCancion){
        foreach($arrayCanciones as $cancion){
            if($cancion->getID() == $idCancion){
                $imagen = $cancion->getRutaImagen() != "" ? $cancion->getRutaImagen() : "../assets/imagenes/imagen_defecto.jpg"; 
                $colaboradores = obtenerColaboracion($cancion) != "" ? " ft. " . obtenerColaboracion($cancion) : "";

                echo "<div class='cancion'>
                        <img src='$imagen'/>
                        <p>" . $cancion->getTitulo() . $colaboradores . "</p> 
                        <p>" . $cancion->getArtista() . "</p> 
                        <p>Duración: " . $cancion->getDuracion() . " minutos</p> 
                        <p>Favorita: " . ($cancion->getFavorita() ? 'Sí' : 'No') . "</p> 
                    </div>"; 
                
                return $cancion;
            }
        } 
    }

    //OBTIENE EL ID DE LA ÚLTIMA CANCIÓN
    function obtenerUltimoID($arrayJSON):int{
        return end($arrayJSON)["id"];
    }

    //OBTENER LA COLABORACIÓN DE UNA CANCIÓN
    function obtenerColaboracion($cancion){
        $colaboracion = "";

        if(!empty($cancion->getColaboracion())){
            if(count($cancion->getColaboracion()) == 1){
                $colaboracion = $cancion->getColaboracion()[0];
            }else{
                $colaboracion = implode(', ', $cancion->getColaboracion());
            }
        }else{
            $colaboracion = "";
        }

        return $colaboracion;
    }

    //OBTIENE EL NUMERO DE COLABORACIONES DEL FORMULARIO PARA SUSTITUIRLA EN LA CANCIÓN
    function obtenerNumeroColaboraciones($colaboracion){
        if(str_contains($colaboracion, ",")){
            return "Varios";
        }else{
            return "Uno";
        }
    }

    //AÑADIR CANCIÓN
    function aniadir_cancion($arrayJSON, $nuevaCancion){
        $nuevaCancionJSON = array(
            "id" => $nuevaCancion->getID(),
            "titulo" => $nuevaCancion->getTitulo(),
            "artista" => $nuevaCancion->getArtista(),
            "colaboracion" => $nuevaCancion->getColaboracion(),
            "duracion" => $nuevaCancion->getDuracion(),
            "favorita" => $nuevaCancion->getFavorita(),
            "imagen" => $nuevaCancion->getRutaImagen()
        );

        $arrayJSON[] = $nuevaCancionJSON;

        $jsonString = json_encode($arrayJSON, JSON_PRETTY_PRINT);
        file_put_contents("./json/Canciones.json", $jsonString);

        header("Location: Index.php");
        die();
    }

    //EDITA LA INFORMACIÓN DE LA CANCIÓN
    function editarCancion($cancion){
        $cancionesJSON = decodificarCanciones();

        foreach ($cancionesJSON as &$cancionJson) {
            // Verificar si el ID coincide
            if ($cancionJson["id"] == $cancion->getID()) {

                $cancionJson["titulo"] = $cancion->getTitulo();
                $cancionJson["artista"] = $cancion->getArtista();
                $cancionJson["colaboracion"] = $cancion->getColaboracion();
                $cancionJson["duracion"] = $cancion->getDuracion();
                $cancionJson["favorita"] = $cancion->getFavorita();
                $cancionJson["imagen"] = $cancion->getRutaImagen();
            }
        }

        $jsonString = json_encode($cancionesJSON, JSON_PRETTY_PRINT);
        file_put_contents("./json/Canciones.json", $jsonString);
        
        header("Location: Index.php");
        exit();

    }


/*------------------------------------------------------------------------------------------------------*/
//LISTAS DE REPRODUCCIÓN
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