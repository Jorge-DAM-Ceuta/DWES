<?php

    include_once("./Clases/Vehiculo.php");
    include_once("./Clases/Cuatro_ruedas.php");
    include_once("./Clases/Coche.php");
    include_once("./Clases/Camion.php");
    include_once("./Clases/Dos_ruedas.php");

    //Primer apartado
    $coche = new Coche("Verde", 1400, 4, 0);

    echo "<h2>Información del coche: Color: " . $coche->getColor() . "; Peso: " . $coche->getPeso() . "Kg</h2>";

    $coche->aniadirPersona(65);
    $coche->aniadirPersona(65);

    echo "<h2>Información del coche: Color: " . $coche->getColor() . "; Peso: " . $coche->getPeso() . "Kg</h2>";

    $coche->repintar("Rojo");
    $coche->aniadirCadenasNieve(2);

    echo "<h2>Información del coche: Color: " . $coche->getColor() . "; Número de cadenas de nieve: " . $coche->getNumeroCadenasNieve() . "</h2>";

    //Segundo apartado
    $moto = new Dos_ruedas("Negro", 120);

    echo "<h2>Información de la moto: Color: " . $moto->getColor() . "; Peso: " . $moto->getPeso() . "Kg</h2>";

    $moto->aniadirPersona(80);
    $moto->ponerGasolina(20);

    echo "<h2>Información de la moto: Color: " . $moto->getColor() . "; Peso: " . $moto->getPeso() . "Kg</h2>";

    //Tercer apartado
    $camion = new Camion("Azul", 10000, 2, 10);

    echo "<h2>Información del camión: Color: " . $camion->getColor() . "; Peso: " . $camion->getPeso() . "Kg; Longitud: " . $camion->getLongitud() . " metros; Número de puertas: " . $camion->getNumeroPuertas() . "</h2>";

    $camion->aniadirRemolque(5);
    $camion->aniadirPersona(80);

    echo "<h2>Información del camión: Color: " . $camion->getColor() . "; Peso: " . $camion->getPeso() . "Kg; Longitud: " . $camion->getLongitud() . " metros; Número de puertas: " . $camion->getNumeroPuertas() . "</h2>";
?>