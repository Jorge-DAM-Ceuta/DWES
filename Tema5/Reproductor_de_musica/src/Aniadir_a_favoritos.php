<?php
    include_once("./Funciones.inc.php");

    session_start();

    if(isset($_GET['id'])) {
        $idCancion = urldecode($_GET['id']);
    }

    $arrayJSON = decodificarCanciones();
    $cancionActual = obtenerCancionJSON($arrayJSON, $idCancion);

    aniadirCancionAFavoritos($_SESSION['usuario']['username'], $cancionActual);

    if(isset($_GET["ubicacion"])){
        header("Location: Index.php");
        exit();
    }else if(isset($_GET["nombreLista"])){
        header("Location: Mostrar_lista.php?nombreLista=" . $_GET["nombreLista"]);
        exit();
    }
    
?>