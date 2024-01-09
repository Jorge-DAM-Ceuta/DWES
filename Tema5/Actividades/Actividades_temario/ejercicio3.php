<?php
    class Coche{
        private $color, $peso, $kilometraje;
        private const MARCA = "Mercedes Benz"; 
        private const MODELO = "Maybach"; 
        private const ANIO = "2016"; 


        public function __construct($color="", $peso="", $kilometraje=0){
            $this->color = $color;
            $this->peso = $peso;
            $this->kilometraje = $kilometraje;   
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
        
        public function obtenerInformacion(){
            echo "<h2>Información del vehículo</h2>-Marca: " . Self::MARCA . " <br/>-Modelo: " . Self::MODELO . " <br/>-Color: $this->color <br/>-Peso: $this->peso <br/>-Año de fabricación: " . Self::ANIO . " <br/>-Kilometraje: $this->kilometraje<br/>";
        }

        public function __toString(){
            return "<h2>Información del vehículo</h2>-Marca: " . Self::MARCA . " <br/>-Modelo: " . Self::MODELO . " <br/>-Color: $this->color <br/>-Peso: $this->peso <br/>-Año de fabricación: " . Self::ANIO . " <br/>-Kilometraje: $this->kilometraje<br/>";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 2</title>
    </head>
    <body>
        <?php
            $coche = new Coche("Rojo", "693Kg", 0);
            //$coche->obtenerInformacion();
            echo $coche;
            $coche->avanzar();
            $coche->maniobrar("derecha");
            $coche->retroceder();     
        ?>
    </body>
</html>