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

    //Si se recibe el título se almacena en la variable.
    if(isset($_GET['titulo'])){
        $titulo = $_GET['titulo'];
    }

    //Si se pulsa el botón del formulario se añade un nuevo mensaje y se recarga el hilo.
    if(isset($_POST['actualizar'])){
        editarHilo($_POST['titulo'], $_POST['tituloNuevo']);
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/editar_hilo.css">
    <title>Inicio | Foro</title>
</head>
<body>
    <!-- Menú de navegación -->
    <nav>
        <a href="index.php">Inicio</a> | &nbsp;
        <a href="hilo.php?accion=salir">Cerrar sesión</a>
    </nav>

    
    <hr>
    
    <main>
        <section>
            <form method="POST">
                <input type="hidden" name="titulo" value="<?php echo $titulo; ?>">
                <label for="tituloNuevo">Titulo</label>
                <input type="text" name="tituloNuevo" value="<?php echo $titulo; ?>">
                
                <br>

                <input type="submit" name="actualizar" value="Actualizar Hilo">
            </form>

            <br>
        </section>
    </main>

    <hr>

    <footer>
        CIFP Nº1 - 2023 &copy; Todos los derechos reservados.
    </footer>
</body>
</html>