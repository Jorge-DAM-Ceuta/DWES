<?php
    include_once("./clases/Cancion.php");
    include_once("./clases/Disco.php");

/*
    TERMINADO[
        REGISTRAR USUARIO
        INICIAR SESION
        CERRAR SESION

        CARGAR CANCIONES
        AÑADIR CANCIÓN
        ELIMINAR CANCIóN
        EDITAR CANCIÓN
        AÑADIR A LISTA
        MARCAR FAVORITA
        DESMARCAR DE FAVORITOS
        AUTOCARGAR CARATULA DE DISCO EN CANCION
        ASIGNAR IMAGEN POR DEFECTO

        CARGAR LISTAS
        CREAR LISTA
        EDITAR LISTA
        ELIMINAR LISTA
        ACCEDER A UNA LISTA Y CARGAR CANCIONES
        ELIMINAR CANCIÓN DE LISTA

        CARGAR DISCOS
        CREAR UN DISCO
        EDITAR UN DISCO
        ELIMINAR UN DISCO
    ]
*/

//USUARIOS
    function registrarUsuario($username, $email, $password){
        $usuarioExistente = false;
        $emailExistente = false;

        $rutaJSON = "./json/Usuarios.json";
        $jsonString = file_get_contents($rutaJSON);
        $usuarios = json_decode($jsonString, true);

        //Comprobar que no exista el usuario.
        foreach($usuarios as $elemento){
            if($username == $elemento['username']){
                $usuarioExistente = true;
            }
        }

        //Comprobar que no exista el email.
        foreach($usuarios as $elemento){
            if($email == $elemento['email']){
                $emailExistente = true;
            }
        }

        if($usuarioExistente == false && filter_var($email, FILTER_VALIDATE_EMAIL)){
            if($emailExistente == false){
                array_push($usuarios, array("username" => $username, "email" => $email, "password" => password_hash($password, PASSWORD_ARGON2I), "listas_reproduccion" => array("Favoritos" => array())));

                $jsonString = json_encode($usuarios, JSON_PRETTY_PRINT);
                file_put_contents($rutaJSON, $jsonString);  

                echo "<h2>Te has registrado correctamente</h2>";
            }else{
                echo "<h2>Ya existe una cuenta con ese email</h2>";        
            }
        }else{
            echo "<h2>Ya existe una cuenta con ese nombre</h2>";
        }
    }

    function iniciarSesion($username, $password){
        $rutaJSON = "./json/Usuarios.json";
        $jsonString = file_get_contents($rutaJSON);
        $usuarios = json_decode($jsonString, true);

        $autenticacion = false;

        foreach($usuarios as $elemento){
            // Comprobar si el username es un email.
            if(filter_var($username, FILTER_VALIDATE_EMAIL)) {
                if ($elemento['email'] == $username && password_verify($password, $elemento['password'])) {
                    $autenticacion = true;
    
                    session_start();
    
                    // Se guarda el username en la sesión.
                    $_SESSION['usuario'] = [
                        'username' => $elemento['username'],
                    ];
    
                    header("Location: Index.php");
                    die();
                }
            } else {
                if ($elemento['username'] == $username && password_verify($password, $elemento['password'])) {
                    $autenticacion = true;
    
                    session_start();
    
                    // Se guarda el username en la sesión.
                    $_SESSION['usuario'] = [
                        'username' => $elemento['username'],
                    ];
    
                    header("Location: Index.php");
                    die();
                }
            }
        }
        
        if($autenticacion == false){
            echo "<h2 style='color: red;'>Usuario o contraseña incorrectos</h2>";
        }
    }

/*--------------------------------------------------------------------------------------REPRODUCTOR----------------------------------------------------------------------------------------*/
    
