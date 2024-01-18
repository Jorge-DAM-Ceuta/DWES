<?php
    class Dos_ruedas extends Vehiculo implements Hibrido{
        use PuedeDerrapar;
        private int $cilindrada;
        
        public function __construct(string $color="Negro", float $peso=1000, int $cilindrada=45){
            Vehiculo::__construct($color, $peso, $categoriaEmisiones = CategoriaEmisiones::ECO);
            $this->cilindrada = $cilindrada;
        }

        public function setCilindrada(int $cilindrada){
            $this->cilindrada = $cilindrada;
        }

        public function getCilindrada():int{
            return $this->cilindrada;
        }

        public function ponerGasolina(float $litros){
            if($this->cantidadGasolina <= 60){
                $this->peso += $litros;
            }else{
                echo "<br/>El tanque de gasolina está lleno.<br/>";
            }
        }

        public function repintar(string $color){
            echo "<br/>Se ha repintado el vehiculo de color $this->color a color $color<br/>";
            $this->color = $color;
        }

        public function aniadirPersona(float $pesoPersona){
            if(count($this->personas) <= 2){
                $this->peso =+ $pesoPersona + 2;
                echo "<br/>Se ha subido una persona de $pesoPersona Kg<br/>";
            }else{
                echo "<br/>La moto ya tiene dos pasajeros<br/>";
            }
        }

        public function cambiarModo(){
            echo "<h2>Se ha cambiado a modo híbrido</h2>";
        }

        public function obtenerInformacion(){
            echo "<h2>Estado del vehículo</h2>-Marca: " . Vehiculo::getMarca() . "<br/>-Modelo: " . Vehiculo::getModelo() . "<br/>-Color: " . Vehiculo::getColor() . "<br/>-Peso: " . Vehiculo::getPeso() . "<br/>-Año de fabricación: " . Vehiculo::getAnioFabricacion() . "<br/>-Cilindrada: " . $this->cilindrada . "<br/>-Kilometraje: " . Vehiculo::getkilometraje() . "<br/>-Litros de combustible: " . Vehiculo::getCantidadGasolina() . "<br/>-Número de ocupantes: " . count(Vehiculo::getPersonas()) . "<br/>";
        }

        public function __toString(){
            return "<h2>Estado del vehículo</h2>-Marca: " . Vehiculo::getMarca() . "<br/>-Modelo: " . Vehiculo::getModelo() . "<br/>-Color: " . Vehiculo::getColor() . "<br/>-Peso: " . Vehiculo::getPeso() . "<br/>-Año de fabricación: " . Vehiculo::getAnioFabricacion() . "<br/>-Cilindrada: " . $this->cilindrada . "<br/>-Kilometraje: " . Vehiculo::getkilometraje() . "<br/>-Litros de combustible: " . Vehiculo::getCantidadGasolina() . "<br/>-Número de ocupantes: " . count(Vehiculo::getPersonas()) . "<br/>";
        }
    }
?>