<?php
    include_once("./src/funciones.inc.php");
    session_start();

    if(isset($_GET['accion']) && $_GET['accion'] == 'salir'){
        cerrarSesion();
    }

    if(!isset($_SESSION['usuario'])){
        header("location: ./login.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/estilos.css">
    <title>Inicio | Foro</title>
</head>
<body>
    <nav>
        <a href="index.php">Inicio</a> | 
        <a href="hilo.php?accion=salir">Cerrar sesión</a>
    </nav>
    <header>
        <h2>Introducción al foro </h2>
        <p>Autor: fran</p>
    </header>
    <hr>
    <main>
        <h3>Mensajes:</h3>
        <?php cargarHilo($_GET['titulo']); ?>
        
        <form action="index.php">
            <textarea name="mensaje" id="mensaje" cols="50" rows="3" placeholder="Escribe un nuevo mensaje" required></textarea><br>
            <input type="submit" name="publicar" value="Publicar mensaje">
        </form><br>
    </main>
    <hr>
    <footer>
        CIFP Nº1 - 2023 &copy; Todos los derechos reservados.
    </footer>
</body>
</html>