//OBTENER DATOS
    function decodificarCanciones(){
        $ruta = "./json/Canciones.json";
        $canciones = json_decode(file_get_contents($ruta), true);
        
        return $canciones;
    }

    function instanciarCanciones($cancionesJSON){
        $arrayCanciones = array();

        if(isset($cancionesJSON) && count($cancionesJSON) > 0){
            foreach($cancionesJSON as $cancionJSON){
                $cancion = new Cancion($cancionJSON["id"], $cancionJSON["titulo"], $cancionJSON["artista"], $cancionJSON["colaboracion"], $cancionJSON["duracion"], $cancionJSON["favorita"], $cancionJSON["imagen"], $cancionJSON["audio"]);
                array_push($arrayCanciones, $cancion);
            }
        }

        return $arrayCanciones;
    }

    function decodificarDiscos(){
        $ruta = "./json/Discos.json";
        $discos = json_decode(file_get_contents($ruta), true);
        
        return $discos;
    }

    function instanciarDiscos($discosJSON){
        $arrayDiscos = array();

        foreach($discosJSON as $discoJSON){
            $disco = new Disco($discoJSON["id"], $discoJSON["titulo"], $discoJSON["artista"], $discoJSON["anio"], $discoJSON["canciones"], $discoJSON["imagen"]);
            array_push($arrayDiscos, $disco);
        }

        return $arrayDiscos;
    }

