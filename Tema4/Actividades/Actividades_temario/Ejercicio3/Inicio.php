<?php
    session_start();
    echo "<h1>Hola " . $_SESSION['usuario'] . ", has iniciado sesión correctamente.</h2>";

    if(!isset($_SESSION['usuario'])){
        header("location: ./Index.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inicio</title>
    </head>
    <body>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="submit" name="cerrar" value="Cerrar sesión">
        </form>
    </body>
</html>

<?php
    if(isset($_POST['cerrar'])){
        session_unset();
        session_destroy();
        
        header('Location: ./Index.php');
        die();
    }
?>