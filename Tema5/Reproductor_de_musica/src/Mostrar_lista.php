<?php
    include_once("./Funciones.inc.php");

    session_start();

    if(isset($_GET["nombreLista"])){
        $nombreLista = $_GET["nombreLista"];
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style/mostrar_lista.css">
        <title>Lista de reproducción</title>
    </head>
    <body>
        <nav class="menu">
            <h1>Lista <?php echo $nombreLista; ?></h1>

            <ul>
                <li><a href="Cerrar_sesion.php">Cerrar sesión</a></li>
                <li><a href="Listas_reproduccion.php">Listas de reproducción</a></li>
                <li><a href="Index.php">Canciones</a></li>
                <li><a href="Discos.php">Discos</a></li>
            </ul>
        </nav>

        <?php mostrarCancionesLista(obtenerCancionesLista($_SESSION["usuario"]["username"], $nombreLista), $nombreLista); ?>
    </body>
</html>