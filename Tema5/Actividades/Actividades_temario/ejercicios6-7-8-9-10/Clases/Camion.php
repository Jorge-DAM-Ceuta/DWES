<?php
    class Camion extends Cuatro_ruedas implements Combustion{
        use EsManual;
        private int $longitud;
        
        public function __construct(string $color="Negro", float $peso=1000, int $numeroPuertas=2, int $longitud=10){
            Cuatro_ruedas::__construct($color, $peso, $numeroPuertas);
            $this->longitud = $longitud;
        }

        public function setLongitud(float $longitud){
            $this->longitud = $longitud;
        }

        public function getLongitud():float{
            return $this->longitud;
        }

        public function aniadirRemolque(float $longitudRemolque){
            $this->longitud += $longitudRemolque;
            echo "<br/>Se ha añadido una remolque de $longitudRemolque metros al camión<br/>";
        }

        public function ponerCombustible(){
            echo "<h2>Se ha llenado el tanque de combustible</h2>";
        }

        public function obtenerInformacion(){
            echo "<h2>Estado del vehículo</h2>-Marca: " . Vehiculo::getMarca() . "<br/>-Modelo: " . Vehiculo::getModelo() . "<br/>-Color: " . Vehiculo::getColor() . "<br/>-Peso: " . Vehiculo::getPeso() . "<br/>-Año de fabricación: " . Vehiculo::getAnioFabricacion() . "<br/>-Kilometraje: " . Vehiculo::getkilometraje() . "<br/>-Litros de combustible: " . Vehiculo::getCantidadGasolina() . "<br/>-Número de ocupantes: " . count(Vehiculo::getPersonas()) . "<br/>";
        }

        public function __toString(){
            return "<h2>Estado del vehículo</h2>-Marca: " . Vehiculo::getMarca() . "<br/>-Modelo: " . Vehiculo::getModelo() . "<br/>-Color: " . Vehiculo::getColor() . "<br/>-Peso: " . Vehiculo::getPeso() . "<br/>-Año de fabricación: " . Vehiculo::getAnioFabricacion() . "<br/>-Kilometraje: " . Vehiculo::getkilometraje() . "<br/>-Litros de combustible: " . Vehiculo::getCantidadGasolina() . "<br/>-Número de ocupantes: " . count(Vehiculo::getPersonas()) . "<br/>";
        }
    }
?>