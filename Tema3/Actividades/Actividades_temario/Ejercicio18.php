<?php

    function esNumero(int $numero): string|false {
        if(gettype($numero) === "integer") {
            return "$numero es un número entero.";
        }else{
            return false;
        }
    }

    function esTipo(int|string|float $tipo): ?string {
        if(gettype($tipo) === "integer") {
            return "$tipo es un número entero.";
        }else if(gettype($tipo) === "float" || gettype($tipo) === "double") {
            return "$tipo es un número decimal.";
        }else if(gettype($tipo) === "string") {
            return "$tipo es una cadena de caracteres.";
        }
    }

    function sumarValores(mixed $valor): mixed {
        $valores = array();

        foreach($valor as $valor) {
            array_push($valores, $valor);
        }

        return $valores;
    }

?>