<?php

    include_once("./Funciones.inc.php");

    $listas = decodificarListas("ListaTareas.json");

    $id = $_GET["id"];
    $lista = $_GET["lista"];

    marcarTareaPendiente($listas, $id, $lista);

?>