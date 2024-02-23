<?php
include_once("./clases/Disco.php");

if (isset($_GET['id'])) {
    $idDisco = urldecode($_GET['id']);

    Disco::eliminarDisco($idDisco);
}
