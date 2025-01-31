<?php
    class Vehiculo{
        private string $marca, $modelo, $color;
        private int $anioFabricacion;
        private float $kilometraje, $peso;
        private array $personas;

        public function __construct(string $color="Negro", float $peso=1000){
            $this->marca = "Mercedes Benz";
            $this->modelo = "Maybach";
            $this->color = $color;
            $this->peso = $peso;
            $this->anioFabricacion = 2016;
            $this->kilometraje = 0;   
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
            $coche = new Vehiculo("Negro", 1500);
            //$coche->obtenerInformacion();
            echo $coche;
            $coche->circula();
            echo "<br/>Peso del vehículo: " . $coche->getPeso() . " Kg<br/>";
            $coche->aniadirPersona(70);  
            echo "<br/>Peso del vehículo: " . $coche->getPeso() . " Kg<br/>";   
        ?>
    </body>
</html>