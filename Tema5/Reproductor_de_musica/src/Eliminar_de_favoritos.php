<?php
    include_once("./Funciones.inc.php");

    session_start();

    if(isset($_GET['id'])) {
        $idCancion = urldecode($_GET['id']);
    }

    eliminarCancionDeFavoritos($_SESSION['usuario']['username'], $idCancion);
?>