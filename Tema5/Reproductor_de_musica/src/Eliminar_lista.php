<?php
include_once("./clases/Usuario.php");

session_start();

if (isset($_GET["nombreLista"])) {
    $nombreLista = $_GET["nombreLista"];

    Usuario::eliminarListaReproduccion($_SESSION['usuario']['username'], $nombreLista);
}
