<?php
    require_once("Usuario.php");

    class Cancion{
        private string $id;
        private string $titulo;
        private string $artista;
        private array $colaboracion;
        private float $duracion;
        private bool $favorita;
        private string $rutaImagen;
        private string $rutaAudio;

        public function __construct($id, $titulo, $artista, $colaboracion, $duracion, $favorita, $rutaImagen = "", $rutaAudio = ""){
            $this->id = $id;
            $this->titulo = $titulo;
            $this->artista = $artista;
            $this->colaboracion = $colaboracion;
            $this->duracion = $duracion;
            $this->favorita = $favorita;
            $this->rutaImagen = $rutaImagen;
            $this->rutaAudio = $rutaAudio;
        }

        public function getID(){
            return $this->id;
        }
        public function setID($id){
            $this->id = $id;
        }

        public function getTitulo(){
            return $this->titulo;
        }
        public function setTitulo($titulo){
            $this->titulo = $titulo;
        }

        public function getArtista(){
            return $this->artista;
        }
        public function setArtista($artista){
            $this->artista = $artista;
        }

        public function getColaboracion(){
            return $this->colaboracion;
        }
        public function setColaboracion($colaboracion){
            $this->colaboracion = $colaboracion;
        }

        public function getDuracion(){
            return $this->duracion;
        }
        public function setDuracion($duracion){
            $this->duracion = $duracion;
        }

        public function getFavorita(){
            return $this->favorita;
        }
        public function setFavorita($favorita){
            $this->favorita = $favorita;
        }

        public function getRutaImagen(){
            return $this->rutaImagen;
        }
        public function setRutaImagen($rutaImagen){
            $this->rutaImagen = $rutaImagen;
        }

        public function getRutaAudio(){
            return $this->rutaAudio;
        }
        public function setRutaAudio($rutaAudio){
            $this->rutaAudio = $rutaAudio;
        }

        public static function aniadir_cancion($arrayJSON, $nuevaCancion){
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
        
        public static function editarCancion($cancion){
            $cancionesJSON = Cancion::decodificarCanciones();

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

        public static function eliminarCancion($idCancion){
            $rutaJSON = "./json/Canciones.json";
            $jsonString = file_get_contents($rutaJSON);
            $canciones = json_decode($jsonString, true);

            Usuario::eliminarCancionDeListas($idCancion);

            foreach ($canciones as $key => $cancion) {
                if ($cancion['id'] == $idCancion) {
                    unset($canciones[$key]);

                    $jsonString = json_encode($canciones, JSON_PRETTY_PRINT);
                    file_put_contents($rutaJSON, $jsonString);

                    header("Location: Index.php");
                    exit();
                }
            }
        }

        public static function obtenerColaboracion($cancion){
            $colaboracion = "";

            if (!empty($cancion->getColaboracion())) {
                if (count($cancion->getColaboracion()) == 1) {
                    $colaboracion = $cancion->getColaboracion()[0];
                } else {
                    $colaboracion = implode(', ', $cancion->getColaboracion());
                }
            } else {
                $colaboracion = "";
            }

            return $colaboracion;
        }

        public static function mostrarCanciones($canciones){
            echo "<div class='contenedorCanciones'>";

            foreach ($canciones as $cancion) {
                $esFavorita = Usuario::esFavorita($cancion->getID());

                $imagen = $cancion->getRutaImagen() != "" ? $cancion->getRutaImagen() : "../assets/imagenes/imagen_defecto.jpg";
                $colaboradores = Cancion::obtenerColaboracion($cancion) != "" ? " ft. " . Cancion::obtenerColaboracion($cancion) : "";

                echo "<div class='cancion'>
                        <img src='$imagen'/>
                        <p><strong>" . $cancion->getTitulo() . "</strong>" . $colaboradores . "</p> 
                        <p>" . $cancion->getArtista() . "</p> 
                        <p>Duración: " . $cancion->getDuracion() . " minutos</p>"
                    . ($esFavorita == true ? "<a href='Eliminar_de_favoritos.php?id=" . urlencode($cancion->getID()) . "&ubicacion=Index.php'><i class='fas fa-star'></i></a>" : "<a href='Aniadir_a_favoritos.php?id=" . urlencode($cancion->getID()) . "&ubicacion=Index.php'><i class='far fa-star'></i></a>") .
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

        public static function obtenerCancion($arrayCanciones, $idCancion){
            foreach ($arrayCanciones as $cancion) {
                if ($cancion->getID() == $idCancion) {
                    $imagen = $cancion->getRutaImagen() != "" ? $cancion->getRutaImagen() : "../assets/imagenes/imagen_defecto.jpg";
                    $colaboradores = Cancion::obtenerColaboracion($cancion) != "" ? " ft. " . Cancion::obtenerColaboracion($cancion) : "";

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

        public static function obtenerCancionJSON($arrayJSON, $idCancion){
            foreach ($arrayJSON as $cancion) {
                if ($cancion["id"] == $idCancion) {
                    return $cancion;
                }
            }
        }

        public static function obtenerUltimoID($arrayJSON){
            if (isset($arrayJSON) && count($arrayJSON) > 0) {
                return end($arrayJSON)["id"];
            } else {
                return "1";
            }
        }

        public static function decodificarCanciones(){
            $ruta = "./json/Canciones.json";
            $canciones = json_decode(file_get_contents($ruta), true);

            return $canciones;
        }

        public static function instanciarCanciones($cancionesJSON){
            $arrayCanciones = array();

            if (isset($cancionesJSON) && count($cancionesJSON) > 0) {
                foreach ($cancionesJSON as $cancionJSON) {
                    $cancion = new Cancion($cancionJSON["id"], $cancionJSON["titulo"], $cancionJSON["artista"], $cancionJSON["colaboracion"], $cancionJSON["duracion"], $cancionJSON["favorita"], $cancionJSON["imagen"], $cancionJSON["audio"]);
                    array_push($arrayCanciones, $cancion);
                }
            }

            return $arrayCanciones;
        }

        public static function obtenerNumeroColaboraciones($colaboracion){
            if (str_contains($colaboracion, ",")) {
                return "Varios";
            } else {
                return "Uno";
            }
        }
    }