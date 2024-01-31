<?php
    include_once("./Funciones.inc.php");
    session_start();

    if(isset($_SESSION['usuario']) && $_SESSION['usuario']){
        header("Location: Index.php");
        exit();
    }

    if(isset($_POST["iniciar"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        iniciarSesion($username, $password);
    }

    if(isset($_POST["registrar"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST["username"];
        $password = $_POST["password"];

        registrarUsuario($username, $password);
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Iniciar Sesión</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f0f0f0;
                text-align: center;
                margin: 0;
                padding: 50px;
            }

            h1 {
                color: #333;
            }

            form{
                max-width: 400px;
                margin: 0 auto;
                padding: 20px;
                background-color: #fff;
                border: 1px solid #ccc;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

                & label{
                    display: block;
                    margin-bottom: 10px;
                    color: #555;
                }

                & input[type="text"], input[type="password"]{
                    width: 100%;
                    padding: 10px;
                    margin-bottom: 15px;
                    box-sizing: border-box;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                }

                & input[type="submit"]{
                    background-color: #4caf50;
                    color: white;
                    border: 1px solid #4caf50;
                    border-radius: 4px;
                    padding: 10px 15px;
                    cursor: pointer;
                    font-size: 16px;
                }

                & input[type="submit"]:hover{
                    background-color: #45a049;
                }

                & input[name="registrar"]{
                    background-color: #2196f3;
                    border: 1px solid #2196f3;
                }

                & input[name="registrar"]:hover{
                    background-color: #0b7dda;
                }
            }

            

        </style>
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
