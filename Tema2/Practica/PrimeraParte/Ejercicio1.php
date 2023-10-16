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

/*En este bucle se recorre el array que contiene las preguntas, en su 
interior mediante otro bucle do-while se comprueba que la respuesta 
recogida por el usuario debe ser si, s, yes, y, no o n no.

Mientras eso no se cumpla se seguirá preguntando lo mismo hasta que la 
respuesta sea válida, así se pasará a la siguiente vuelta del bucle for 
y se preguntará la siguiente de la lista. 

Si las respuestas son afirmativas se sumarán puntos al nivel de infidelidad.
*/
for($i = 0; $i<count($preguntas); $i++){
    do{
        $respuesta = readline($preguntas[$i]);

        if(strtolower($respuesta) == "si" || strtolower($respuesta) == "s" || strtolower($respuesta) == "yes" || strtolower($respuesta) == "y"){
            switch($i){
                case 0;
                $nivelDeInfidelidad += 1;
                    break;
                
                case 1;
                $nivelDeInfidelidad += 2;
                    break;

                case 2;
                $nivelDeInfidelidad += + 3;
                    break;

                case 3;
                $nivelDeInfidelidad += + 4;
                    break;

                case 4;
                $nivelDeInfidelidad += + 5;
                    break;

                case 5;
                $nivelDeInfidelidad += 6;
                    break;

                case 6;
                $nivelDeInfidelidad += 7;
                    break;

                case 7;
                $nivelDeInfidelidad += 8;
                    break;

                case 8;
                $nivelDeInfidelidad += 9;
                    break;

                case 9;
                $nivelDeInfidelidad += 10;
                    break;
            }
        }
    }while(!(strtolower($respuesta) == "si" || strtolower($respuesta) == "s" || strtolower($respuesta) == "yes" || strtolower($respuesta) == "y" || strtolower($respuesta) == "no" || strtolower($respuesta) == "n"));

}

echo "El nivel de infidelidad de tu pareja es de " . $nivelDeInfidelidad . "/55.\n";

/*Según el valor del nivel de infidelidad se mostrará un mensaje u otro por pantalla. */
if($nivelDeInfidelidad >= 0 && $nivelDeInfidelidad <=10){
    echo "¡Enhorabuena! tu pareja parece ser totalmente fiel.";
}else if($nivelDeInfidelidad >= 11 && $nivelDeInfidelidad <=22){
    echo "Quizás exista el peligro de otra persona en su vida o en su mente, aunque seguramente será algo sin importancia. No bajes la guardia.";
}else if($nivelDeInfidelidad >= 22 && $nivelDeInfidelidad <=30){
    echo "Tu pareja tiene todos los ingredientes para estar viviendo un romance con otra persona. Te aconsejamos que indagues un poco más y averigües que es lo que está pasando por su cabeza.";
}

?>