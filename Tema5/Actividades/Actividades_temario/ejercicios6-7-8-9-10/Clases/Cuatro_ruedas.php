<?php
    class Cuatro_ruedas extends Vehiculo{
        private int $numeroPuertas;
        
        public function __construct(string $color="Negro", float $peso=1000, int $numeroPuertas=4){
            Vehiculo::__construct($color, $peso, $categoriaEmisiones = CategoriaEmisiones::CeroEmisiones);
            $this->numeroPuertas = $numeroPuertas;
        }

        public function setNumeroPuertas(int $numeroPuertas){
            $this->numeroPuertas = $numeroPuertas;
        }

        public function getNumeroPuertas():int{
            return $this->numeroPuertas;
        }

        public function repintar(string $color){
            echo "<br/>Se ha repintado el vehiculo de color $this->color a color $color<br/>";
            $this->color = $color;
        }

        public function aniadirPersona(float $pesoPersona){
            if(count($this->personas) <= 5){
                $this->peso =+ $pesoPersona;
                echo "<br/>Se ha subido una persona de $pesoPersona Kg<br/>";
            }else{
                echo "<br/>El vehiculo va lleno<br/>";
            }
        }

        public function obtenerInformacion(){
            echo "<h2>Estado del vehículo</h2>-Marca: " . Vehiculo::getMarca() . "<br/>-Modelo: " . Vehiculo::getModelo() . "<br/>-Color: " . Vehiculo::getColor() . "<br/>-Peso: " . Vehiculo::getPeso() . "<br/>-Año de fabricación: " . Vehiculo::getAnioFabricacion() . "<br/>-Número de puertas: " . $this->numeroPuertas . "<br/>-Kilometraje: " . Vehiculo::getkilometraje() . "<br/>-Litros de combustible: " . Vehiculo::getCantidadGasolina() . "<br/>-Número de ocupantes: " . count(Vehiculo::getPersonas()) . "<br/>";
        }

        public function __toString(){
            return "<h2>Estado del vehículo</h2>-Marca: " . Vehiculo::getMarca() . "<br/>-Modelo: " . Vehiculo::getModelo() . "<br/>-Color: " . Vehiculo::getColor() . "<br/>-Peso: " . Vehiculo::getPeso() . "<br/>-Año de fabricación: " . Vehiculo::getAnioFabricacion() . "<br/>-Número de puertas: " . $this->numeroPuertas . "<br/>-Kilometraje: " . Vehiculo::getkilometraje() . "<br/>-Litros de combustible: " . Vehiculo::getCantidadGasolina() . "<br/>-Número de ocupantes: " . count(Vehiculo::getPersonas()) . "<br/>";
        }
    }
?>