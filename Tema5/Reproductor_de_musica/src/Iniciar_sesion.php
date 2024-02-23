<?php
include_once("./clases/Usuario.php");

session_start();

if (isset($_SESSION['usuario']) && $_SESSION['usuario']) {
    header("Location: Index.php");
    exit();
}

if (isset($_POST["iniciar"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    Usuario::iniciarSesion($username, $password);
}

if (isset($_POST["registrar"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    Usuario::registrarUsuario($username, $email, $password);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/iniciar_sesion.css">
    <title>Iniciar Sesión</title>
</head>

<body>
    <h1>¡Bienvenido!</h1>

    <div class="forms-container">
        <!-- Formulario de iniciao de sesión -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="iniciar-form">
            <label>Nombre de usuario / E-mail:</label>
            <input type="text" name="username" required>

            <br>

            <label>Contraseña:</label>
            <input type="password" name="password" required>

            <br>

            <input type="submit" name="iniciar" value="Iniciar sesión">
        </form>

        <!-- Formulario de registro -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="registrar-form">
            <label>Nombre de usuario:</label>
            <input type="text" name="username" required>

            <br>

            <label>E-mail:</label>
            <input type="email" name="email" required>

            <br>

            <label>Contraseña:</label>
            <input type="password" name="password" required>

            <br>

            <input type="submit" name="registrar" value="Registrar usuario">
        </form>
    </div>
</body>

</html>