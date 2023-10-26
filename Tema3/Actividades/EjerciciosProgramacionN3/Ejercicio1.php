<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 1</title>
    </head>
    <body>

        <h1>Jugar a la Brisca</h1>
        <form name="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <input type="submit" name="jugar" value="Jugar">
        </form>

        <?php

            if(isset($_POST['jugar'])){
                /*En este ejercicio vamos a almacenar las cartas obtenidas en un array que se obtendrán a partir
                del palo de la carta, su valor y la puntuación de cada una. También almacenaremos la puntuación 
                de cada una en una variable resultado. */

                $cartas = array("As", "Dos", "Tres", "Cuatro", "Cinco", "Seis", "Siete", "Sota", "Caballo", "Rey");
                $palo = array("Oro", "Basto", "Espada", "Copa");
                $puntos = array("As" => 11, "Dos" => 0, "Tres" => 10, "Cuatro" => 0, "Cinco" => 0, "Seis" => 0, "Siete" => 0, "Sota" => 2, "Caballo" => 3, "Rey" => 4);
                
                $cartasObtenidas = array();
                $resultado = 0;
                
                /*En este bucle for se escogen 10 cartas aleatoriamente mediante un palo y un número.

                A partir de estos valores se obtiene la puntuación de la carta y se almacena la 
                información de la carta en una variable para mostrar la carta obtenida en cada vuelta.
                
                Si la carta que hemos obtenido no se encuentra en la baraja se cuenta, en caso contrario
                se disminuye el valor del iterador $i para obtener otra distinta. En caso de que no se 
                encuentre en el array de las cartas obtenidas se añade dicha carta con array_push() y se
                suma al resultado los puntos correspondientes obtenidos de la carta, además se muestra la 
                carta obtenida por pantalla con el número de la tirada.

                Por último se muestra la puntuación total obtenida de todas las cartas.
                */
                for($i = 0; $i<10; $i++){
                    $paloActual = $palo[random_int(0, 3)];
                    $numeroActual =  $cartas[random_int(0,9)];
                    
                    $puntosActual = $puntos[$numeroActual];

                    $cartaObtenida = $numeroActual . " de " . $paloActual;

                    if(!in_array($cartaObtenida, $cartasObtenidas)){
                        array_push($cartasObtenidas, $cartaObtenida);
                        $resultado += $puntosActual;
                        
                        echo "<p>Carta número: " . $i . ": " . $cartaObtenida . "</p>";

                    }else{
                        $i--;
                    }
                }

                echo "<p> Puntuación obtenida: " . $resultado . "</p>";
            }
        ?> 
    </body>
</html>