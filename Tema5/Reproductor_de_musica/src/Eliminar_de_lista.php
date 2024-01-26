<?php
    include_once("./Funciones.inc.php");

    session_start();

    if(isset($_GET['id'])) {
        $idCancion = urldecode($_GET['id']);
    }

    if(isset($_GET['nombreLista'])) {
        $nombreLista = urldecode($_GET['nombreLista']);
    }

    eliminarCancionDeLista($_SESSION['usuario']['username'], $nombreLista, $idCancion);
?>