<?php

    $longitudBase = readline("Introduce un número entero:");

    $basePiramide = array();
    $nuevaBase = "";

    for($i = 1; $i<=$longitudBase; $i++){
        array_push($basePiramide, $i);
    }

    for($i = $longitudBase; $i>0; $i--){
        array_push($basePiramide, $i);
    }

    for($i = 0; $i<count($basePiramide); $i++){
        
        if($basePiramide[$i] == $longitudBase){
            $nuevaBase .= " ";
        }else{
            $nuevaBase .= $basePiramide[$i];
        }
    }

    echo "\n" . $nuevaBase;

    foreach($basePiramide as $digito){
        echo $digito;
    }

    echo "\n" . $nuevaBase;
?>