//CANCIONES
    function mostrarCanciones($canciones){ 
        echo "<div class='contenedorCanciones'>"; 
        
        foreach($canciones as $cancion){
            $esFavorita = esFavorita($cancion->getID());

            $imagen = $cancion->getRutaImagen() != "" ? $cancion->getRutaImagen() : "../assets/imagenes/imagen_defecto.jpg"; 
            $colaboradores = obtenerColaboracion($cancion) != "" ? " ft. " . obtenerColaboracion($cancion) : "";

            echo "<div class='cancion'>
                    <img src='$imagen'/>
                    <p><strong>" . $cancion->getTitulo() . "</strong>" . $colaboradores . "</p> 
                    <p>" . $cancion->getArtista() . "</p> 
                    <p>Duración: " . $cancion->getDuracion() . " minutos</p>"
                    . ($esFavorita == true ? "<a href='Eliminar_de_favoritos.php?id=" . urlencode($cancion->getID()). "&ubicacion=Index.php'><i class='fas fa-star'></i></a>" : "<a href='Aniadir_a_favoritos.php?id=" . urlencode($cancion->getID()). "&ubicacion=Index.php'><i class='far fa-star'></i></a>") .
                    "<audio controls>
                        <source src='" . $cancion->getRutaAudio() . "' type='audio/mp3'>
                    </audio>
                
                    <div class='botones-accion'> 
                        <a class='boton' href='Editar_cancion.php?id=" . urlencode($cancion->getID()) . "'>Editar</a> 
                        <a class='boton' href='Aniadir_a_lista.php?id=" . urlencode($cancion->getID()) . "'>Añadir a lista</a> 
                        <a class='boton' href='Eliminar_cancion.php?id=" . urlencode($cancion->getID()) . "'>Eliminar canción</a> 
                    </div> 
                </div>"; 
        } 

        echo "</div>"; 
    }

    //ASIGNAR CARATULA DE DISCO A LA CANCIÓN
    function asignarCaratulaDisco(){
        $cancionesJSON = decodificarCanciones();
        $canciones = instanciarCanciones(decodificarCanciones());
        $discos = instanciarDiscos(decodificarDiscos());

        foreach ($canciones as &$cancion) {
            foreach ($discos as $disco) {
                foreach ($disco->getCanciones() as $cancionDelDisco) {
                    if ($cancionDelDisco == $cancion->getTitulo()) {

                        $cancionActualizada = array(
                            "id" => $cancion->getID(),
                            "titulo" => $cancion->getTitulo(),
                            "artista" => $cancion->getArtista(),
                            "colaboracion" => $cancion->getColaboracion(),
                            "duracion" => $cancion->getDuracion(),
                            "favorita" => $cancion->getFavorita(),
                            "imagen" => $disco->getRutaImagen(),
                            "audio" => $cancion->getRutaAudio()
                        );

                        foreach ($cancionesJSON as $indice => $cancionJSON) {
                            if ($cancionJSON['id'] == $cancion->getID() && $disco->getRutaImagen() != "") {
                                $cancionesJSON[$indice] = $cancionActualizada;
                                break;
                            }
                        }
    
                        break;
                    }
                }
            }
        }

        $jsonCanciones = json_encode($cancionesJSON, JSON_PRETTY_PRINT);
        file_put_contents("./json/Canciones.json", $jsonCanciones);
        
    }

    //MOSTRAR CANCIÓN POR ID DEL ARRAY CANCIONES
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
                    </div>"; 
                
                return $cancion;
            }
        } 
    }

    //OBTENER CANCIÓN POR ID DEL JSON
    function obtenerCancionJSON($arrayJSON, $idCancion){
        foreach($arrayJSON as $cancion){
            if($cancion["id"] == $idCancion){
                return $cancion;
            }
        }
    }

    //OBTIENE EL ID DE LA ÚLTIMA CANCIÓN
    function obtenerUltimoID($arrayJSON){
        if(isset($arrayJSON) && count($arrayJSON) > 0){
            return end($arrayJSON)["id"];
        }else{
            return "1";
        }
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

    function esFavorita($idCancion){
        $username = $_SESSION['usuario']['username'];
    
        $rutaJSON = "./json/Usuarios.json";
        $jsonString = file_get_contents($rutaJSON);
        $usuarios = json_decode($jsonString, true);
    
        foreach($usuarios as $usuario){
            if($usuario["username"] == $username){
                if(isset($usuario["listas_reproduccion"]["Favoritos"]) && is_array($usuario["listas_reproduccion"]["Favoritos"])){
                    foreach($usuario["listas_reproduccion"]["Favoritos"] as $cancion){
                        if(isset($cancion["id"]) && $cancion["id"] == $idCancion){
                            return true;
                        }
                    }
                }
            }
        }
    
        return false;
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
            "imagen" => $nuevaCancion->getRutaImagen(),
            "audio" => $nuevaCancion->getRutaAudio()
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

    function eliminarCancion($idCancion){
        $rutaJSON = "./json/Canciones.json";
        $jsonString = file_get_contents($rutaJSON);
        $canciones = json_decode($jsonString, true);

        eliminarCancionDeListas($idCancion);

        foreach($canciones as $key => $cancion) {
            if($cancion['id'] == $idCancion) {
                unset($canciones[$key]);
                
                $jsonString = json_encode($canciones, JSON_PRETTY_PRINT);
                file_put_contents($rutaJSON, $jsonString);
                
                header("Location: Index.php");
                exit();
            }
        }
    }

    function eliminarCancionDeListas($idCancion) {
        $rutaJSONUsuarios = "./json/Usuarios.json";
        $jsonStringUsuarios = file_get_contents($rutaJSONUsuarios);
        $usuarios = json_decode($jsonStringUsuarios, true);
    
        foreach ($usuarios as &$usuario) {
            if (isset($usuario["listas_reproduccion"])) {
                foreach ($usuario["listas_reproduccion"] as $nombreLista => &$canciones) {
                    foreach ($canciones as $key => $cancion) {
                        if ($cancion['id'] == $idCancion) {
                            unset($usuario["listas_reproduccion"][$nombreLista][$key]);
    
                            $jsonStringUsuarios = json_encode($usuarios, JSON_PRETTY_PRINT);
                            file_put_contents($rutaJSONUsuarios, $jsonStringUsuarios);
                        }
                    }
                }
            }
        }
    }

//LISTAS DE REPRODUCCIÓN
    /*MOSTRAR LAS LISTAS DEL USUARIO*/
    function obtenerListasUsurio($username){
        $rutaJSON = "./json/Usuarios.json";
        $jsonString = file_get_contents($rutaJSON);
        $usuarios = json_decode($jsonString, true);

        foreach($usuarios as $usuario){
            if($usuario["username"] == $username){
                $listas = $usuario["listas_reproduccion"];
            }
        }

        return $listas;
    }

    function mostrarListasReproduccion($listasReproduccion){
        if (!empty($listasReproduccion)) {
            echo "<div class='contenedor-listas'>";
            
            foreach($listasReproduccion as $nombreLista => $canciones){
                echo "<div class='lista-enlace'>
                        <a href='Mostrar_lista.php?nombreLista=" . urlencode($nombreLista) . "' class='nombre'>$nombreLista</a>";
                        
                if($nombreLista != "Favoritos"){
                    echo "<div class='botones-accion'> 
                            <a class='boton' href='Editar_lista.php?nombreLista=" . urlencode($nombreLista) . "'>Editar</a> 
                            <a class='boton' href='Eliminar_lista.php?nombreLista=" . urlencode($nombreLista) . "'>Eliminar</a> 
                        </div>";
                    }

                echo "</div>";
            }

            echo "</div>";
        } else {
            echo "<p>No hay listas de reproducción disponibles.</p>";
        }
    }

    function selectListasReproduccion($listasReproduccion){
        if (!empty($listasReproduccion)) {
            echo "<select name='nombreListaSelect'>";
            foreach ($listasReproduccion as $nombreLista => $canciones) {
                echo "<option value='" . urlencode($nombreLista) . "'>$nombreLista</option>";
            }
            echo "</select>";
        } else {
            echo "<p>No hay listas de reproducción disponibles.</p>";
        }
    }

    function aniadirListaReproduccion($username, $nombreLista){
        $rutaJSON = "./json/Usuarios.json";
        $jsonString = file_get_contents($rutaJSON);
        $usuarios = json_decode($jsonString, true);

        foreach($usuarios as &$usuario){
            if($usuario["username"] == $username){
                $usuario["listas_reproduccion"][$nombreLista] = [];
            }
        }

        $jsonString = json_encode($usuarios, JSON_PRETTY_PRINT);
        file_put_contents($rutaJSON, $jsonString);

        header("Location: Listas_reproduccion.php");
        die();
    }

    function editarListaReproduccion($username, $nombreActual, $nuevoNombre){
        $rutaJSON = "./json/Usuarios.json";
        $jsonString = file_get_contents($rutaJSON);
        $usuarios = json_decode($jsonString, true);

        foreach($usuarios as &$usuario){
            if($usuario["username"] == $username){
                
                //Crear una nueva lista con el contenido de la lista actual
                $usuario["listas_reproduccion"][$nuevoNombre] = $usuario["listas_reproduccion"][$nombreActual];
                
                //Eliminar la lista antigua
                unset($usuario["listas_reproduccion"][$nombreActual]);
            }
        }

        $jsonString = json_encode($usuarios, JSON_PRETTY_PRINT);
        file_put_contents($rutaJSON, $jsonString);

        header("Location: Listas_reproduccion.php");
        die();
    }

    function eliminarListaReproduccion($username, $nombreLista){
        $rutaJSON = "./json/Usuarios.json";
        $jsonString = file_get_contents($rutaJSON);
        $usuarios = json_decode($jsonString, true);

        foreach($usuarios as &$usuario){
            if($usuario["username"] == $username){
                unset($usuario["listas_reproduccion"][$nombreLista]);
            }
        }

        $jsonString = json_encode($usuarios, JSON_PRETTY_PRINT);
        file_put_contents($rutaJSON, $jsonString);

        header("Location: Listas_reproduccion.php");
        die();
    }

    function obtenerCancionesLista($username, $nombreLista){
        $rutaJSON = "./json/Usuarios.json";
        $jsonString = file_get_contents($rutaJSON);
        $usuarios = json_decode($jsonString, true);

        foreach($usuarios as $usuario){
            if($usuario["username"] == $username){
                if(isset($usuario["listas_reproduccion"][$nombreLista])){
                    return $usuario["listas_reproduccion"][$nombreLista];
                }
            }
        }
    
        return array();
    }

    function mostrarCancionesLista($arrayCanciones, $nombreLista){
        echo "<div class='contenedorCanciones'>"; 
        
        foreach($arrayCanciones as $cancionJSON){
            $id = $cancionJSON["id"];
            $titulo = $cancionJSON["titulo"];
            $artista = $cancionJSON["artista"];
            $colaboracion = $cancionJSON["colaboracion"];
            $duracion = $cancionJSON["duracion"];
            $imagen = $cancionJSON["imagen"];
            $audio = $cancionJSON["audio"];

            $cancion = new Cancion($id, $titulo, $artista, $colaboracion, $duracion, false, $imagen, $audio);

            $esFavorita = esFavorita($cancion->getID());

            $imagen = $cancion->getRutaImagen() != "" ? $cancion->getRutaImagen() : "../assets/imagenes/imagen_defecto.jpg"; 
            $colaboradores = obtenerColaboracion($cancion) != "" ? " ft. " . obtenerColaboracion($cancion) : "";

            echo "<div class='cancion'>
                    <img src='$imagen'/>
                    <p><strong>" . $cancion->getTitulo() . "</strong>" . $colaboradores . "</p> 
                    <p>" . $cancion->getArtista() . "</p> 
                    <p>Duración: " . $cancion->getDuracion() . " minutos</p>"
                    . ($esFavorita == true ? "<a href='Eliminar_de_favoritos.php?id=" . urlencode($cancion->getID()). "&nombreLista=$nombreLista'><i class='fas fa-star'></i></a>" : "<a href='Aniadir_a_favoritos.php?id=" . urlencode($cancion->getID()). "&nombreLista=$nombreLista'><i class='far fa-star'></i></a>") .
                    "<audio controls>
                        <source src='" . $cancion->getRutaAudio() . "' type='audio/mp3'>
                    </audio>
                
                    <div class='botones-accion'> 
                        <a class='boton' href='Editar_cancion.php?id=" . urlencode($cancion->getID()) . "'>Editar</a> 
                        <a class='boton' href='Aniadir_a_lista.php?id=" . urlencode($cancion->getID()) . "'>Añadir a lista</a> 
                        <a class='boton' href='Eliminar_de_lista.php?id=" . urlencode($cancion->getID()) . "&nombreLista=$nombreLista'>Eliminar de lista</a> 
                    </div> 
                </div>"; 
        } 

        echo "</div>"; 
    }

    function aniadirCancionALista($username, $nombreLista, $cancion){
        $rutaJSON = "./json/Usuarios.json";
        $jsonString = file_get_contents($rutaJSON);
        $usuarios = json_decode($jsonString, true);

        foreach($usuarios as &$usuario){
            if($usuario["username"] == $username){
                $usuario["listas_reproduccion"][$nombreLista][] = $cancion;
            }
        }

        $jsonString = json_encode($usuarios, JSON_PRETTY_PRINT);
        file_put_contents($rutaJSON, $jsonString);

        header("Location: Index.php");
        die();
    }

    function aniadirCancionAFavoritos($username, $cancion){
        $rutaJSON = "./json/Usuarios.json";
        $jsonString = file_get_contents($rutaJSON);
        $usuarios = json_decode($jsonString, true);

        foreach($usuarios as &$usuario){
            if($usuario["username"] == $username){
                $usuario["listas_reproduccion"]["Favoritos"][] = $cancion;
            }
        }

        $jsonString = json_encode($usuarios, JSON_PRETTY_PRINT);
        file_put_contents($rutaJSON, $jsonString);
    }

    function eliminarCancionDeFavoritos($username, $idCancion){
        $rutaJSON = "./json/Usuarios.json";
        $jsonString = file_get_contents($rutaJSON);
        $usuarios = json_decode($jsonString, true);
    
        foreach($usuarios as &$usuario){
            if($usuario["username"] == $username){
                if(isset($usuario["listas_reproduccion"]["Favoritos"])){
                    foreach($usuario["listas_reproduccion"]["Favoritos"] as $key => $cancion){
                        if(isset($cancion["id"]) && $cancion["id"] == $idCancion){
                            unset($usuario["listas_reproduccion"]["Favoritos"][$key]);
                        }
                    }
                }
            }
        }
    
        $jsonString = json_encode($usuarios, JSON_PRETTY_PRINT);
        file_put_contents($rutaJSON, $jsonString);
    }

    function eliminarCancionDeLista($username, $nombreLista, $idCancion){
        $rutaJSON = "./json/Usuarios.json";
        $jsonString = file_get_contents($rutaJSON);
        $usuarios = json_decode($jsonString, true);
    
        foreach($usuarios as &$usuario){
            if($usuario["username"] == $username){
                if(isset($usuario["listas_reproduccion"][$nombreLista])){
                    foreach($usuario["listas_reproduccion"][$nombreLista] as $key => $cancion){
                        if(isset($cancion["id"]) && $cancion["id"] == $idCancion){
                            unset($usuario["listas_reproduccion"][$nombreLista][$key]);
                        }
                    }
                }
            }
        }
    
        $jsonString = json_encode($usuarios, JSON_PRETTY_PRINT);
        file_put_contents($rutaJSON, $jsonString);

        header("Location: Mostrar_lista.php?nombreLista=$nombreLista");
        die();
    }
    
//DISCOS
    function mostrarDiscos(){
        $discos = instanciarDiscos(decodificarDiscos());

        echo "<div class='contenedorCanciones'>"; 

        foreach($discos as $disco){
            $imagen = $disco->getRutaImagen() != "" ? $disco->getRutaImagen() : "../assets/imagenes/imagen_defecto.jpg"; 

            echo "<div class='cancion'>
                    <img src='$imagen'/>
                    <p><strong>" . $disco->getTitulo() . "</strong></p> 
                    <p>" . $disco->getArtista() . "</p> 
                    <p>Año: " . $disco->getAnio() . "</p>
                    <details>
                        <summary>Canciones</summary>";
                    
                    $contador = 1;
                    foreach($disco->getCanciones() as $cancion){
                        echo "<p>" . $contador . ". " . $cancion . "</p>";
                        $contador++;
                    }

                echo "</details>
                    <div class='botones-accion'> 
                        <a class='boton' href='Editar_disco.php?id=" . urlencode($disco->getID()) . "'>Editar</a> 
                        <a class='boton' href='Eliminar_disco.php?id=" . urlencode($disco->getID()) . "'>Eliminar</a> 
                    </div> 
                </div>"; 
        }
        echo "</div>"; 
    }

    //OBTIENE EL ID DE LA ÚLTIMA CANCIÓN
    function obtenerUltimoID_Disco($arrayJSON):int{
        return end($arrayJSON)["id"];
    }

    function aniadirDisco($arrayJSON, $nuevoDisco){
        $nuevoDiscoJSON = array(
            "id" => $nuevoDisco->getID(),
            "titulo" => $nuevoDisco->getTitulo(),
            "artista" => $nuevoDisco->getArtista(),
            "anio" => $nuevoDisco->getAnio(),
            "canciones" => $nuevoDisco->getCanciones(),
            "imagen" => $nuevoDisco->getRutaImagen()
        );

        $arrayJSON[] = $nuevoDiscoJSON;

        $jsonString = json_encode($arrayJSON, JSON_PRETTY_PRINT);
        file_put_contents("./json/Discos.json", $jsonString);

        header("Location: Mostrar_discos.php");
        die();
    }

    function editarDisco($disco){
        $discosJSON = decodificarDiscos();

        foreach ($discosJSON as &$discoJson) {
            // Verificar si el ID coincide
            if ($discoJson["id"] == $disco->getID()) {

                $discoJson["titulo"] = $disco->getTitulo();
                $discoJson["artista"] = $disco->getArtista();
                $discoJson["anio"] = $disco->getAnio();
                $discoJson["canciones"] = $disco->getCanciones();
                $discoJson["imagen"] = $disco->getRutaImagen();
            }
        }

        $jsonString = json_encode($discosJSON, JSON_PRETTY_PRINT);
        file_put_contents("./json/Discos.json", $jsonString);
        
        header("Location: Mostrar_discos.php");
        exit();
    }

    //MOSTRAR DISCO POR ID DEL ARRAY DISCOS
    function mostrarDisco_ID($arrayDiscos, $idDisco){
        foreach($arrayDiscos as $disco){
            if($disco->getID() == $idDisco){
                $imagen = $disco->getRutaImagen() != "" ? $disco->getRutaImagen() : "../assets/imagenes/imagen_defecto.jpg"; 

                echo "<div class='cancion'>
                        <img src='$imagen'/>
                        <p>" . $disco->getTitulo() . "</p> 
                        <p>" . $disco->getArtista() . "</p> 
                        <p>Año: " . $disco->getAnio() . "</p>
                        <details>
                            <summary>Canciones</summary>";
                        
                        $contador = 1;
                        foreach($disco->getCanciones() as $cancion){
                            echo "<p>" . $contador . ". " . $cancion . "</p>";
                            $contador++;
                        }

                    echo "</details>
                    </div>"; 
                
                return $disco;
            }
        } 
    }

    function eliminarDisco($idDisco){
        $rutaJSON = "./json/Discos.json";
        $jsonString = file_get_contents($rutaJSON);
        $discos = json_decode($jsonString, true);

        foreach($discos as $key => $disco) {
            if($disco['id'] == $idDisco) {
                unset($discos[$key]);
                
                $jsonString = json_encode($discos, JSON_PRETTY_PRINT);
                file_put_contents($rutaJSON, $jsonString);
                
                header("Location: Mostrar_discos.php");
                exit();
            }
        }
    }
?>