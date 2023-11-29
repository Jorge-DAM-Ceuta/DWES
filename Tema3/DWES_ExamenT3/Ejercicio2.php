<?php

    $elementos = array("Piedra","Papel","Tijera","Lagarto","Spock");

    $jugada1 = array("Jugada1J1" => "", "Jugada1J2" => "");
    $jugada2 = array("Jugada2J1" => "", "Jugada2J2" => "");
    $jugada3 = array("Jugada3J1" => "", "Jugada3J2" => "");

    function tiradas(array &$jugada1, array &$jugada2, array &$jugada3, array $elementos){
        echo "<h3>JUGADA 1</h3>";
        $jugada1['Jugada1J1'] = $elementos[random_int(0, 4)];
        echo "<p>Jugador 1: " . $jugada1['Jugada1J1'] . "</p>";

        $jugada1['Jugada1J2'] = $elementos[random_int(0, 4)];
        echo "<p>Jugador 2: " . $jugada1['Jugada1J2'] . "</p>";
        
        echo "<h3>JUGADA 2</h3>";
        $jugada2['Jugada2J1'] = $elementos[random_int(0, 4)];
        echo "<p>Jugador 1: " . $jugada2['Jugada2J1'] . "</p>";
        
        $jugada2['Jugada2J2'] = $elementos[random_int(0, 4)];
        echo "<p>Jugador 2: " . $jugada2['Jugada2J2'] . "</p>";

        echo "<h3>JUGADA 3</h3>";
        $jugada3['Jugada3J1'] = $elementos[random_int(0, 4)];
        echo "<p>Jugador 1: " . $jugada3['Jugada3J1'] . "</p>";

        $jugada3['Jugada3J2'] = $elementos[random_int(0, 4)];
        echo "<p>Jugador 2: " . $jugada3['Jugada3J2'] . "</p>";
    }

    function juego(array $jugada1, array $jugada2, array $jugada3){
        $puntosJ1 = 0;
        $puntosJ2 = 0;

        if($jugada1['Jugada1J1'] == $jugada1['Jugada1J2']){
            $puntosJ1 = $puntosJ1;
            $puntosJ2 = $puntosJ2;
        }else if($jugada1['Jugada1J1'] == "Piedra" && $jugada1['Jugada1J2'] == "Lagarto"){
            $puntosJ1++;
        }else if($jugada1['Jugada1J1'] == "Lagarto" && $jugada1['Jugada1J2'] == "Piedra"){
            $puntosJ2++;
        }else if($jugada1['Jugada1J1'] == "Lagarto" && $jugada1['Jugada1J2'] == "Spock"){
            $puntosJ1++;
        }else if($jugada1['Jugada1J1'] == "Spock" && $jugada1['Jugada1J2'] == "Lagarto"){
            $puntosJ2++;
        }else if($jugada1['Jugada1J1'] == "Spock" && $jugada1['Jugada1J2'] == "Tijera"){
            $puntosJ1++;
        }else if($jugada1['Jugada1J1'] == "Tijera" && $jugada1['Jugada1J2'] == "Spock"){
            $puntosJ2++;
        }else if($jugada1['Jugada1J1'] == "Tijera" && $jugada1['Jugada1J2'] == "Papel"){
            $puntosJ1++;
        }else if($jugada1['Jugada1J1'] == "Papel" && $jugada1['Jugada1J2'] == "Tijera"){
            $puntosJ2++;
        }else if($jugada1['Jugada1J1'] == "Papel" && $jugada1['Jugada1J2'] == "Piedra"){
            $puntosJ1++;
        }else if($jugada1['Jugada1J1'] == "Piedra" && $jugada1['Jugada1J2'] == "Papel"){
            $puntosJ2++;
        }else if($jugada1['Jugada1J1'] == "Spock" && $jugada1['Jugada1J2'] == "Piedra"){
            $puntosJ1++;
        }else if($jugada1['Jugada1J1'] == "Piedra" && $jugada1['Jugada1J2'] == "Spock"){
            $puntosJ2++;
        }else if($jugada1['Jugada1J1'] == "Tijera" && $jugada1['Jugada1J2'] == "Lagarto"){
            $puntosJ1++;
        }else if($jugada1['Jugada1J1'] == "Lagarto" && $jugada1['Jugada1J2'] == "Tijera"){
            $puntosJ2++;
        }else if($jugada1['Jugada1J1'] == "Lagarto" && $jugada1['Jugada1J2'] == "Papel"){
            $puntosJ1++;
        }else if($jugada1['Jugada1J1'] == "Papel" && $jugada1['Jugada1J2'] == "Lagarto"){
            $puntosJ2++;
        }else if($jugada1['Jugada1J1'] == "Papel" && $jugada1['Jugada1J2'] == "Spock"){
            $puntosJ1++;
        }else if($jugada1['Jugada1J1'] == "Spock" && $jugada1['Jugada1J2'] == "Papel"){
            $puntosJ2++;
        }else if($jugada1['Jugada1J1'] == "Piedra" && $jugada1['Jugada1J2'] == "Tijera"){
            $puntosJ1++;
        }else if($jugada1['Jugada1J1'] == "Tijera" && $jugada1['Jugada1J2'] == "Piedra"){
            $puntosJ2++;
        }

        if($jugada2['Jugada2J1'] == $jugada2['Jugada2J2']){
            $puntosJ1 = $puntosJ1;
            $puntosJ2 = $puntosJ2;
        }else if($jugada2['Jugada2J1'] == "Piedra" && $jugada2['Jugada2J2'] == "Lagarto"){
            $puntosJ1++;
        }else if($jugada2['Jugada2J1'] == "Lagarto" && $jugada2['Jugada2J2'] == "Piedra"){
            $puntosJ2++;
        }else if($jugada2['Jugada2J1'] == "Lagarto" && $jugada2['Jugada2J2'] == "Spock"){
            $puntosJ1++;
        }else if($jugada2['Jugada2J1'] == "Spock" && $jugada2['Jugada2J2'] == "Lagarto"){
            $puntosJ2++;
        }else if($jugada2['Jugada2J1'] == "Spock" && $jugada2['Jugada2J2'] == "Tijera"){
            $puntosJ1++;
        }else if($jugada2['Jugada2J1'] == "Tijera" && $jugada2['Jugada2J2'] == "Spock"){
            $puntosJ2++;
        }else if($jugada2['Jugada2J1'] == "Tijera" && $jugada2['Jugada2J2'] == "Papel"){
            $puntosJ1++;
        }else if($jugada2['Jugada2J1'] == "Papel" && $jugada2['Jugada2J2'] == "Tijera"){
            $puntosJ2++;
        }else if($jugada2['Jugada2J1'] == "Papel" && $jugada2['Jugada2J2'] == "Piedra"){
            $puntosJ1++;
        }else if($jugada2['Jugada2J1'] == "Piedra" && $jugada2['Jugada2J2'] == "Papel"){
            $puntosJ2++;
        }else if($jugada2['Jugada2J1'] == "Spock" && $jugada2['Jugada2J2'] == "Piedra"){
            $puntosJ1++;
        }else if($jugada2['Jugada2J1'] == "Piedra" && $jugada2['Jugada2J2'] == "Spock"){
            $puntosJ2++;
        }else if($jugada2['Jugada2J1'] == "Tijera" && $jugada2['Jugada2J2'] == "Lagarto"){
            $puntosJ1++;
        }else if($jugada2['Jugada2J1'] == "Lagarto" && $jugada2['Jugada2J2'] == "Tijera"){
            $puntosJ2++;
        }else if($jugada2['Jugada2J1'] == "Lagarto" && $jugada2['Jugada2J2'] == "Papel"){
            $puntosJ1++;
        }else if($jugada2['Jugada2J1'] == "Papel" && $jugada2['Jugada2J2'] == "Lagarto"){
            $puntosJ2++;
        }else if($jugada2['Jugada2J1'] == "Papel" && $jugada2['Jugada2J2'] == "Spock"){
            $puntosJ1++;
        }else if($jugada2['Jugada2J1'] == "Spock" && $jugada2['Jugada2J2'] == "Papel"){
            $puntosJ2++;
        }else if($jugada2['Jugada2J1'] == "Piedra" && $jugada2['Jugada2J2'] == "Tijera"){
            $puntosJ1++;
        }else if($jugada2['Jugada2J1'] == "Tijera" && $jugada2['Jugada2J2'] == "Piedra"){
            $puntosJ2++;
        }

        if($jugada3['Jugada3J1'] == $jugada3['Jugada3J2']){
            $puntosJ1 = $puntosJ1;
            $puntosJ2 = $puntosJ2;
        }else if($jugada3['Jugada3J1'] == "Piedra" && $jugada3['Jugada3J2'] == "Lagarto"){
            $puntosJ1++;
        }else if($jugada3['Jugada3J1'] == "Lagarto" && $jugada3['Jugada3J2'] == "Piedra"){
            $puntosJ2++;
        }else if($jugada3['Jugada3J1'] == "Lagarto" && $jugada3['Jugada3J2'] == "Spock"){
            $puntosJ1++;
        }else if($jugada3['Jugada3J1'] == "Spock" && $jugada3['Jugada3J2'] == "Lagarto"){
            $puntosJ2++;
        }else if($jugada3['Jugada3J1'] == "Spock" && $jugada3['Jugada3J2'] == "Tijera"){
            $puntosJ1++;
        }else if($jugada3['Jugada3J1'] == "Tijera" && $jugada3['Jugada3J2'] == "Spock"){
            $puntosJ2++;
        }else if($jugada3['Jugada3J1'] == "Tijera" && $jugada3['Jugada3J2'] == "Papel"){
            $puntosJ1++;
        }else if($jugada3['Jugada3J1'] == "Papel" && $jugada3['Jugada3J2'] == "Tijera"){
            $puntosJ2++;
        }else if($jugada3['Jugada3J1'] == "Papel" && $jugada3['Jugada3J2'] == "Piedra"){
            $puntosJ1++;
        }else if($jugada3['Jugada3J1'] == "Piedra" && $jugada3['Jugada3J2'] == "Papel"){
            $puntosJ2++;
        }else if($jugada3['Jugada3J1'] == "Spock" && $jugada3['Jugada3J2'] == "Piedra"){
            $puntosJ1++;
        }else if($jugada3['Jugada3J1'] == "Piedra" && $jugada3['Jugada3J2'] == "Spock"){
            $puntosJ2++;
        }else if($jugada3['Jugada3J1'] == "Tijera" && $jugada3['Jugada3J2'] == "Lagarto"){
            $puntosJ1++;
        }else if($jugada3['Jugada3J1'] == "Lagarto" && $jugada3['Jugada3J2'] == "Tijera"){
            $puntosJ2++;
        }else if($jugada3['Jugada3J1'] == "Lagarto" && $jugada3['Jugada3J2'] == "Papel"){
            $puntosJ1++;
        }else if($jugada3['Jugada3J1'] == "Papel" && $jugada3['Jugada3J2'] == "Lagarto"){
            $puntosJ2++;
        }else if($jugada3['Jugada3J1'] == "Papel" && $jugada3['Jugada3J2'] == "Spock"){
            $puntosJ1++;
        }else if($jugada3['Jugada3J1'] == "Spock" && $jugada3['Jugada3J2'] == "Papel"){
            $puntosJ2++;
        }else if($jugada3['Jugada3J1'] == "Piedra" && $jugada3['Jugada3J2'] == "Tijera"){
            $puntosJ1++;
        }else if($jugada3['Jugada3J1'] == "Tijera" && $jugada3['Jugada3J2'] == "Piedra"){
            $puntosJ2++;
        }

        if($puntosJ1 > $puntosJ2){
            return "Jugador 1";
        }else if($puntosJ2 > $puntosJ1){
            return "Jugador 2";
        }else if($puntosJ1 == $puntosJ2){
            return "Empate";
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Piedra, papel, tijera, lagarto o spock</title>
    </head>
    <body>
        <?php
            tiradas($jugada1, $jugada2, $jugada3, $elementos);
            $resultado = juego($jugada1, $jugada2, $jugada3);

            echo "<h1>Resultado: $resultado</h1>";
        ?>
    </body>
</html>

