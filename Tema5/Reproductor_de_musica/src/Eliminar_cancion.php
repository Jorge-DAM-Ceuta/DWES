<?php
include_once("./clases/Cancion.php");

session_start();

if (isset($_GET['id'])) {
    $idCancion = urldecode($_GET['id']);

    Cancion::eliminarCancion($idCancion);
}
