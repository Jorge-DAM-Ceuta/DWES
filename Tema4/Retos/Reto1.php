<?php 

    $arrayAbaco = array("O---OOOOOOOO", 
                   "OOO---OOOOOO", 
                   "---OOOOOOOOO", 
                   "OO---OOOOOOO", 
                   "OOOOOOO---OO", 
                   "OOOOOOOOO---", 
                   "---OOOOOOOOO"
                );

    
    function calculaAbaco($abaco){
        $resultado = "";

        foreach($abaco as $valores => $valor){
            $numeros = 0;
            $guiones = 0; 
            
            for($i = 0; $i<count($abaco); $i++){
                if($valor[$i] == "-"){
                    $guiones++;

                    if($valor[$i+1] == "O"){
                        $restante = 12 - ($numeros + $guiones);
                        $numeros += $restante;
                    }
                }else if($valor[$i] == "O"){
                    $numeros++;
                }
            }
            echo "<h3>NUMEROS FILA 1: $numeros, ELEMENTOS DEL ARRAY: $valor</h3>";
        }
    }

    calculaAbaco($arrayAbaco);
?>