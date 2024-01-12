<?php
    class Cuatro_ruedas extends Vehiculo{
        private string $marca, $modelo, $color;
        private float $peso, $kilometraje, $longitud, $cantidadGasolina;
        private int $anioFabricacion, $numeroCadenasNieve, $numeroPuertas;
        private array $personas;
        
        public function __construct(string $color="Negro", float $peso=1000){
            $this->marca = "Mercedes Benz";
            $this->modelo = "Maybach";
            $this->color = $color;
            $this->peso = $peso;
            $this->anioFabricacion = 2016;
            $this->kilometraje = 0;   
            $this->longitud = 2;
            $this->cantidadGasolina = 60;
            $this->numeroCadenasNieve = 0;
            $this->numeroPuertas = 4;
            $this->personas = array();
        }

        public function setMarca(string $marca){
            $this->marca = $marca;
        }

        public function getMarca():string{
            return $this->marca;
        }

        public function setModelo(string $modelo){
            $this->modelo = $modelo;
        }

        public function getModelo():string{
            return $this->modelo;
        }

        public function setColor(string $color){
            $this->color = $color;
        }

        public function getColor():string{
            return $this->color;
        }

        public function setPeso(float $peso){
            $this->peso = $peso;
        }

        public function getPeso():float{
            return $this->peso;
        }

        public function setAnioFabricacion(int $anioFabricacion){
            $this->anioFabricacion = $anioFabricacion;
        }

        public function getAnioFabricacion():int{
            return $this->anioFabricacion;
        }

        public function setKilometraje(float $kilometraje){
            $this->kilometraje = $kilometraje;
        }

        public function getKilometraje():float{
            return $this->kilometraje;
        }

        public function setLongitud(float $longitud){
            $this->longitud = $longitud;
        }

        public function getLongitud():float{
            return $this->longitud;
        }

        public function setCantidadGasolina(float $cantidadGasolina){
            $this->cantidadGasolina = $cantidadGasolina;
        }

        public function getCantidadGasolina():float{
            return $this->cantidadGasolina;
        }

        public function setNumeroCadenasNieve(int $numeroCadenasNieve){
            $this->numeroCadenasNieve = $numeroCadenasNieve;
        }

        public function getNumeroCadenasNieve():int{
            return $this->numeroCadenasNieve;
        }

        public function setNumeroPuertas(int $numeroPuertas){
            $this->numeroPuertas = $numeroPuertas;
        }

        public function getNumeroPuertas():int{
            return $this->numeroPuertas;
        }

        public function setPersonas(int $personas){
            $numeroPersonas = 0;
            
            if($personas > 5){
                $numeroPersonas = 5;
            }else{
                $numeroPersonas = $personas;
            }

            for($i = 0; $i<$numeroPersonas; $i++){
                array_push($this->personas, "Persona$i");
            }
        }

        public function getPersonas():array{
            return $this->personas;
        }

        public function avanzar(){
            $this->kilometraje++;   
            echo "<br/>El coche ha avanzado 1 kilómetro; Kilómetros totales: $this->kilometraje.<br/>";
        }
        
        public function retroceder(){
            $this->kilometraje++;   
            echo "<br/>El coche ha retrocedido 1 kilometro.<br/>";
        }
        
        public function maniobrar(string $direccion){
            $direccion = strtolower($direccion);
            
            switch($direccion){
                case "derecha":
                    echo "<br/>Se ha girado a la derecha.<br/>";
                break;

                case "izquierda":
                    echo "<br/>Se ha girado a la izquierda.<br/>";
                break;

                default:
                    echo "<br/>No se ha producido ningún giro.<br/>";
                break;
            }
        }

        public function circula(){
            echo "<br/>El vehículo circula<br/>";
        }

        public function aniadirPersona(float $pesoPersona){
            if(count($this->personas) <= 5){
                $this->peso =+ $pesoPersona;
                echo "<br/>Se ha subido una persona de $pesoPersona Kg<br/>";
            }else{
                echo "<br/>El coche va lleno<br/>";
            }
        }

        public function repintar(string $color){
            echo "<br/>Se ha repintado el coche de color $this->color a color $color<br/>";
            $this->color = $color;
        }

        public function ponerGasolina(float $litros){
            if($this->cantidadGasolina <= 60){
                $this->peso += $litros;
            }else{
                echo "<br/>El tanque de gasolina está lleno.<br/>";
            }
        }

        public function aniadirCadenasNive(){
            if($this->numeroCadenasNieve <= 4){
                $this->numeroCadenasNieve ++;
                echo "<br/>Se ha añadido una cadena de nieve al coche<br/>";
            }else{
                echo "<br/>Ya hay una cadena de nieve en cada rueda<br/>";
            }
        }

        public function quitarCadenasNive(){
            if($this->numeroCadenasNieve > 0){
                $this->numeroCadenasNieve --;
                echo "<br/>Se ha quitado una cadena de nieve al coche<br/>";
            }else{
                echo "<br/>Ya no quedan cadenas de nieve puestas<br/>";
            }
        }

        public function aniadirRemolque(float $longitudRemolque){
            if($this->longitud <= 2){
                $this->longitud += $longitudRemolque;
                echo "<br/>Se ha añadido una remolque al coche<br/>";
            }else{
                echo "<br/>Ya hay dos remolques en el coche<br/>";
            }
        }

        public function obtenerInformacion(){
            echo "<h2>Estado del vehículo</h2>-Marca: $this->marca <br/>-Modelo: $this->modelo <br/>-Color: $this->color <br/>-Peso: $this->peso <br/>-Año de fabricación: $this->anioFabricacion <br/>-Kilometraje: $this->kilometraje <br/>-Longitud: $this->longitud metros<br/>-Litros de combustible: $this->cantidadGasolina<br/>-Número de cadenas de nieve: $this->numeroCadenasNieve<br/>-Número de ocupantes: " . count($this->personas) . "<br/>";
        }

        public function __toString(){
            return "<h2>Estado del vehículo</h2>-Marca: $this->marca <br/>-Modelo: $this->modelo <br/>-Color: $this->color <br/>-Peso: $this->peso <br/>-Año de fabricación: $this->anioFabricacion <br/>-Kilometraje: $this->kilometraje <br/>-Longitud: $this->longitud metros<br/>-Litros de combustible: $this->cantidadGasolina<br/>-Número de cadenas de nieve: $this->numeroCadenasNieve<br/>-Número de ocupantes: " . count($this->personas) . "<br/>";
        }
    }
?>