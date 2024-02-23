<?php
include_once("./clases/Cancion.php");
include_once("./clases/Usuario.php");

session_start();

if (isset($_GET['id'])) {
    $idCancion = urldecode($_GET['id']);
}

$listasReproduccion = Usuario::obtenerListasUsuario($_SESSION['usuario']['username']);
$arrayJSON = Cancion::decodificarCanciones();
$cancionActual = Cancion::obtenerCancionJSON($arrayJSON, $idCancion);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aniadir'])) {
    $nombreLista = $_POST['nombreListaSelect'];

    // Normalizar el nombre de la lista
    $nombreListaNormalizado = str_replace("+", " ", $nombreLista); // Reemplazar "+" por espacios
    Usuario::aniadirCancionALista($_SESSION['usuario']['username'], $nombreListaNormalizado, $cancionActual);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/Aniadir_a_lista.css">
    <title>Añadir a lista de reproducción</title>
</head>

<body>
    <a href="Index.php" class="enlace-volver">Cancelar y volver</a>

    <form action="" method='POST' enctype='multipart/form-data'>
        <label for='nombreListaSelect'>Selecciona una lista:</label>
        <?php Usuario::selectListasReproduccion($listasReproduccion); ?>

        <input type='submit' name='aniadir' value='Añadir canción a la lista de reproducción'>
    </form>
</body>

</html>