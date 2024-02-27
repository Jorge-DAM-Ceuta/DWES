<?php
    include_once("./Clases/Usuario.php");

    session_start();

    if (isset($_SESSION['usuario']) && $_SESSION['usuario']) {
        header("Location: Index.php");
        exit();
    }

    if (isset($_POST["iniciar"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $usuario = new Usuario($username, $password, "");

        Usuario::iniciarSesion($usuario);
    }


    if (isset($_POST["registrar"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $usuario = new Usuario($username, $password, "Client");

        Usuario::registrarUsuario($usuario);
    }

    include_once("Templates/AperturaIniciarSesion.inc.php");
?>

    <h1>¡Bienvenido!</h1>

    <!-- Formulario de inicio de sesión -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label>Nombre de usuario:</label>
        <input type="text" name="username" required>

        <br>

        <label>Contraseña:</label>
        <input type="password" name="password" required>

        <br>

        <input type="submit" name="iniciar" value="Iniciar sesión">
        <input type="submit" name="registrar" value="Registrar usuario">
    </form>

<?php
    include_once("Templates/Cierre.inc.php");
?>