<?php
    class Coche extends Cuatro_ruedas implements Electrico{
        use EsDescapotable;
        
        private int $numeroCadenasNieve;
        
        public function __construct(string $color="Negro", float $peso=1000, int $numeroPuertas, int $numeroCadenasNieve=0){
            Cuatro_ruedas::__construct($color, $peso, $numeroPuertas);
            $this->numeroCadenasNieve = $numeroCadenasNieve;
        }

        public function getNumeroCadenasNieve():int{
            return $this->numeroCadenasNieve;
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

        public function quitarCadenasNive(int $numeroCadenasNieve){
            if($this->numeroCadenasNieve > 0){
                $this->numeroCadenasNieve -= $numeroCadenasNieve;
                echo "<br/>Se ha quitado una cadena de nieve al coche<br/>";
            }else{
                echo "<br/>Ya no quedan cadenas de nieve puestas<br/>";
            }
        }

        public function aniadirPersona(float $pesoPersona){
            if(count($this->personas) <= 5){
                $this->peso =+ $pesoPersona;
                echo "<br/>Se ha subido una persona de $pesoPersona Kg<br/>";
            }else{
                echo "<br/>El coche va lleno<br/>";
            }
        }

        public function recargarBateria(){
            echo "<h2>El coche está cargado</h2>";
        }

        public function obtenerInformacion(){
            echo "<h2>Estado del vehículo</h2>-Marca: " . Vehiculo::getMarca() . "<br/>-Modelo: " . Vehiculo::getModelo() . "<br/>-Color: " . Vehiculo::getColor() . "<br/>-Peso: " . Vehiculo::getPeso() . "<br/>-Año de fabricación: " . Vehiculo::getAnioFabricacion() . "<br/>-Kilometraje: " . Vehiculo::getkilometraje() . "<br/>-Litros de combustible: " . Vehiculo::getCantidadGasolina() . "<br/>-Número de ocupantes: " . count(Vehiculo::getPersonas()) . "<br/>";
        }

        public function __toString(){
            return "<h2>Estado del vehículo</h2>-Marca: " . Vehiculo::getMarca() . "<br/>-Modelo: " . Vehiculo::getModelo() . "<br/>-Color: " . Vehiculo::getColor() . "<br/>-Peso: " . Vehiculo::getPeso() . "<br/>-Año de fabricación: " . Vehiculo::getAnioFabricacion() . "<br/>-Kilometraje: " . Vehiculo::getkilometraje() . "<br/>-Litros de combustible: " . Vehiculo::getCantidadGasolina() . "<br/>-Número de ocupantes: " . count(Vehiculo::getPersonas()) . "<br/>";
        }
    }
?>