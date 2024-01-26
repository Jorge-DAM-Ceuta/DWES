<?php
    include_once("./Funciones.inc.php");

    if(isset($_GET['id'])) {
        $idCancion = urldecode($_GET['id']);

        eliminarCancion($idCancion);
    }
?>