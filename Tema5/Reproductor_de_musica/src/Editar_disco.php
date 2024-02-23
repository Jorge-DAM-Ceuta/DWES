<?php
include_once("./clases/Disco.php");

if (isset($_GET['id'])) {
    $idDisco = urldecode($_GET['id']);

    //Obtenemos un array de objetos tipo Canción.
    $arrayDiscos = Disco::instanciarDiscos(Disco::decodificarDiscos());

    //Obtenemos los valores de la canción actual para mostrar sus valores en el formulario.
    $discoActual = Disco::mostrarDisco_ID($arrayDiscos, $idDisco);

    //Obtenemos las canciones del disco.
    $canciones = implode(", ", $discoActual->getCanciones());
}

if (isset($_POST["editar"]) && $_SERVER["REQUEST_METHOD"] == "POST") {

    foreach ($arrayDiscos as &$disco) {
        if ($idDisco == $disco->getID()) {
            $nuevoTitulo = isset($_POST["titulo"]) ? $_POST["titulo"] : $disco->getTitulo();
            $nuevoArtista = isset($_POST["artista"]) ? $_POST["artista"] : $disco->getArtista();
            $nuevoAnio = isset($_POST["anio"]) ? $_POST["anio"] : $disco->getAnio();
            $nuevasCanciones = isset($_POST["canciones"]) ? explode(", ", $_POST["canciones"]) : $disco->getCanciones();

            $disco->setTitulo($nuevoTitulo);
            $disco->setArtista($nuevoArtista);
            $disco->setAnio($nuevoAnio);
            $disco->setCanciones($nuevasCanciones);

            if (isset($_POST["imagenDefecto"])) {
                $disco->setRutaImagen("../assets/imagenes/imagen_defecto.jpg");
            } else if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
                $nombreArchivo = $_FILES['imagen']['name'];
                $rutaDestino = "../assets/imagenes/" . $nombreArchivo;

                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
                    $disco->setRutaImagen($rutaDestino);
                }
            }

            Disco::editarDisco($disco);
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
    <title>Editar disco</title>
</head>

<body>
    <a href="Mostrar_discos.php" class="enlace-volver">Cancelar y volver</a>

    <h1>Editar disco</h1>

    <form action="" method='POST' enctype='multipart/form-data'>
        <label>Titulo:</label>
        <input type='text' name='titulo' value='<?php echo $discoActual->getTitulo(); ?>'>

        <br />

        <label>Artista:</label>
        <input type='text' name='artista' value='<?php echo $discoActual->getArtista(); ?>'>

        <br />

        <label>Año:</label>
        <input type='number' name='anio' value='<?php echo $discoActual->getAnio(); ?>'>

        <br />

        <label>Canciones: *Sepáralas con ", "*</label>
        <input type='text' name='canciones' value='<?php echo $canciones; ?>'>

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