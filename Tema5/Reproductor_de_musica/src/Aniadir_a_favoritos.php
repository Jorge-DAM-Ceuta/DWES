<?php
    include_once("./clases/Cancion.php");
    include_once("./clases/Usuario.php");

    session_start();

    if (isset($_GET['id'])) {
        $idCancion = urldecode($_GET['id']);
    }

    $arrayJSON = Cancion::decodificarCanciones();
    $cancionActual = Cancion::obtenerCancionJSON($arrayJSON, $idCancion);

    Usuario::aniadirCancionAFavoritos($_SESSION['usuario']['username'], $cancionActual);

    if (isset($_GET["ubicacion"])) {
        header("Location: Index.php");
        exit();
    } else if (isset($_GET["nombreLista"])) {
        header("Location: Mostrar_lista.php?nombreLista=" . $_GET["nombreLista"]);
        exit();
    }
