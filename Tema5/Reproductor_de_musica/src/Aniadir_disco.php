<?php
    include_once("./Funciones.inc.php");

    //Obtenemos el array de discos del JSON.
    $arrayJSON = decodificarDiscos();
    $nuevoID = obtenerUltimoID_Disco($arrayJSON)+1;

    //Obtenemos un array de objetos tipo Canción.
    $arrayDiscos = instanciarDiscos(decodificarDiscos());

    if(isset($_POST["aniadir"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $nuevoTitulo = $_POST["titulo"];
        $nuevoArtista = $_POST["artista"];
        $nuevoAnio = $_POST["anio"];

        $nuevasCanciones = ""; 
        if(isset($_POST["canciones"])){
            $nuevasCanciones = explode(", ", $_POST["canciones"]); 
        } 

        $nuevoDisco = new Disco($nuevoID, $nuevoTitulo, $nuevoArtista, $nuevoAnio, $nuevasCanciones, "");

        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
            $nombreArchivo = $_FILES['imagen']['name'];
            $rutaDestino = "../assets/imagenes/" . $nombreArchivo;

            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
                $nuevoDisco->setRutaImagen($rutaDestino);
            }
        }

        aniadirDisco($arrayJSON, $nuevoDisco);
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style/aniadir_cancion.css">
        <title>Añadir disco</title>
        
    </head>
    <body>
        <a href="Mostrar_discos.php" class="enlace-volver">Cancelar y volver</a>

        <h1>Añadir disco</h1>
        
        <form action="" method='POST' enctype='multipart/form-data'>
            <label>Titulo: <input type='text' name='titulo' required></label>
            <br/>
            <label>Artista: <input type='text' name='artista'></label>
            <br/>
            <label>Año: <input type='number' name='anio'></label>
            <br/>
            <label>Canciones: *Sepáralas con ", "* <input type='text' name='canciones'></label>
            <br/>
            <label>Imagen: <input type='file' name='imagen'></label>
            <br/>
            <input type='submit' name='aniadir' value='Añadir canción'>
        </form>
    </body>
</html>