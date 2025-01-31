<?php
include_once("./clases/Cancion.php");


//Obtenemos el array de canciones del JSON.
$arrayJSON = Cancion::decodificarCanciones();
$nuevoID = Cancion::obtenerUltimoID($arrayJSON) + 1;

//Obtenemos un array de objetos tipo Canción.
$arrayCanciones = Cancion::instanciarCanciones(Cancion::decodificarCanciones());

if (isset($_POST["aniadir"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $nuevoTitulo = $_POST["titulo"];
    $nuevoArtista = $_POST["artista"];
    $nuevaDuracion = $_POST["duracion"];

    $nuevaColaboracion = "";
    if (isset($_POST["colaboracion"])) {
        if (Cancion::obtenerNumeroColaboraciones($_POST["colaboracion"]) == "Varios") {
            $nuevaColaboracion = explode(", ", $_POST["colaboracion"]);
        } else {
            $nuevaColaboracion = array();
            array_push($nuevaColaboracion, $_POST["colaboracion"]);
        }
    }

    $nuevaCancion = new Cancion($nuevoID, $nuevoTitulo, $nuevoArtista, $nuevaColaboracion, $nuevaDuracion, false);

    if (isset($_FILES['audio']) && $_FILES['audio']['error'] == UPLOAD_ERR_OK) {
        $nombreArchivo = $_FILES['audio']['name'];
        $rutaDestino = "../assets/canciones/" . $nombreArchivo;

        if (move_uploaded_file($_FILES['audio']['tmp_name'], $rutaDestino)) {
            $nuevaCancion->setRutaAudio($rutaDestino);
        }
    }

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
        $nombreArchivo = $_FILES['imagen']['name'];
        $rutaDestino = "../assets/imagenes/" . $nombreArchivo;

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
            $nuevaCancion->setRutaImagen($rutaDestino);
        }
    }

    Cancion::aniadir_cancion($arrayJSON, $nuevaCancion);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/aniadir_cancion.css">
    <title>Añadir canción</title>

</head>

<body>
    <a href="Index.php" class="enlace-volver">Cancelar y volver</a>

    <h1>Añadir canción</h1>

    <form action="" method='POST' enctype='multipart/form-data'>
        <label>Titulo: <input type='text' name='titulo' required></label>
        <br />
        <label>Artista: <input type='text' name='artista' required></label>
        <br />
        <label>Colaboración: *Si hay varias sepáralas con ", "*<input type='text' name='colaboracion'></label>
        <br />
        <label>Duración: <input type='number' step='0.01' name='duracion' required></label>
        <br />
        <label>Imagen: <input type='file' name='imagen'></label>
        <br />
        <label>Audio: <input type='file' name='audio' accept=".mp3" required></label>
        <br />
        <input type='submit' name='aniadir' value='Añadir canción'>
    </form>
</body>

</html>