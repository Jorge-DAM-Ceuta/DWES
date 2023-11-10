<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 15</title>
    </head>
    <body>

        <?php
            $notas = array("Jorge"=>"5, 8, 3, 6, 8", "Mohamed"=>"5, 8, 3, 6, 8");

            $rutaJSON = "./usuarios.json";
            $jsonString = file_get_contents($rutaJSON);
            $arrayUsuarios = json_decode($jsonString, true);

            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['enviar'])) {
                if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    foreach($arrayUsuarios as $key => &$usuario) {
                        if($usuario['username'] == validarDatos($_POST['nombre']) && $usuario['email'] == validarDatos($_POST['email']) && $usuario['password'] == validarDatos($_POST['password'])){
                            echo "<p>Hola " . $_POST['nombre'] . "!!</p>";

                            echo "<p>Contraseña original: " . $usuario['password'];
                            $usuario['password'] = password_hash($usuario['password'], PASSWORD_ARGON2I);
                            
                            echo "<p>Tu contraseña ahora está cifrada de manera segura: " . $usuario['password'];
                        }
                    }
                
                    $jsonString = json_encode($arrayUsuarios, JSON_PRETTY_PRINT);
                    //file_put_contents($rutaJSON, $jsonString);
                    $fichero = fopen($rutaJSON, 'w');
                    fwrite($fichero, $jsonString);
                    fclose($fichero);
                }
            }
        ?>

        <form name="calcularMedia" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            


            <input type="submit" name="calcular" value="Calcular">
        </form>

        <form name="addAlumn" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            
            <input type="submit" name="add" value="Add">
        </form>
    </body>
</html>