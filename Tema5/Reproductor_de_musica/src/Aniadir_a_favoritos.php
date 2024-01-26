<?php
    include_once("./Funciones.inc.php");

    session_start();

    if(isset($_GET['id'])) {
        $idCancion = urldecode($_GET['id']);
    }

    $listasReproduccion = obtenerListasUsurio($_SESSION['usuario']['username']);
    $arrayJSON = decodificarCanciones();
    $cancionActual = obtenerCancionJSON($arrayJSON, $idCancion);

    aniadirCancionAFavoritos($_SESSION['usuario']['username'], $cancionActual);
?>