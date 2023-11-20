<?php

    include_once("./Funciones.inc.php");

    $notas = decodificarNotas("Notas.json");
    
    $titulo = $_GET['titulo'];

    eliminarNota($notas, $titulo);

?>