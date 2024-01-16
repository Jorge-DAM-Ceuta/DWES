<?php

    include_once("./Clases/Vehiculo.php");
    include_once("./Clases/Cuatro_ruedas.php");
    include_once("./Clases/Coche.php");
    include_once("./Clases/Camion.php");
    include_once("./Clases/Dos_ruedas.php");

    //Primer apartado
    $moto = new Dos_ruedas("Rojo", 150);

    echo "<h2>Información de la moto: Color: " . $moto->getColor() . "; Peso: " . $moto->getPeso() . "Kg</h2>";

    $moto->aniadirPersona(70);

    echo "<h2>Peso actual de la moto: " . $moto->getPeso() . "Kg</h2>";

    $moto->repintar("Verde");
    $moto->setCilindrada(1000);
    /*?USAR verAtributo()?*/

    //Segundo apartado
    $camion = new Camion("Blanco", 6000);

    echo "<h2>Información del camión: Color: " . $camion->getColor() . "; Peso: " . $camion->getPeso() . "Kg; Longitud: " . $camion->getLongitud() . " metros; Número de puertas: " . $camion->getNumeroPuertas() . "</h2>";

    $camion->aniadirPersona(84);
    $camion->repintar("Azul");
    $camion->setNumeroPuertas($camion->getNumeroPuertas() + 2);
    /*?USAR verAtributo()?*/

    echo "<h2>Información del camión: Color: " . $camion->getColor() . "; Peso: " . $camion->getPeso() . "Kg; Longitud: " . $camion->getLongitud() . " metros; Número de puertas: " . $camion->getNumeroPuertas() . "</h2>";

    $vehiculo = new Vehiculo();
    echo "" . $vehiculo->getCategoria();
?>