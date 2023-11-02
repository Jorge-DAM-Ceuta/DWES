<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 7</title>

        <style>
            body{
                background-color: aliceblue;
            }

            .input{
                border: 10px;
            }
        </style>
    </head>
    <body>
        
        <form name="input" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <p>
                <label>Nombre de usuario: </label>
                <input type="text" name="nombre" pattern=".+"/>
            </p> 

            <p>
                <label>E-mail: </label>
                <input type="email" name="email" pattern=".+"/>
            </p>
            
            <p>
                <label>Contraseña: </label>    
                <input type="password" name="password" pattern=".+"/>
            </p>

            <input type="submit" value="Enviar" name="enviar"/>
        </form>

        <?php
            $rutaJSON = "./usuarios.json";
            $jsonString = file_get_contents($rutaJSON);
            $arrayUsuarios = json_decode($jsonString, true);

            if(isset($_POST['enviar'])) {
                foreach($arrayUsuarios as $key => &$usuario) {

                    if($usuario['username'] == $_POST['nombre'] && $usuario['password'] == $_POST['password']){
                        echo "<p>Hola " . $_POST['nombre'] . "!!</p>";

                        echo "<p>Contraseña original: " . $usuario['password'];
                        $usuario['password'] = password_hash($usuario['password'], PASSWORD_ARGON2I);
                        
                        echo "<p>Tu contraseña ahora está cifrada de manera segura: " . $usuario['password'];
                    }else{
                        echo "<p>El usuario no existe o la contraseña no coincide.</p>";
                    }
                }

                $jsonString = json_encode($arrayUsuarios, JSON_PRETTY_PRINT);
                //file_put_contents($rutaJSON, $jsonString);
                $fichero = fopen($rutaJSON, 'w');
                fwrite($fichero, $jsonString);
                fclose($fichero);
            }
            
        ?>
    </body>
</html>

