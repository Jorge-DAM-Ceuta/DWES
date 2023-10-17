<?php

    $direccion = "nose";

    if($direccion == "nose" || $direccion == "neso"){
        mostrarDiagonalArray(0, 0, $direccion);
        
    }

    function mostrarDiagonalArray($fila, $columna, $direccion){
                
        $array = array(
            array(1, 2, 3),
            array(4, 5, 6),
            array(7, 8, 9),
        );

        for($i = $fila; $i<count($array); $i++){
                    
            for($j = $columna; $j<count($array[$i]); $j++){
                if($j == 2 || $j == 5 || $j == 8){
                            
                    echo $array[$i][$j] . "<br>";
                    
                }else{
                    echo $array[$i][$j];
                }
            }
        }
    }

            

            

?>