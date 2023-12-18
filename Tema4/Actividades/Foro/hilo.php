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

    $titulo = $_GET['titulo'];
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
        
        <form action="" method="GET">
            <input type="hidden" name="titulo" value="<?php echo $titulo; ?>">
            <textarea name="mensaje" id="mensaje" cols="50" rows="3" placeholder="Escribe un nuevo mensaje" required></textarea>

            <br>

            <input type="submit" name="publicar" value="Publicar mensaje">
        </form>

        <?php
            echo "<h2>" . $_GET['titulo'] . ", " . $_GET['mensaje'] . "</h2>";
            
            if(isset($_GET['publicar'])){
                escribirMensaje($_GET['titulo'], $_GET['mensaje']);
                cargarHilo($_GET['titulo']);
            }
        ?>

        <br>
    </main>

    <hr>

    <footer>
        CIFP Nº1 - 2023 &copy; Todos los derechos reservados.
    </footer>
</body>
</html>