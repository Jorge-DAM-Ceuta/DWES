<?php
    require_once("Cancion.php");

    class Usuario{
        private string $username;
        private string $email;
        private string $password;
        private array $listas;
        private array $cancionesFavoritas;

        public function __construct($username, $email, $password, $cancionesFavoritas = []){
            $this->username = $username;
            $this->email = $email;
            $this->password = $password;
            $this->cancionesFavoritas = $cancionesFavoritas;
        }

        public function getUsername(){
            return $this->username;
        }
        public function setUsername($username){
            $this->username = $username;
        }

        public function getEmail(){
            return $this->email;
        }
        public function setEmail($email){
            $this->email = $email;
        }

        public function getPassword(){
            return $this->password;
        }
        public function setPassword($password){
            $this->password = $password;
        }

        public function getCancionesFavoritas(){
            return $this->cancionesFavoritas;
        }
        public function setCancionesFavoritas($cancionesFavoritas){
            $this->cancionesFavoritas = $cancionesFavoritas;
        }

        public function getList(){
            return $this->listas;
        }
        public function setList($listas){
            $this->listas = $listas;
        }

        public static function obtenerListasUsuario($username){
            $rutaJSON = "./json/Usuarios.json";
            $jsonString = file_get_contents($rutaJSON);
            $usuarios = json_decode($jsonString, true);
            $listas = [];

            foreach ($usuarios as $usuario) {
                if ($usuario["username"] == $username) {
                    $listas = $usuario["listas_reproduccion"];
                }
            }

            return $listas;
        }

        public static function registrarUsuario($username, $email, $password){
            $usuarioExistente = false;
            $emailExistente = false;

            $rutaJSON = "./json/Usuarios.json";
            $jsonString = file_get_contents($rutaJSON);
            $usuarios = json_decode($jsonString, true);

            //Comprobar que no exista el usuario.
            foreach ($usuarios as $elemento) {
                if ($username == $elemento['username']) {
                    $usuarioExistente = true;
                }
            }

            //Comprobar que no exista el email.
            foreach ($usuarios as $elemento) {
                if ($email == $elemento['email']) {
                    $emailExistente = true;
                }
            }

            if ($usuarioExistente == false && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if ($emailExistente == false) {
                    array_push($usuarios, array("username" => $username, "email" => $email, "password" => password_hash($password, PASSWORD_ARGON2I), "listas_reproduccion" => array("Favoritos" => array())));

                    $jsonString = json_encode($usuarios, JSON_PRETTY_PRINT);
                    file_put_contents($rutaJSON, $jsonString);

                    echo "<h2>Te has registrado correctamente</h2>";
                } else {
                    echo "<h2>Ya existe una cuenta con ese email</h2>";
                }
            } else {
                echo "<h2>Ya existe una cuenta con ese nombre</h2>";
            }
        }

        public static function iniciarSesion($username, $password){
            $rutaJSON = "./json/Usuarios.json";
            $jsonString = file_get_contents($rutaJSON);
            $usuarios = json_decode($jsonString, true);

            $autenticacion = false;

            foreach ($usuarios as $elemento) {
                // Comprobar si el username es un email.
                if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
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

            if ($autenticacion == false) {
                echo "<h2 style='color: red;'>Usuario o contraseña incorrectos</h2>";
            }
        }

        public static function esFavorita($idCancion){
            $username = $_SESSION['usuario']['username'];

            $rutaJSON = "./json/Usuarios.json";
            $jsonString = file_get_contents($rutaJSON);
            $usuarios = json_decode($jsonString, true);

            foreach ($usuarios as $usuario) {
                if ($usuario["username"] == $username) {
                    if (isset($usuario["listas_reproduccion"]["Favoritos"]) && is_array($usuario["listas_reproduccion"]["Favoritos"])) {
                        foreach ($usuario["listas_reproduccion"]["Favoritos"] as $cancion) {
                            if (isset($cancion["id"]) && $cancion["id"] == $idCancion) {
                                return true;
                            }
                        }
                    }
                }
            }

            return false;
        }

        public static function aniadirCancionAFavoritos($username, $cancion){
            $rutaJSON = "./json/Usuarios.json";
            $jsonString = file_get_contents($rutaJSON);
            $usuarios = json_decode($jsonString, true);

            foreach ($usuarios as &$usuario) {
                if ($usuario["username"] == $username) {
                    $usuario["listas_reproduccion"]["Favoritos"][] = $cancion;
                }
            }

            $jsonString = json_encode($usuarios, JSON_PRETTY_PRINT);
            file_put_contents($rutaJSON, $jsonString);
        }

        public static function eliminarCancionDeFavoritos($username, $idCancion){
            $rutaJSON = "./json/Usuarios.json";
            $jsonString = file_get_contents($rutaJSON);
            $usuarios = json_decode($jsonString, true);

            foreach ($usuarios as &$usuario) {
                if ($usuario["username"] == $username) {
                    if (isset($usuario["listas_reproduccion"]["Favoritos"])) {
                        foreach ($usuario["listas_reproduccion"]["Favoritos"] as $key => $cancion) {
                            if (isset($cancion["id"]) && $cancion["id"] == $idCancion) {
                                unset($usuario["listas_reproduccion"]["Favoritos"][$key]);
                            }
                        }
                    }
                }
            }

            $jsonString = json_encode($usuarios, JSON_PRETTY_PRINT);
            file_put_contents($rutaJSON, $jsonString);
        }

        public static function eliminarCancionDeLista($username, $nombreLista, $idCancion){
            $rutaJSON = "./json/Usuarios.json";
            $jsonString = file_get_contents($rutaJSON);
            $usuarios = json_decode($jsonString, true);

            foreach ($usuarios as &$usuario) {
                if ($usuario["username"] == $username) {
                    if (isset($usuario["listas_reproduccion"][$nombreLista])) {
                        foreach ($usuario["listas_reproduccion"][$nombreLista] as $key => $cancion) {
                            if (isset($cancion["id"]) && $cancion["id"] == $idCancion) {
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

        public static function aniadirCancionALista($username, $nombreLista, $cancion){
            $rutaJSON = "./json/Usuarios.json";
            $jsonString = file_get_contents($rutaJSON);
            $usuarios = json_decode($jsonString, true);

            foreach ($usuarios as &$usuario) {
                if ($usuario["username"] == $username) {
                    $usuario["listas_reproduccion"][$nombreLista][] = $cancion;
                }
            }

            $jsonString = json_encode($usuarios, JSON_PRETTY_PRINT);
            file_put_contents($rutaJSON, $jsonString);

            header("Location: Index.php");
            die();
        }

        public static function mostrarCancionesLista($arrayCanciones, $nombreLista){
            echo "<div class='contenedorCanciones'>";

            foreach ($arrayCanciones as $cancionJSON) {
                $id = $cancionJSON["id"];
                $titulo = $cancionJSON["titulo"];
                $artista = $cancionJSON["artista"];
                $colaboracion = $cancionJSON["colaboracion"];
                $duracion = $cancionJSON["duracion"];
                $imagen = $cancionJSON["imagen"];
                $audio = $cancionJSON["audio"];

                $cancion = new Cancion($id, $titulo, $artista, $colaboracion, $duracion, false, $imagen, $audio);

                $esFavorita = Usuario::esFavorita($cancion->getID());

                $imagen = $cancion->getRutaImagen() != "" ? $cancion->getRutaImagen() : "../assets/imagenes/imagen_defecto.jpg";
                $colaboradores = Cancion::obtenerColaboracion($cancion) != "" ? " ft. " . Cancion::obtenerColaboracion($cancion) : "";

                echo "<div class='cancion'>
                        <img src='$imagen'/>
                        <p><strong>" . $cancion->getTitulo() . "</strong>" . $colaboradores . "</p> 
                        <p>" . $cancion->getArtista() . "</p> 
                        <p>Duración: " . $cancion->getDuracion() . " minutos</p>"
                    . ($esFavorita == true ? "<a href='Eliminar_de_favoritos.php?id=" . urlencode($cancion->getID()) . "&nombreLista=$nombreLista'><i class='fas fa-star'></i></a>" : "<a href='Aniadir_a_favoritos.php?id=" . urlencode($cancion->getID()) . "&nombreLista=$nombreLista'><i class='far fa-star'></i></a>") .
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

        public static function obtenerCancionesLista($username, $nombreLista){
            $rutaJSON = "./json/Usuarios.json";
            $jsonString = file_get_contents($rutaJSON);
            $usuarios = json_decode($jsonString, true);

            foreach ($usuarios as $usuario) {
                if ($usuario["username"] == $username) {
                    if (isset($usuario["listas_reproduccion"][$nombreLista])) {
                        return $usuario["listas_reproduccion"][$nombreLista];
                    }
                }
            }

            return array();
        }

        public static function eliminarListaReproduccion($username, $nombreLista){
            $rutaJSON = "./json/Usuarios.json";
            $jsonString = file_get_contents($rutaJSON);
            $usuarios = json_decode($jsonString, true);

            foreach ($usuarios as &$usuario) {
                if ($usuario["username"] == $username) {
                    unset($usuario["listas_reproduccion"][$nombreLista]);
                }
            }

            $jsonString = json_encode($usuarios, JSON_PRETTY_PRINT);
            file_put_contents($rutaJSON, $jsonString);

            header("Location: Listas_reproduccion.php");
            die();
        }

        public static function editarListaReproduccion($username, $nombreActual, $nuevoNombre){
            $rutaJSON = "./json/Usuarios.json";
            $jsonString = file_get_contents($rutaJSON);
            $usuarios = json_decode($jsonString, true);

            foreach ($usuarios as &$usuario) {
                if ($usuario["username"] == $username) {

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

        public static function aniadirListaReproduccion($username, $nombreLista){
            $rutaJSON = "./json/Usuarios.json";
            $jsonString = file_get_contents($rutaJSON);
            $usuarios = json_decode($jsonString, true);

            foreach ($usuarios as &$usuario) {
                if ($usuario["username"] == $username) {
                    $usuario["listas_reproduccion"][$nombreLista] = [];
                }
            }

            $jsonString = json_encode($usuarios, JSON_PRETTY_PRINT);
            file_put_contents($rutaJSON, $jsonString);

            header("Location: Listas_reproduccion.php");
            die();
        }

        public static function selectListasReproduccion($listasReproduccion){
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

        public static function mostrarListasReproduccion($listasReproduccion){
            if (!empty($listasReproduccion)) {
                echo "<div class='contenedor-listas'>";

                foreach ($listasReproduccion as $nombreLista => $canciones) {
                    echo "<div class='lista-enlace'>
                            <a href='Mostrar_lista.php?nombreLista=" . urlencode($nombreLista) . "' class='nombre'>$nombreLista</a>";

                    if ($nombreLista != "Favoritos") {
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

        public static function eliminarCancionDeListas($idCancion){
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
    }
