<?php
include_once("./clases/Usuario.php");

session_start();

if (isset($_GET['id'])) {
    $idCancion = urldecode($_GET['id']);
}

if (isset($_GET['nombreLista'])) {
    $nombreLista = urldecode($_GET['nombreLista']);
}

Usuario::eliminarCancionDeLista($_SESSION['usuario']['username'], $nombreLista, $idCancion);
