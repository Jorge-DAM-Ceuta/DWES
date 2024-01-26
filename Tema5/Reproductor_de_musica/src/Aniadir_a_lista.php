<?php
    include_once("./Funciones.inc.php");

    session_start();

    if(isset($_GET['id'])) {
        $idCancion = urldecode($_GET['id']);
    }

    $listasReproduccion = obtenerListasUsurio($_SESSION['usuario']['username']);
    $arrayJSON = decodificarCanciones();
    $cancionActual = obtenerCancionJSON($arrayJSON, $idCancion);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['aniadir'])) {

        $nombreLista = $_POST['nombreListaSelect'];
        aniadirCancionALista($_SESSION['usuario']['username'], $nombreLista, $cancionActual);
        
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
            <?php selectListasReproduccion($listasReproduccion); ?>
            
            <input type='submit' name='aniadir' value='Añadir canción a la lista de reproducción'>
        </form>
    </body>
</html>