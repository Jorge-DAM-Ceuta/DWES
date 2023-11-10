<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 4</title>

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
        
        <?php
            include_once("./Ejercicio11.inc.php");

            /* Se recogen los datos y se almacenan en un array, luego saluda al usuario por pantalla. */
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['enviar'])) {
                $nombre = validarDatos($_POST['nombre']);
                
                if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $email = validarDatos($_POST['email']);
                
                    $password = validarDatos($_POST['password']);

                    $usuario = array("Nombre" => $nombre, "Email" => $email, "Password" => $password);
                    
                    print("Bienvenido " . $usuario["Nombre"] . "!!");
                }
            }else { 
            
        ?>
            <!-- Se comprueba con un pattern que los campos no estén vacíos -->
                <form name="input" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    <p>
                        <label>Nombre de usuario: </label>
                        <input type="text" name="nombre" pattern=".+" required/>
                        <?php 
                            if(isset($_POST['enviar']) && empty($_POST['nombre'])){
                                echo "<span style='color:red'>--&lt; Debe introducir un nombre!!</span>";
                            }
                        ?>
                    </p> 

                    <p>
                        <label>E-mail: </label>
                        <input type="email" name="email" pattern=".+" required/>
                        <?php 
                            if(isset($_POST['enviar']) && empty($_POST['email'])){
                                echo "<span style='color:red'>--&lt; Debe introducir un email!!</span>";
                            }
                        ?>
                    </p>
                    
                    <p>
                        <label>Contraseña: </label>    
                        <input type="password" name="password" pattern=".+" required/>
                        <?php 
                            if(isset($_POST['enviar']) && empty($_POST['password'])){
                                echo "<span style='color:red'>--&lt; Debe introducir una contraseña!!</span>";
                            }
                        ?>
                    </p>

                    <input type="submit" value="Enviar" name="enviar"/>
                </form>
    
            <?php
            } ?>
    </body>
</html>

