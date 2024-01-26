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
        <script src="https://kit.fontawesome.com/001ac9542b.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="./style/index.css">
        <title>Tienda Online</title>
    </head>
    <body>
        <nav class="menu">
            <h1>Canciones</h1>

            <ul>
                <li><a href="Cerrar_sesion.php">Cerrar sesión</a></li>
                <li><a href="Aniadir_cancion.php">Añadir canción</a></li>
                <li><a href="Listas_reproduccion.php">Listas de reproducción</a></li>
                <li><a href="Discos.php">Discos</a></li>
            </ul>
        </nav>

        <!-- Se muestran las canciones -->
            <?php mostrarCanciones($arrayCanciones); ?>
    </body>
</html>

