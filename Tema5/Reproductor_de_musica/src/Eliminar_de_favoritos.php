<?php
include_once("./clases/Usuario.php");

session_start();

if (isset($_GET['id'])) {
    $idCancion = urldecode($_GET['id']);
}

Usuario::eliminarCancionDeFavoritos($_SESSION['usuario']['username'], $idCancion);

if (isset($_GET["ubicacion"])) {
    header("Location: Index.php");
    exit();
} else if (isset($_GET["nombreLista"])) {
    header("Location: Mostrar_lista.php?nombreLista=" . $_GET["nombreLista"]);
    exit();
}
