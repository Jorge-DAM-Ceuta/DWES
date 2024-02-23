<?php
    class Disco{
        private string $id;
        private string $titulo;
        private string $artista;
        private int $anio;
        private array $canciones;
        private string $rutaImagen;

        public function __construct($id, $titulo, $artista, $anio, $canciones, $rutaImagen = ""){
            $this->id = $id;
            $this->titulo = $titulo;
            $this->artista = $artista;
            $this->anio = $anio;
            $this->canciones = $canciones;
            $this->rutaImagen = $rutaImagen;
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

        public function getAnio(){
            return $this->anio;
        }
        public function setAnio($anio){
            $this->anio = $anio;
        }

        public function getCanciones(){
            return $this->canciones;
        }
        public function setCanciones($canciones){
            $this->canciones = $canciones;
        }

        public function getRutaImagen(){
            return $this->rutaImagen;
        }
        public function setRutaImagen($rutaImagen){
            $this->rutaImagen = $rutaImagen;
        }

        public static function mostrarDiscos(){
            $discos = Disco::instanciarDiscos(Disco::decodificarDiscos());

            echo "<div class='contenedorCanciones'>";

            foreach ($discos as $disco) {
                $imagen = $disco->getRutaImagen() != "" ? $disco->getRutaImagen() : "../assets/imagenes/imagen_defecto.jpg";

                echo "<div class='cancion'>
                        <img src='$imagen'/>
                        <p><strong>" . $disco->getTitulo() . "</strong></p> 
                        <p>" . $disco->getArtista() . "</p> 
                        <p>Año: " . $disco->getAnio() . "</p>
                        <details>
                            <summary>Canciones</summary>";

                $contador = 1;
                foreach ($disco->getCanciones() as $cancion) {
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

        public static function editarDisco($disco){
            $discosJSON = Disco::decodificarDiscos();

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

        public static function aniadirDisco($arrayJSON, $nuevoDisco){
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

        public static function eliminarDisco($idDisco){
            $rutaJSON = "./json/Discos.json";
            $jsonString = file_get_contents($rutaJSON);
            $discos = json_decode($jsonString, true);

            foreach ($discos as $key => $disco) {
                if ($disco['id'] == $idDisco) {
                    unset($discos[$key]);

                    $jsonString = json_encode($discos, JSON_PRETTY_PRINT);
                    file_put_contents($rutaJSON, $jsonString);

                    header("Location: Mostrar_discos.php");
                    exit();
                }
            }
        }

        public static function mostrarDisco_ID($arrayDiscos, $idDisco){
            foreach ($arrayDiscos as $disco) {
                if ($disco->getID() == $idDisco) {
                    $imagen = $disco->getRutaImagen() != "" ? $disco->getRutaImagen() : "../assets/imagenes/imagen_defecto.jpg";

                    echo "<div class='cancion'>
                            <img src='$imagen'/>
                            <p>" . $disco->getTitulo() . "</p> 
                            <p>" . $disco->getArtista() . "</p> 
                            <p>Año: " . $disco->getAnio() . "</p>
                            <details>
                                <summary>Canciones</summary>";

                    $contador = 1;
                    foreach ($disco->getCanciones() as $cancion) {
                        echo "<p>" . $contador . ". " . $cancion . "</p>";
                        $contador++;
                    }

                    echo "</details>
                        </div>";

                    return $disco;
                }
            }
        }

        public static function obtenerUltimoID_Disco($arrayJSON): int{
            return end($arrayJSON)["id"];
        }

        public static function decodificarDiscos(){
            $ruta = "./json/Discos.json";
            $discos = json_decode(file_get_contents($ruta), true);

            return $discos;
        }

        public static function instanciarDiscos($discosJSON){
            $arrayDiscos = array();

            foreach ($discosJSON as $discoJSON) {
                $disco = new Disco($discoJSON["id"], $discoJSON["titulo"], $discoJSON["artista"], $discoJSON["anio"], $discoJSON["canciones"], $discoJSON["imagen"]);
                array_push($arrayDiscos, $disco);
            }

            return $arrayDiscos;
        }

        public static function asignarCaratulaDisco(){
            $cancionesJSON = Cancion::decodificarCanciones();
            $canciones = Cancion::instanciarCanciones(Cancion::decodificarCanciones());
            $discos = Disco::instanciarDiscos(Disco::decodificarDiscos());

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
    }