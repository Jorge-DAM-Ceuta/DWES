<?php

$numeroAleatorio = random_int(0, 4);
$estado = "";

switch($numeroAleatorio){
    case 0:
        $estado = "Desconectado";
        echo "Estado actual: " . $estado;
        break;
    
    case 1:
        $estado = "Disponible";
        echo "Estado actual: " . $estado;
        break;

    case 2:
        $estado = "Ausente";
        echo "Estado actual: " . $estado;
        break;

    case 3:
        $estado = "Ocupado";
        echo "Estado actual: " . $estado;
        break;
    
    case 4:
        $estado = "Invisible";
        echo "Estado actual: " . $estado;
        break;

    default:
        $estado = "Desconectado";
        echo "Estado actual " . $estado;
        break;
}

$estado = match($numeroAleatorio){
    0 => "Desconectado",
    1 => "Disponible",
    2 => "Ausente",
    3 => "Ocupado",
    4 => "Invisible"
};

echo "<br>Estado actual: " . $estado;

?>