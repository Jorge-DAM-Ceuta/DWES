<?php
    include_once("./Funciones.inc.php");

    session_start();

    if(isset($_GET["nombreLista"])){
        $nombreLista = $_GET["nombreLista"];
        
        eliminarListaReproduccion($_SESSION['usuario']['username'], $nombreLista);
    }
?>