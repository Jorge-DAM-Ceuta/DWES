<?php
    include_once("./src/funciones.inc.php");
    
    session_start();

    //COMPROBAR SI SE HA PULSADO CERRAR SESIÓN
    if(isset($_GET['accion']) && $_GET['accion'] == 'salir'){
        cerrarSesion();
    }

    //REDIRIGIR SESIÓN
    if(!isset($_SESSION['usuario'])){
        header("location: ./login.php");
        die();
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crear'])){
        crearHilo($_POST['hilo'], $_SESSION['usuario']);
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/index.css">
    <title>Inicio | Foro</title>
</head>
<body>
    <nav>
        <a href="#">Inicio</a>|&nbsp;
        <a href="index.php?accion=salir">Cerrar sesión</a>
    </nav>

    <header>
        <h1>¿Listo para discutir en un hilo?</h1>
        <h3>A continuación se muestran los diferentes hilos activos en el foro:</h3>
    </header>

    <hr>

    <main>
        <section>
            <h3>Crea un nuevo hilo</h3>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='POST'>
                <input type="text" name="hilo" id="hilo" placeholder="Dale un título al nuevo hilo" required>
                <input type="submit" name="crear" value="Crear hilo">
            </form>
        </section>

        <fieldset>
            <h3>Hilos disponibles</h3>
            <?php mostrarHilos(); ?>
        <fieldset>
    </main>

    <hr>

    <footer>
        CIFP Nº1 - 2023 &copy; Todos los derechos reservados.
    </footer>
</body>
</html>