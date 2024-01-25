<?php
    include_once("./Funciones.inc.php");

    if(isset($_GET['id'])) {
        $idCancion = urldecode($_GET['id']);

        //Obtenemos un array de objetos tipo Canción,
        $arrayCanciones = instanciarCanciones(decodificarCanciones());

        //Obtenemos los valores de la canción actual para mostrar sus valores en el formulario.
        $cancionActual = obtenerCancion($arrayCanciones, $idCancion);

        //Usamos una función para obtener las colaboraciones de la canción.
        $colaboracion = obtenerColaboracion($cancionActual);
    }
    
    if (isset($_POST["editar"]) && $_SERVER["REQUEST_METHOD"] == "POST") {

        foreach ($arrayCanciones as &$cancion) {
            if ($idCancion == $cancion->getID()) {
                $nuevoTitulo = isset($_POST["titulo"]) ? $_POST["titulo"] : $cancion->getTitulo();
                $nuevoArtista = isset($_POST["artista"]) ? $_POST["artista"] : $cancion->getArtista();

                $nuevaColaboracion = ""; 
                if(isset($_POST["colaboracion"])){
                    if(obtenerNumeroColaboraciones($_POST["colaboracion"]) == "Varios"){
                        $nuevaColaboracion = explode(", ", $_POST["colaboracion"]); 
                    }else{
                        $nuevaColaboracion = array();
                        array_push($nuevaColaboracion, $_POST["colaboracion"]);
                    }
                } 
                
                $nuevaDuracion = isset($_POST["duracion"]) ? $_POST["duracion"] : $cancion->getDuracion();
                $nuevaRutaImagen = isset($_POST["rutaImagen"]) ? $_POST["rutaImagen"] : $cancion->getRutaImagen();

                $cancion->setTitulo($nuevoTitulo);
                $cancion->setArtista($nuevoArtista);
                $cancion->setColaboracion($nuevaColaboracion);
                $cancion->setDuracion($nuevaDuracion);

                if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
                    $nombreArchivo = $_FILES['imagen']['name'];
                    $rutaDestino = "../assets/imagenes/" . $nombreArchivo;
    
                    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
                        $cancion->setRutaImagen($rutaDestino);
                    }
                }

                editarCancion($cancion);
            }
        }

    }
        
    
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style/mostrar_cancion.css">
        <title>Editar producto</title>
    </head>
    <body>
        <a href="Index.php" class="enlace-volver">Cancelar y volver</a>

        <form action="" method='POST' enctype='multipart/form-data'>
            <label>Titulo: <input type='text' name='titulo' value='<?php echo $cancionActual->getTitulo(); ?>' required></label>
            <br/>
            <label>Artista: <input type='text' name='artista' value='<?php echo $cancionActual->getArtista(); ?>'></label>
            <br/>
            <label>Colaboración: <input type='text' name='colaboracion' value='<?php echo $colaboracion; ?>'></label>
            <br/>
            <label>Duración: <input type='number' step='0.01' name='duracion' value='<?php echo $cancionActual->getDuracion(); ?>'></label>
            <br/>
            <input type='file' name='imagen'>
            <br/>
            <input type='submit' name='editar' value='Editar información'>
        </form>
    </body>
</html>
