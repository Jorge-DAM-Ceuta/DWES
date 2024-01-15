<?php
    class Cuatro_ruedas extends Vehiculo{
        private int $numeroPuertas;
        
        public function __construct(int $numeroPuertas=4){
            Vehiculo::__construct();
            $this->numeroPuertas = $numeroPuertas;
        }

        public function setNumeroPuertas(int $numeroPuertas){
            $this->numeroPuertas = $numeroPuertas;
        }

        public function getNumeroPuertas():int{
            return $this->numeroPuertas;
        }

        public function obtenerInformacion(){
            echo "<h2>Estado del vehículo</h2>-Marca: " . Vehiculo::getMarca() . "<br/>-Modelo: " . Vehiculo::getModelo() . "<br/>-Color: " . Vehiculo::getColor() . "<br/>-Peso: " . Vehiculo::getPeso() . "<br/>-Año de fabricación: " . Vehiculo::getAnioFabricacion() . "<br/>-Número de puertas: " . $this->numeroPuertas . "<br/>-Kilometraje: " . Vehiculo::getkilometraje() . "<br/>-Longitud: " . Vehiculo::getLongitud() . " metros<br/>-Litros de combustible: " . Vehiculo::getCantidadGasolina() . "<br/>-Número de cadenas de nieve: "  . Vehiculo::getNumeroCadenasNieve() . "<br/>-Número de ocupantes: " . count(Vehiculo::getPersonas()) . "<br/>";
        }

        public function __toString(){
            return "<h2>Estado del vehículo</h2>-Marca: " . Vehiculo::getMarca() . "<br/>-Modelo: " . Vehiculo::getModelo() . "<br/>-Color: " . Vehiculo::getColor() . "<br/>-Peso: " . Vehiculo::getPeso() . "<br/>-Año de fabricación: " . Vehiculo::getAnioFabricacion() . "<br/>-Número de puertas: " . $this->numeroPuertas . "<br/>-Kilometraje: " . Vehiculo::getkilometraje() . "<br/>-Longitud: " . Vehiculo::getLongitud() . " metros<br/>-Litros de combustible: " . Vehiculo::getCantidadGasolina() . "<br/>-Número de cadenas de nieve: "  . Vehiculo::getNumeroCadenasNieve() . "<br/>-Número de ocupantes: " . count(Vehiculo::getPersonas()) . "<br/>";
        }
    }
?>