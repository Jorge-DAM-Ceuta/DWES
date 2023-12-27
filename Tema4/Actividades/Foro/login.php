<?php
    include_once("./src/funciones.inc.php");

    session_start();
    if(isset($_SESSION['usuario'])){
        header("Location: ./index.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./assets/css/login.css">
        <title>Foro | Login</title>
    </head>
    <body>
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registrar'])){
                $username = $_POST['nombre'];
                $password = $_POST['password'];
                $password2 = $_POST['confirmar'];
                $email = $_POST['correo'];

                if($password === $password2){
                    registro($username, $email, $password);
                }   
            }

            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['iniciar'])){
                login($_POST['nombre'], $_POST['password']);
            }
        ?>

        <header>
            <h1>¡Bienvenido al Foro!</h1>
            <h2>Accede a tu cuenta o crea una nueva.</h2>
        </header>

        <hr>

        <main>
            <section class="login-form">
                <h3>Inicia sesión:</h3>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <label for="nombre">Nombre de usuario:</label>
                    <input type="nombre" name="nombre" id="nombre" placeholder="Introduce tu nombre" required><br>
                    <label for="contrasenia">Contraseña:</label>
                    <input type="password" name="password" id="contrasenia" placeholder="Introduce tu contraseña" required><br><br>
                    <input type="submit" name="iniciar" value="Iniciar sesión">
                </form>
            </section>

            <hr>

            <section class="register-form">
                <h3>Registrate ahora:</h3>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <label for="nombreUsuario">Nombre de usuario:</label>
                    <input type="nombre" name="nombre" id="nombreUsuario" placeholder="Introduce tu nombre" required><br>
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" id="password" placeholder="Introduce tu contraseña" required><br>
                    <label for="confirmar">Confirma contraseña:</label>
                    <input type="password" name="confirmar" id="confirmar" placeholder="Confirma la contraseña" required><br>
                    <label for="correo">Correo:</label>
                    <input type="text" name="correo" id="correo" placeholder="Introduce tu correo" required><br><br>
                    <input type="submit" name="registrar" value="Crear cuenta">
                </form>
            </section>

        </main>

        <hr>
        
        <footer>
            CIFP Nº1 - 2023 &copy; Todos los derechos reservados.
        </footer>
    </body>
</html>