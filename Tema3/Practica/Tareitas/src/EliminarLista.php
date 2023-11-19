<?php

    include_once("./Funciones.inc.php");

    $listas = decodificarListas("ListaTareas.json");
    
    $nombreLista = $_GET['lista'];

    eliminarLista($listas, $nombreLista);

?>