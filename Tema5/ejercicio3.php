<?php
    class Cuenta{
        private $nombre, $apellidos, $dni, $saldo, $activa;

        public function __construct($nombre="", $apellidos="", $dni="", $saldo=0, $activa=true){
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->dni = $dni;
            $this->saldo = $saldo;
            $this->activa = $activa;
        }

        public function actualizarDatos($nombre=$this->nombre, $apellidos=$this->apellidos, $dni=$this->dni, $saldo=$this->saldo, $activa=$this->activa){
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->dni = $dni;
            $this->saldo = $saldo;
            $this->activa = $activa;
        }

        public function ingresarDinero($cantidad){
            $this->saldo += $cantidad;
            echo "<br/>Se han ingresado $cantidad euros; Saldo actual: $this->saldo<br/>";
        }

        public function retirarDinero($cantidad){
            $this->saldo -= $cantidad;
            echo "<br/>Se han retirado $cantidad euros; Saldo actual: $this->saldo<br/>";
        }

        public function bloquear(){
            $this->activa = false;
            echo "<br/>La cuenta ha sido bloqueada, por lo que ya no está activa.<br/>";
        }

        public function desbloquear(){
            $this->activa = true;
            echo "<br/>La cuenta ha sido desbloqueada, ya está activa.<br/>";
        }

        public function mostrarInformacion(){
            echo "<br/><br/>";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 3</title>
    </head>
    <body>
        <?php
            $cuenta = new Cuenta("Jorge", "Muñoz García", "45124434K", activa:true);
            $cuenta->actualizarDatos();


        ?>
    </body>
</html>