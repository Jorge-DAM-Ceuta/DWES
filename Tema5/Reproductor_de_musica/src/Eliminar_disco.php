<?php
    include_once("./Funciones.inc.php");

    if(isset($_GET['id'])) {
        $idDisco = urldecode($_GET['id']);

        eliminarDisco($idDisco);
    }
?>