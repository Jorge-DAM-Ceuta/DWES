<?php
    class Coche{
        private $marca, $modelo, $color, $peso, $anioFabricacion, $kilometraje;

        public function __construct($marca="", $modelo="", $color="", $peso="", $anioFabricacion="", $kilometraje=0){
            $this->marca = $marca;
            $this->modelo = $modelo;
            $this->color = $color;
            $this->peso = $peso;
            $this->anioFabricacion = $anioFabricacion;
            $this->kilometraje = $kilometraje;   
        }

        public function avanzar(){
            $this->kilometraje++;   
            echo "<br/>El coche ha avanzado 1 kilómetro; Kilómetros totales: $this->kilometraje.<br/>";
        }
        
        public function retroceder(){
            $this->kilometraje--;   
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
            echo "<h2>Información del vehículo</h2>-Marca: $this->marca <br/>-Modelo: $this->modelo <br/>-Color: $this->color <br/>-Peso: $this->peso <br/>-Año de fabricación: $this->anioFabricacion <br/>-Kilometraje: $this->kilometraje<br/>";
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
            $coche = new Coche("Mercedes Benz", "Maybach", "Rojo", "693Kg", 2016, 0);
            $coche->obtenerInformacion();
            $coche->avanzar();
            $coche->maniobrar("derecha");
            $coche->retroceder();     
        ?>
    </body>
</html>