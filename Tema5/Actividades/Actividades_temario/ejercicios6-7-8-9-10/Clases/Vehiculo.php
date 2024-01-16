<?php
    include_once("Interfaces/Interfaces_vehiculo.php");
    include_once("Traits/Traits_vehiculo.php");
    include_once("Enumeraciones/Enumeraciones_vehiculo.php");

    abstract class Vehiculo{
        protected string $marca, $modelo, $color;
        protected float $peso, $kilometraje, $cantidadGasolina;
        protected int $anioFabricacion;
        protected static int $numeroCambioColor;  
        protected array $personas;
        protected CategoriaEmisiones $categoriaEmisiones;
        
        public function __construct(string $color="Negro", float $peso=1000, $categoriaEmisiones=CategoriaB){
            $this->marca = "Mercedes Benz";
            $this->modelo = "Maybach";
            $this->color = $color;
            $this->peso = $peso;
            $this->anioFabricacion = 2016;
            $this->kilometraje = 0;  
            $this->cantidadGasolina = 60;
            $this->personas = array();
            $this->categoriaEmisiones = $categoriaEmisiones;
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

        public function setCantidadGasolina(float $cantidadGasolina){
            $this->cantidadGasolina = $cantidadGasolina;
        }

        public function getCantidadGasolina():float{
            return $this->cantidadGasolina;
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

        public function getCategoria(){
            return $this->categoriaEmisiones->value;
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

        abstract public function aniadirPersona(float $pesoPersona);

        /*????????????????????????????????????????????????*/
        public static function verAtributo($objeto){
            return $objeto::__toString();
        }
        /*????????????????????????????????????????????????*/

        public function obtenerInformacion(){
            echo "<h2>Estado del vehículo</h2>-Marca: $this->marca <br/>-Modelo: $this->modelo <br/>-Color: $this->color <br/>-Peso: $this->peso <br/>-Año de fabricación: $this->anioFabricacion <br/>-Kilometraje: $this->kilometraje <br/>-Litros de combustible: $this->cantidadGasolina<br/>-Número de ocupantes: " . count($this->personas) . "<br/>";
        }

        public function __toString(){
            return "<h2>Estado del vehículo</h2>-Marca: $this->marca <br/>-Modelo: $this->modelo <br/>-Color: $this->color <br/>-Peso: $this->peso <br/>-Año de fabricación: $this->anioFabricacion <br/>-Kilometraje: $this->kilometraje <br/>-Litros de combustible: $this->cantidadGasolina<br/>-Número de ocupantes: " . count($this->personas) . "<br/>";
        }
    }
?>