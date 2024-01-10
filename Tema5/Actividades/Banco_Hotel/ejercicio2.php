<?php
    class Habitacion{
        private int $numero, $camas, $capacidad;
        private bool $disponible, $limpia;

        public function __construct(int $numero=1, int $camas=1, int $capacidad=1, bool $disponible=true, bool $limpia=true){
            $this->numero = $numero;
            $this->camas = $camas;
            $this->capacidad = $capacidad;
            $this->disponible = $disponible;
            $this->limpia = $limpia;
        }

        public function actualizarDatos(int $numero, int $camas, int $capacidad, bool $disponible, bool $limpia){
            $this->numero = $numero;
            $this->camas = $camas;
            $this->capacidad = $capacidad;
            $this->disponible = $disponible;
            $this->limpia = $limpia;
        }

        public function marcarSucia(){
            $this->sucia = true;
            echo "<br/>La habitación está sucia.<br/>";
        }

        public function marcarLimpia(){
            $this->sucia = false;
            echo "<br/>La habitación está limpia.<br/>";
        }

        public function marcarDisponible(){
            $this->disponible = true;
            echo "<br/>La habitación está disponible.<br/>";
        }
        
        public function marcarOcupada(){
            $this->disponible = false;
            echo "<br/>La habitación está ocupada.<br/>";
        }
        
        public function verCapacidad(){
            echo "<br/>La habitación tiene una capacidad para " . $this->capacidad . " personas.<br/>";
        }

        public function verNumero(){
            echo "<br/>La habitación tiene el número " . $this->numero . ".<br/>";
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
            $habitacion = new Habitacion();
            echo "<p><strong>Información de la habitación:</strong></p>";
            $habitacion->verNumero();
            $habitacion->marcarLimpia();
            $habitacion->marcarDisponible();
            $habitacion->verCapacidad();
            $habitacion->marcarOcupada();
            $habitacion->marcarSucia();
            echo "<br/><p><strong>Actualización de la habitación:</strong></p>";
            $habitacion->actualizarDatos(416, 2, 2, true, true);
            $habitacion->verNumero();
            $habitacion->marcarLimpia();
            $habitacion->marcarDisponible();
            $habitacion->verCapacidad();
        ?>
    </body>
</html>