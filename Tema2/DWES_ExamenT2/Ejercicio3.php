<?php

    include_once "./conversiones.inc.php";

    $tipoDeConversion = readline("Elije una conversión: 1) Binario a Decimal o 2) Decimal a Binario");
    
    if($tipoDeConversion == 1){
        $numero = readline("Introduce un número binario:");

        binarioADecimal($numero);
        
    }else if($tipoDeConversion == 2){
        $numero = readline("Introduce un número entero:");

        decimalABinario($numero);
    }
    
    

?>