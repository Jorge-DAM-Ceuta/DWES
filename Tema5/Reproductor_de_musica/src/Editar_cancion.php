<?php
include_once("./clases/Cancion.php");


if (isset($_GET['id'])) {
    $idCancion = urldecode($_GET['id']);

    //Obtenemos un array de objetos tipo Canción.
    $arrayCanciones = Cancion::instanciarCanciones(Cancion::decodificarCanciones());

    //Obtenemos los valores de la canción actual para mostrar sus valores en el formulario.
    $cancionActual = Cancion::obtenerCancion($arrayCanciones, $idCancion);

    //Usamos una función para obtener las colaboraciones de la canción.
    $colaboracion = Cancion::obtenerColaboracion($cancionActual);
}

if (isset($_POST["editar"]) && $_SERVER["REQUEST_METHOD"] == "POST") {

    foreach ($arrayCanciones as &$cancion) {
        if ($idCancion == $cancion->getID()) {
            $nuevoTitulo = isset($_POST["titulo"]) ? $_POST["titulo"] : $cancion->getTitulo();
            $nuevoArtista = isset($_POST["artista"]) ? $_POST["artista"] : $cancion->getArtista();
            $nuevaDuracion = isset($_POST["duracion"]) ? $_POST["duracion"] : $cancion->getDuracion();

            $nuevaColaboracion = "";
            if (isset($_POST["colaboracion"])) {
                if (Cancion::obtenerNumeroColaboraciones($_POST["colaboracion"]) == "Varios") {
                    $nuevaColaboracion = explode(", ", $_POST["colaboracion"]);
                } else {
                    $nuevaColaboracion = array();
                    array_push($nuevaColaboracion, $_POST["colaboracion"]);
                }
            }

            $cancion->setTitulo($nuevoTitulo);
            $cancion->setArtista($nuevoArtista);
            $cancion->setColaboracion($nuevaColaboracion);
            $cancion->setDuracion($nuevaDuracion);

            if (isset($_POST["imagenDefecto"])) {
                $cancion->setRutaImagen("../assets/imagenes/imagen_defecto.jpg");
            } else if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
                $nombreArchivo = $_FILES['imagen']['name'];
                $rutaDestino = "../assets/imagenes/" . $nombreArchivo;

                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
                    $cancion->setRutaImagen($rutaDestino);
                }
            }

            Cancion::editarCancion($cancion);
        }
    }
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/editar_cancion.css">
    <title>Editar canción</title>
</head>

<body>
    <a href="Index.php" class="enlace-volver">Cancelar y volver</a>

    <h1>Editar canción</h1>

    <form action="" method='POST' enctype='multipart/form-data'>
        <label>Titulo:</label>
        <input type='text' name='titulo' value='<?php echo $cancionActual->getTitulo(); ?>'>

        <br />

        <label>Artista:</label>
        <input type='text' name='artista' value='<?php echo $cancionActual->getArtista(); ?>'>

        <br />

        <label>Colaboración: *Si hay varias sepáralas con ", "*</label>
        <input type='text' name='colaboracion' value='<?php echo $colaboracion; ?>'>

        <br />

        <label>Duración:</label>
        <input type='number' step='0.01' name='duracion' value='<?php echo $cancionActual->getDuracion(); ?>'>

        <br />

        <label>Imagen:</label>
        <input type='file' name='imagen'>

        <label>¿Restablecer la imagen por defecto?</label>
        <input type='checkbox' name='imagenDefecto'>

        <br />

        <input type='submit' name='editar' value='Editar información'>
    </form>
</body>

</html>