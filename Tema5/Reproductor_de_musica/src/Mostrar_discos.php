<?php
    include_once("./Funciones.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style/index.css">
        <title>Discos</title>
    </head>
    <body>
        <nav class="menu">
            <h1>Discos</h1>

            <ul>
                <li><a href="Cerrar_sesion.php">Cerrar sesión</a></li>
                <li><a href="Aniadir_disco.php">Añadir disco</a></li>
                <li><a href="Index.php">Canciones</a></li>
                <li><a href="Listas_reproduccion.php">Listas de reproducción</a></li>
            </ul>
        </nav>

        <?php echo mostrarDiscos(); ?>        
    </body>
</html>