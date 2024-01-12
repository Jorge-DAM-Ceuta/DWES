<?php
    function obtenerJSON(){
        $jsonContent = file_get_contents("./Movimientos.json");
        $datos = json_decode($jsonContent, true);
    
        return $datos[0];
    }

    function registrarMovimiento($tipo, $cantidad, $concepto, $saldo, $movimientos){
        $datos = obtenerJSON();

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
        file_put_contents("./Movimientos.json", $jsonContent);
    }
?>