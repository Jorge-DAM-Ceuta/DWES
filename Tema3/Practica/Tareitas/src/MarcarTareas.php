<?php

    include_once("./Funciones.inc.php");

    $listas = decodificarListas("ListaTareas.json");
    $lista = $_GET['lista'];

    marcarTodoCompletado($listas, $lista);
    header('location: ../Listas.php');
?>