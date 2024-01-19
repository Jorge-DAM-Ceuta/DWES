<?php

    $textoHeterograma = "abcdef";
    $textoIsograma = "hola";
    $textoPangrama = "El veloz murcielago hindu comia feliz cardillo y kiwi. La cigüeña tocaba el saxofon detras del palenque de paja";

    function esHeterograma($texto):bool{
        $letras = str_split($texto);
        $contador = array_count_values($letras);
        
        foreach($contador as $valor){
            if($valor > 1){
                return false;
            }
        }
    
        return true;
    }

    function esIsograma($texto):bool{
        $letras = str_split($texto);
        $letrasUnicas = array();
    
        foreach($letras as $letra){
            if(in_array($letra, $letrasUnicas)){
                return false;
            }else{
                $letrasUnicas[] = $letra;
            }
        }
    
        return true;
    }

    function esPangrama($texto):bool{
        $texto = trim($texto);
        $letras = str_split(strtolower($texto));
        $letrasUnicas = array_count_values($letras);

        if(count($letrasUnicas) == 27){
            return true;
        }else{
            return false;
        }
    }

    if(esHeterograma($textoHeterograma)){
        $resultadoHeterograma = "Si";
    }else{
        $resultadoHeterograma = "No";
    }
    
    
    if(esIsograma($textoIsograma)){
        $resultadoIsograma = "Si";
    }else{
        $resultadoIsograma = "No";
    }

    
    if(esPangrama($textoPangrama)){
        $resultadoPangrama = "Si";
    }else{
        $resultadoPangrama = "No";
    }

    echo "<h2>¿Cumple los principios de un heterograma? $resultadoHeterograma</h2>";
    echo "<h2>¿Cumple los principios de un isograma? $resultadoIsograma</h2>";
    echo "<h2>¿Cumple los principios de un pangrama? $resultadoPangrama</h2>";
?>
