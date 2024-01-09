<?php
    class Coche{
        private $marca, $modelo, $color, $peso, $anioFabricacion, $kilometraje, $cantidadGasolina, $numeroCadenasNieve, $personas;

        public function __construct($color="", $peso=0){
            $this->marca = "Mercedes Benz";
            $this->modelo = "Maybach";
            $this->color = $color;
            $this->peso = $peso;
            $this->anioFabricacion = 2016;
            $this->kilometraje = 0;   
            $this->cantidadGasolina = 60;
            $this->numeroCadenasNieve = 0;
            $this->personas = array();
        }

        public function setMarca($marca){
            $this->marca = $marca;
        }

        public function getMarca(){
            return $this->marca;
        }

        public function setModelo($modelo){
            $this->modelo = $modelo;
        }

        public function getModelo(){
            return $this->modelo;
        }

        public function setColor($color){
            $this->color = $color;
        }

        public function getColor(){
            return $this->color;
        }

        public function setPeso($peso){
            $this->peso = $peso;
        }

        public function getPeso(){
            return $this->peso;
        }

        public function setAnioFabricacion($anioFabricacion){
            $this->anioFabricacion = $anioFabricacion;
        }

        public function getAnioFabricacion(){
            return $this->anioFabricacion;
        }

        public function setKilometraje($kilometraje){
            $this->kilometraje = $kilometraje;
        }

        public function getKilometraje(){
            return $this->kilometraje;
        }

        public function setCantidadGasolina($cantidadGasolina){
            $this->cantidadGasolina = $cantidadGasolina;
        }

        public function getCantidadGasolina(){
            return $this->cantidadGasolina;
        }

        public function setnumeroCadenasNieve($numeroCadenasNieve){
            $this->numeroCadenasNieve = $numeroCadenasNieve;
        }

        public function getnumeroCadenasNieve(){
            return $this->numeroCadenasNieve;
        }

        public function setPersonas($personas){
            array_push($this->personas, $personas);
        }

        public function getPersonas(){
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
        
        public function maniobrar($direccion){
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

        public function repintar($color){
            $this->color = $color;
        }

        public function ponerGasolina($litros){
            if($this->cantidadGasolina <= 60){
                $this->peso += $litros;
            }else{
                echo "<br/>El tanque de gasolina está lleno.<br/>";
            }
        }

        public function aniadirPersona($pesoPersona){
            if(count($this->personas) <= 4){
                $this->peso =+ $pesoPersona;
                echo "<br/>Se ha subido una persona de $pesoPersona Kg<br/>";
            }else{
                echo "<br/>El coche va lleno<br/>";
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

        public function obtenerInformacion(){
            echo "<h2>Información del vehículo</h2>-Marca: $this->marca <br/>-Modelo: $this->modelo <br/>-Color: $this->color <br/>-Peso: $this->peso <br/>-Año de fabricación: $this->anioFabricacion <br/>-Kilometraje: $this->kilometraje <br/>-Número de ocupantes: " . count($this->personas) . "<br/>";
        }
        public function __toString(){
            return "<h2>Información del vehículo</h2>-Marca: $this->marca <br/>-Modelo: $this->modelo <br/>-Color: $this->color <br/>-Peso: $this->peso <br/>-Año de fabricación: $this->anioFabricacion <br/>-Kilometraje: $this->kilometraje <br/>-Número de ocupantes: " . count($this->personas) . "<br/>";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 4</title>
    </head>
    <body>
        <?php
            $coche = new Coche("Negro", 1500);
            //$coche->obtenerInformacion();
            echo $coche;
            $coche->circula();
            echo "<br/>Peso del vehículo: " . $coche->getPeso() . " Kg<br/>";
            $coche->aniadirPersona(70);  
            echo "<br/>Peso del vehículo: " . $coche->getPeso() . " Kg<br/>";   
        ?>
    </body>
</html>