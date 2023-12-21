<?php
    include_once("./src/funciones.inc.php");

    if(isset($_GET['accion']) && $_GET['accion'] == 'salir'){
        cerrarSesion();
    }

    if(!isset($_SESSION['usuario'])){
        header("location: ./login.php");
        die();
    }

    //Si se recibe el título se almacena en la variable.
    if(isset($_GET['titulo'])){
        $titulo = $_GET['titulo'];
    }

    //Si se pulsa el botón del formulario se añade un nuevo mensaje y se recarga el hilo.
    if(isset($_POST['publicar'])){
        escribirMensaje($_POST['titulo'], $_POST['mensaje']);
    }

    //escribirMensaje($titulo, "ahehe");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/estilos.css">
    <title>Inicio | Foro</title>
</head>
<body>
    <!-- Menú de navegación -->
    <nav>
        <a href="index.php">Inicio</a> | 
        <a href="hilo.php?accion=salir">Cerrar sesión</a>
    </nav>
    
    <!-- Información del hilo actual -->
    <header>
        <?php echo "<h2>" . $titulo . "</h2>" ?>
        <?php mostrarAutorHilo($titulo); ?>
    </header>
    
    <hr>
    
    <!-- Mostrar mensajes -->
    <main>
        <h3>Mensajes:</h3>
        <?php cargarHilo($titulo); ?>
        
        <br>
        
        <form method="POST">
            <input type="hidden" name="titulo" value="<?php echo $titulo; ?>">
            <textarea name="mensaje" id="mensaje" cols="50" rows="3" placeholder="Escribe un nuevo mensaje" required></textarea>

            <br>

            <input type="submit" name="publicar" value="Publicar mensaje">
        </form>

        <br>
    </main>

    <hr>

    <footer>
        CIFP Nº1 - 2023 &copy; Todos los derechos reservados.
    </footer>
</body>
</html>