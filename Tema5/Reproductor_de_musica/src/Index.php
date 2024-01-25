<?php
    include_once("./clases/Cancion.php");
    include_once("./Funciones.inc.php");
    
    session_start();

    if (!isset($_SESSION['usuario']) || !$_SESSION['usuario']) {
        header("Location: Iniciar_sesion.php");
        exit();
    }

    $arrayCanciones = instanciarCanciones(decodificarCanciones());
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style/index.css">
        <title>Tienda Online</title>
    </head>
    <body>
            <!-- Se muestran las canciones -->
            <h1>Canciones</h1>
            <a class="enlace-volver" href="Cerrar_sesion.php">Cerrar sesión</a>
            <?php mostrarCanciones($arrayCanciones); ?>
    </body>
</html>

