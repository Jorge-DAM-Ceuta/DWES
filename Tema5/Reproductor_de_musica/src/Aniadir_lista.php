<?php
    include_once("./Funciones.inc.php");

    session_start();

    if(isset($_POST["aniadir"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $nombreLista = $_POST["nombre"];
        
        aniadirListaReproduccion($_SESSION['usuario']['username'], $nombreLista);
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./style/aniadir_lista.css">
        <title>Añadir lista de reproducción</title>
        
    </head>
    <body>
        <a href="Listas_reproduccion.php" class="enlace-volver">Cancelar y volver</a>

        <form action="" method='POST' enctype='multipart/form-data'>
            <label>Nombre para lista de reproducción: <input type='text' name='nombre' required></label>
            
            <br/>
            
            <input type='submit' name='aniadir' value='Añadir lista de reproducción'>
        </form>
    </body>
</html>