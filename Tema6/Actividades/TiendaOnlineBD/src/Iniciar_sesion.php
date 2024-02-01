<?php
    include_once("./Funciones.inc.php");
    include_once("./Clases/Usuario.php");

    //Se inicia la sesión
    session_start();

    //Si la sesión está iniciada y contiene el valor usuario redirige al index.
    if(isset($_SESSION['usuario']) && $_SESSION['usuario']){
        header("Location: Index.php");
        exit();
    }

    //Si se ha pulsado el botón iniciar sesión se obtiene el username y password.
    if(isset($_POST["iniciar"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST["username"];
        $password = $_POST["password"];

        //Se crea un objeto Usuario, el role no importa porque se obtiene de la base de datos, se le pasa una cadena vacía.
        $usuario = new Usuario($username, $password, "");
        
        //Se inicia la sesión obteniendo las credenciales de la base de datos.
        iniciarSesion($usuario);
    }

    //Si se ha pulsado el botón registrar también se obtiene el username y password.
    if(isset($_POST["registrar"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST["username"];
        $password = $_POST["password"];

        //En este caso se crea un objeto Usuario con el role Client.
        $usuario = new Usuario($username, $password, "Client");

        //Se registra el usuario en la base de datos.
        registrarUsuario($usuario);
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/IniciarSesion.css">
        <title>Iniciar Sesión</title>
    </head>
    <body>
        <h1>¡Bienvenido!</h1>

        <!-- Formulario de inicio de sesión -->
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <label>Nombre de usuario:</label>
            <input type="text" name="username" required>

            <br>

            <label>Contraseña:</label>
            <input type="password"name="password" required>

            <br>

            <input type="submit" name="iniciar" value="Iniciar sesión">
            <input type="submit" name="registrar" value="Registrar usuario">
        </form>
    </body>
</html>
