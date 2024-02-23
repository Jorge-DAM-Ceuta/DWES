<?php
    class Cuenta{
        private string $nombre, $apellidos, $dni;
        private float $saldo;
        private bool $activa;
        private array $movimientos;

        public function __construct(string $nombre="", string $apellidos="", string $dni="", float $saldo=0, bool $activa=true){
            $this->nombre = $nombre;
            $this->apellidos = $apellidos;
            $this->dni = $dni;
            $this->saldo = $saldo;
            $this->activa = $activa;
            $this->movimientos = Cuenta::getDatos()["movimientos"];
        }

        public function actualizarDatos(string $nombre, string $apellidos, string $dni, float $saldo, bool $activa){
                $this->nombre = $nombre;
                $this->apellidos = $apellidos;
                $this->dni = $dni;
                $this->saldo = $saldo;
                $this->activa = $activa;
        }

        public static function getDatos(){
            $jsonContent = file_get_contents("./View/Assets/JSON/Movimientos.json");
            $datos = json_decode($jsonContent, true);
        
            return $datos[0];
        }

        public function getNombre():string{
            return $this->nombre;
        }

        public function getSaldo():float{
            return $this->saldo;
        }

        function registrarMovimiento($tipo, $cantidad, $concepto, $saldo, $movimientos){
            $datos = Cuenta::getDatos();
    
            $movimiento = array(
                "tipo" => $tipo,
                "cantidad" => $cantidad,
                "concepto" => $concepto,
                "fecha" => getdate()["mday"] . "/" . getdate()["mon"] . "/" . getdate()["year"]
            );
            
            $movimientos[] = $movimiento;
    
            $datos["saldoActual"] = $saldo;
            $datos["movimientos"] = $movimientos;
    
            $jsonContent = json_encode([$datos], JSON_PRETTY_PRINT);
            file_put_contents("./View/Assets/JSON/Movimientos.json", $jsonContent);
        }

        public function getMovimientos():array{
            return $this->movimientos;
        }

        public function ingresarDinero(float $cantidad, string $concepto){
            $this->saldo += $cantidad;
            $this->registrarMovimiento('Ingreso', $cantidad, $concepto, $this->saldo, $this->movimientos);
        }

        public function retirarDinero(float $cantidad, string $concepto){
            $this->saldo -= $cantidad;
            $this->registrarMovimiento('Retiro', $cantidad, $concepto, $this->saldo, $this->movimientos);
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