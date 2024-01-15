<?php
    class Coche extends Cuatro_ruedas{
        private int $numeroCadenasNieve;
        
        public function __construct(int $numeroCadenasNieve=0){
            Cuatro_ruedas::__construct();
            $this->numeroCadenasNieve = $numeroCadenasNieve;
        }

        public function aniadirCadenasNieve(int $numeroCadenasNieve){
            if($numeroCadenasNieve >= 0 && $numeroCadenasNieve <= 4){
                $this->numeroCadenasNieve = $numeroCadenasNieve;
            }else if($numeroCadenasNieve >= 4){
                $this->numeroCadenasNieve = 4;
            }else if($numeroCadenasNieve <= 0) {
                $this->numeroCadenasNieve = 0;
            }
        }

        public function getnumeroCadenasNieve():int{
            return $this->numeroCadenasNieve;
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
            echo "<h2>Estado del vehículo</h2>-Marca: " . Vehiculo::getMarca() . "<br/>-Modelo: " . Vehiculo::getModelo() . "<br/>-Color: " . Vehiculo::getColor() . "<br/>-Peso: " . Vehiculo::getPeso() . "<br/>-Año de fabricación: " . Vehiculo::getAnioFabricacion() . "<br/>-Cilindrada: " . $this->cilindrada . "<br/>-Kilometraje: " . Vehiculo::getkilometraje() . "<br/>-Longitud: " . Vehiculo::getLongitud() . " metros<br/>-Litros de combustible: " . Vehiculo::getCantidadGasolina() . "<br/>-Número de cadenas de nieve: "  . Vehiculo::getNumeroCadenasNieve() . "<br/>-Número de ocupantes: " . count(Vehiculo::getPersonas()) . "<br/>";
        }

        public function __toString(){
            return "<h2>Estado del vehículo</h2>-Marca: " . Vehiculo::getMarca() . "<br/>-Modelo: " . Vehiculo::getModelo() . "<br/>-Color: " . Vehiculo::getColor() . "<br/>-Peso: " . Vehiculo::getPeso() . "<br/>-Año de fabricación: " . Vehiculo::getAnioFabricacion() . "<br/>-Cilindrada: " . $this->cilindrada . "<br/>-Kilometraje: " . Vehiculo::getkilometraje() . "<br/>-Longitud: " . Vehiculo::getLongitud() . " metros<br/>-Litros de combustible: " . Vehiculo::getCantidadGasolina() . "<br/>-Número de cadenas de nieve: "  . Vehiculo::getNumeroCadenasNieve() . "<br/>-Número de ocupantes: " . count(Vehiculo::getPersonas()) . "<br/>";
        }
    }
?>