<?php
    include_once("./Funciones.inc.php");

    session_start();

    if(isset($_GET["nombreLista"])){
        $nombreActual = $_GET["nombreLista"];
    }

    if(isset($_POST["aniadir"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $nuevoNombre = $_POST["nombre"];
        
        editarListaReproduccion($_SESSION['usuario']['username'], $nombreActual, $nuevoNombre);
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style/aniadir_lista.css">
        <title>Editar lista de reproducción</title>
    </head>

    <body>
        <a href="Listas_reproduccion.php" class="enlace-volver">Cancelar y volver</a>

        <h1>Editar lista</h1>
        
        <form action="" method='POST' enctype='multipart/form-data'>
            <label>Nuevo nombre para lista de reproducción: <input type='text' name='nombre' required></label>
            
            <br/>
            
            <input type='submit' name='aniadir' value='Cambiar nombre a la lista de reproducción'>
        </form>
    </body>
</html>