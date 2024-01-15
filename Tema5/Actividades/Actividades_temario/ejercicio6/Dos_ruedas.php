<?php
    class Cuatro_ruedas extends Vehiculo{
        private int $cilindrada;
        
        public function __construct(int $cilindrada=45){
            Vehiculo::__construct();
            $this->cilindrada = $cilindrada;
        }

        public function setCilindrada(int $cilindrada){
            $this->cilindrada = $cilindrada;
        }

        public function getCilindrada():int{
            return $this->cilindrada;
        }

        public function obtenerInformacion(){
            echo "<h2>Estado del vehículo</h2>-Marca: " . Vehiculo::getMarca() . "<br/>-Modelo: " . Vehiculo::getModelo() . "<br/>-Color: " . Vehiculo::getColor() . "<br/>-Peso: " . Vehiculo::getPeso() . "<br/>-Año de fabricación: " . Vehiculo::getAnioFabricacion() . "<br/>-Cilindrada: " . $this->cilindrada . "<br/>-Kilometraje: " . Vehiculo::getkilometraje() . "<br/>-Longitud: " . Vehiculo::getLongitud() . " metros<br/>-Litros de combustible: " . Vehiculo::getCantidadGasolina() . "<br/>-Número de cadenas de nieve: "  . Vehiculo::getNumeroCadenasNieve() . "<br/>-Número de ocupantes: " . count(Vehiculo::getPersonas()) . "<br/>";
        }

        public function __toString(){
            return "<h2>Estado del vehículo</h2>-Marca: " . Vehiculo::getMarca() . "<br/>-Modelo: " . Vehiculo::getModelo() . "<br/>-Color: " . Vehiculo::getColor() . "<br/>-Peso: " . Vehiculo::getPeso() . "<br/>-Año de fabricación: " . Vehiculo::getAnioFabricacion() . "<br/>-Cilindrada: " . $this->cilindrada . "<br/>-Kilometraje: " . Vehiculo::getkilometraje() . "<br/>-Longitud: " . Vehiculo::getLongitud() . " metros<br/>-Litros de combustible: " . Vehiculo::getCantidadGasolina() . "<br/>-Número de cadenas de nieve: "  . Vehiculo::getNumeroCadenasNieve() . "<br/>-Número de ocupantes: " . count(Vehiculo::getPersonas()) . "<br/>";
        }
    }
?>