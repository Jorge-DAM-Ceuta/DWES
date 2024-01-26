<?php
    include_once("./Funciones.inc.php");

    session_start();

    if(isset($_GET['id'])) {
        $idCancion = urldecode($_GET['id']);
    }

    $arrayJSON = decodificarCanciones();
    $cancionActual = obtenerCancionJSON($arrayJSON, $idCancion);

    aniadirCancionAFavoritos($_SESSION['usuario']['username'], $cancionActual);
?>