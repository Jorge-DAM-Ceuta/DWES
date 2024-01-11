<?php
    class Cuenta{
        private string $nombre, $apellidos, $dni;
        private float $saldo;
        private bool $activa;

        public function __construct(string $nombre="", string $apellidos="", string $dni="", float $saldo=0, bool $activa=true){
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->dni = $dni;
            $this->saldo = $saldo;
            $this->activa = $activa;
        }

        public function actualizarDatos(string $nombre, string $apellidos, string $dni, float $saldo, bool $activa){
                $this->nombre = $nombre;
                $this->apellidos = $apellidos;
                $this->dni = $dni;
                $this->saldo = $saldo;
                $this->activa = $activa;
        }

        public function ingresarDinero(float $cantidad){
            $this->saldo += $cantidad;
            echo "<br/>Se han ingresado $cantidad euros; Saldo actual: $this->saldo euros<br/>";
        }

        public function retirarDinero(float $cantidad){
            $this->saldo -= $cantidad;
            echo "<br/>Se han retirado $cantidad euros; Saldo actual: $this->saldo euros<br/>";
        }

        public function bloquear(){
            $this->activa = false;
            echo "<br/><strong>La cuenta ha sido bloqueada, por lo que ya no está activa.</strong><br/>";
        }

        public function desbloquear(){
            $this->activa = true;
            echo "<br/><strong>La cuenta ha sido desbloqueada, ya está activa.</strong><br/>";
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

            echo "<h2>Información de la cuenta</h2>-Titular: $this->apellidos, $this->nombre <br/>-DNI: $this->dni <br/>-Saldo: $this->saldo euros<br/>-Cuenta activa: $cuentaActiva<br/>";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 1</title>
    </head>
    <body>
        <h1>Mi banco</h1>

        <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST">
            <p>
                <label>Ingresar: <input type="text" name="cantidad1" placeholder="Cantidad a ingresar"></label>
                <input type="submit" name="ingresar" value="Ingresar">
            </p>

            <p>
                <label>Retirar: <input type="text" name="cantidad2" placeholder="Cantidad a retirar"></label>
                <input type="submit" name="retirar" value="Retirar">
            </p>
        </form>
        
        <?php
            $cuenta = new Cuenta("Jorge", "Muñoz García", "45124434K", 4000, activa:true);
            
            if(isset($_POST['ingresar']) && $_SERVER['REQUEST_METHOD'] == "POST"){
                $cantidadIngreso = $_POST['cantidad1'];
            }

            if(isset($_POST['ingresar']) && $_SERVER['REQUEST_METHOD'] == "POST"){
                $cantidadRetiro = $_POST['cantidad2'];
            }
        ?>
    </body>
</html>