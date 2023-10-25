<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 1</title>
    </head>
    <body>
        <?php

            $cartas = array("As", "Dos", "Tres", "Cuatro", "Cinco", "Seis", "Siete", "Sota", "Caballo", "Rey");
            $palo = array("Oro", "Basto", "Espada", "Copa");
            $puntos = array("As" => 11, "Dos" => 0, "Tres" => 10, "Cuatro" => 0, "Cinco" => 0, "Seis" => 0, "Siete" => 0, "Sota" => 2, "Caballo" => 3, "Rey" => 4);
            
            $cartasObtenidas = array();

            $resultado = 0;
            
            for($i = 0; $i<10; $i++){
                $paloActual = $palo[random_int(0, 3)];
                $numeroActual =  $cartas[random_int(0,9)];
                
                $puntosActual = $puntos[$numeroActual];

                $cartaObtenida = $numeroActual . " de " . $paloActual;

                if(!in_array($cartaObtenida, $cartasObtenidas)){
                    array_push($cartasObtenidas, $cartaObtenida);
                    $resultado += $puntosActual;
                    
                    echo "<p>" . $cartaObtenida . "</p>";

                }else{
                    $i--;
                }
            }

            echo "<p> Puntuación obtenida: " . $resultado . "</p>";
        ?> 
    </body>
</html>