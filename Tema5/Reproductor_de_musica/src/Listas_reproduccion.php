<?php
include_once("./clases/Usuario.php");

session_start();

if (!isset($_SESSION['usuario']) || !$_SESSION['usuario']) {
    header("Location: Iniciar_sesion.php");
    exit();
}

$listasReproduccion = Usuario::obtenerListasUsuario($_SESSION['usuario']['username']);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/listas_reproduccion.css">
    <title>Listas de reproducción</title>
</head>

<body>
    <nav class="menu">
        <h1>Listas de reproducción</h1>

        <ul>
            <li><a href="Cerrar_sesion.php">Cerrar sesión</a></li>
            <li><a href="Aniadir_lista.php">Añadir lista de reproducción</a></li>
            <li><a href="Index.php">Canciones</a></li>
            <li><a href="Listas_reproduccion.php">Listas de reproducción</a></li>
            <li><a href="Mostrar_discos.php">Discos</a></li>
        </ul>
    </nav>

    <?php echo Usuario::mostrarListasReproduccion($listasReproduccion); ?>
</body>

</html>