<?php

$primeraPregunta = "¿Tu pareja parece estar más inquieta de lo normal sin motivo aparente?";
$segundaPregunta = "¿Ha aumentado significativamente sus gastos en ropa?";
$terceraPregunta = "¿Ha perdido el interés desmesurado que mostraba anteriormente por ti?";
$cuartaPregunta = "¿Se afeita y se asea con más frecuencia(si es hombre) o se arregla el pelo y se asea(si es mujer)?";
$quintaPregunta = "¿No te deja que te acerques a su móvil mientras se escribe con su 'madre'?";
$sextaPregunta = "¿A veces tiene llamadas que dice no querer contestar cuando estás tú delante?";
$septimaPregunta = "¿Últimamente se preocupa más en cuidar la línea y/o estar bronceado/a?";
$octavaPregunta = "¿Muchos días viene tarde después de trabajar porque dice tener mucho trabajo?";
$novenaPregunta = "¿Has notado que últimamente se perfuma más y ha cambiado de perfume?";
$decimaPregunta = "¿Se confunde y te dice que ha estado en sitios donde no ha ido contigo?";

$preguntas = [$primeraPregunta, $segundaPregunta, $terceraPregunta, $cuartaPregunta, $quintaPregunta, $sextaPregunta, $septimaPregunta, $octavaPregunta, $novenaPregunta, $decimaPregunta];

$nivelDeInfidelidad = 0;

for($i = 0; $i<count($preguntas); $i++){
    do{
        $respuesta = readline($preguntas[$i]);

        if(strtolower($respuesta) == "si" || strtolower($respuesta) == "s" || strtolower($respuesta) == "yes" || strtolower($respuesta) == "y"){
            echo $respuesta;
            switch($i){
                case 0;
                $nivelDeInfidelidad = $nivelDeInfidelidad + 1;
                    break;
                
                case 1;
                $nivelDeInfidelidad = $nivelDeInfidelidad + 2;
                    break;

                case 2;
                $nivelDeInfidelidad = $nivelDeInfidelidad + 3;
                    break;

                case 3;
                $nivelDeInfidelidad = $nivelDeInfidelidad + 4;
                    break;

                case 4;
                $nivelDeInfidelidad = $nivelDeInfidelidad + 5;
                    break;

                case 5;
                $nivelDeInfidelidad = $nivelDeInfidelidad + 6;
                    break;

                case 6;
                $nivelDeInfidelidad = $nivelDeInfidelidad + 7;
                    break;

                case 7;
                $nivelDeInfidelidad = $nivelDeInfidelidad + 8;
                    break;

                case 8;
                $nivelDeInfidelidad = $nivelDeInfidelidad + 9;
                    break;

                case 9;
                $nivelDeInfidelidad = $nivelDeInfidelidad + 10;
                    break;
            }
            echo $nivelDeInfidelidad;
        }
    }while((strtolower($respuesta) == "si") || (strtolower($respuesta) != "s") || (strtolower($respuesta) != "yes") || (strtolower($respuesta) != "y") || (strtolower($respuesta) != "no") || (strtolower($respuesta) != "n"));

}

echo "El nivel de infidelidad de tu pareja es de " . $nivelDeInfidelidad . "/55.";

?>