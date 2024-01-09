<?php
    class Cuenta{
        private string $nombre, $apellidos, $dni;
        private float $saldo;
        private bool $activa;

        public function __construct($nombre="", $apellidos="", $dni="", $saldo=0, $activa=true){
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->dni = $dni;
            $this->saldo = $saldo;
            $this->activa = $activa;
        }

        public function actualizarDatos($nombre, $apellidos, $dni, $saldo, $activa){
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
            $cuentaActiva = "";

            switch($this->activa){
                case true:
                    $cuentaActiva = "Si";
                break;

                case false:
                    $cuentaActiva = "No";
                break;
            }

            echo "<h2>Información de la cuenta</h2>-Titular: $this->apellidos, $this->nombre <br/>-DNI: $this->dni <br/>-Saldo: $this->saldo <br/>-Cuenta activa: $cuentaActiva<br/>";
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
            $cuenta->mostrarInformacion();
            $cuenta->actualizarDatos(apellidos:"Vargas Rodríguez", dni:"45231246I", saldo:3600, activa:true);
            $cuenta->mostrarInformacion();

        ?>
    </body>
</html>