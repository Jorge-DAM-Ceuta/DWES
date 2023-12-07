<?php
    include_once("../Funciones.inc.php");
    session_start();

    if(isset($_SESSION['usuario'])){
        header("location: ./Inicio.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign up / Sign in</title>
    </head>
    <body>
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registrar'])){
                $rutaJSON = "./Usuarios.json";
                $jsonString = file_get_contents($rutaJSON);
                $usuarios = json_decode($jsonString, true);
                
                $usuario = validarDatos($_POST['usuario']);
                $password = cifrarPassword($_POST['password']);

                if(empty( $usuario )!= "" && $password != ""){
                    array_push($usuarios, array("nombre" => $usuario, "password" => $password));

                    $jsonString = json_encode($usuarios, JSON_PRETTY_PRINT);
                    file_put_contents($rutaJSON, $jsonString);  

                    echo "<h2>Te has registrado correctamente</h2>";
                }
            }

            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['iniciar'])){
                $rutaJSON = "./Usuarios.json";
                $jsonString = file_get_contents($rutaJSON);
                $usuarios = json_decode($jsonString, true);

                $usuario = validarDatos($_POST['usuario']);

                foreach($usuarios as $elemento){
                    if($elemento['nombre'] == $usuario && password_verify($_POST['password'], $elemento['password']) == true){
                        session_start();

                        $_SESSION['usuario'] = $elemento['nombre'];
                        $_SESSION['password'] = $elemento['password'];

                        header("location: ./Inicio.php");
                        die();
                    }
                } 
            }
        ?>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <p>
                <label>Usuario: </label>
                <input type="text" name="usuario" id="usuario">
            </p>
            
            <p>
                <label>Contraseña: </label>
                <input type="text" name="password" id="password" minlength="8">
            </p>

            <input type="submit" name="registrar" value="Registrar">
            <input type="submit" name="iniciar" value="Inicio">
        </form>
    </body>
</html>