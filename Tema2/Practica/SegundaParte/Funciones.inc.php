<?php

    function comprobarDNI($dni){
        $letrasDNI = array("T", "R", "W", "A", "G", "M", "Y", "F", "P", "D", "X", "B", "N", "J", "Z", "S", "Q", "V", "H", "L", "C", "K", "E");
        $splitDNI;

        if($dni[strlen($dni)-2] == "-"){    
            $splitDNI = explode("-", $dni);

            if($splitDNI[1] == $letrasDNI[($splitDNI[0] % 23)]){
                echo "EL DNI ES VÁLIDO.";
            }else{
                echo "EL DNI NO ES CORRECTO.";
            }
            
        }else{
            if($dni[strlen($dni)-1] == $letrasDNI[(substr($dni, 0, -1) % 23)]){
                echo "EL DNI ES VÁLIDO.";
            }else{
                echo "EL DNI NO ES CORRECTO.";
            }
        }
    }

    
?>