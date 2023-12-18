<?php

//VALIDACIÓN DE DATOS
    function validarDatos(&$variable){
        trim($variable);
        stripslashes($variable);
        htmlspecialchars($variable);
        
        return $variable;
    }

    function cifrarPassword(&$password){
        return password_hash($password, PASSWORD_ARGON2I);
    }

//SESIONES
    function registro($username, $email, $password){
        $comprobacion = false;
        $usuarioExistente = false;

        $rutaJSON = "./usuarios.json";
        $jsonString = file_get_contents($rutaJSON);
        $usuarios = json_decode($jsonString, true);
        
        $username = validarDatos($username);
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $comprobacion = true;
        }
        $password = cifrarPassword($_POST['password']);

        //Comprobar que no exista el usuario.
        foreach($usuarios as $elemento){
            if($username == $elemento['nombre']){
                $usuarioExistente = true;
            }
        }

        if($comprobacion == true && $usuarioExistente == false){
            session_start();

            array_push($usuarios, array("nombre" => $username, "correo" => $email, "password" => $password));

            $jsonString = json_encode($usuarios, JSON_PRETTY_PRINT);
            file_put_contents($rutaJSON, $jsonString);  

            echo "<h2>Te has registrado correctamente</h2>";

            header("Location: ./index.php");
            die();
        }
    }

    function login($username, $password){
        $rutaJSON = "./usuarios.json";
        $jsonString = file_get_contents($rutaJSON);
        $usuarios = json_decode($jsonString, true);

        $username = validarDatos($username);

        foreach($usuarios as $elemento){
            if($elemento['nombre'] == $username && password_verify($password, $elemento['password']) == true){
                session_start();

                $_SESSION['usuario'] = $elemento['nombre'];
                $_SESSION['correo'] = $elemento['correo'];

                header("Location: ./index.php");
                die();
            }
        } 
    }

    function cerrarSesion(){
        session_start();
        session_unset();
        session_destroy();
        
        header('Location: ./login.php');
        die();
    }

//FORO
    function mostrarHilos(){
        $rutaJSON = "./foro.json";
        $jsonString = file_get_contents($rutaJSON);
        $foro = json_decode($jsonString, true);

        echo "<hr>";

        foreach($foro as $hilo){
            echo "<p>Autor: " . $hilo['autor'] . "</p>
                <p>Título: <strong>" . $hilo['titulo'] . "</strong></p>
                <p>Mensajes:</p>
                <ul>";
            
            foreach($hilo['mensajes'] as $mensaje){
                echo "<li>Usuario: " . $mensaje['usuario'] . " - " . $mensaje['contenido'] . "</li>";
            }

            echo "</ul>
            <a href='./hilo.php?titulo=" . $hilo['titulo'] . "'>Escribir mensaje</a> | <a href='#'>Editar hilo</a>
            <hr>";
        } 
    }

    function crearHilo($titulo, $autor){
        $rutaJSON = "./foro.json";
        $jsonString = file_get_contents($rutaJSON);
        $foro = json_decode($jsonString, true);
        
        session_start();

        $mensajes = array();

        array_push($foro, array("titulo" => $titulo, "autor" => $autor, "mensajes" => $mensajes));

        $jsonString = json_encode($foro, JSON_PRETTY_PRINT);
        file_put_contents($rutaJSON, $jsonString);  

        header("Location: ./index.php");
        die();
    }

    function cargarHilo($titulo){
        $rutaJSON = "./foro.json";
        $jsonString = file_get_contents($rutaJSON);
        $foro = json_decode($jsonString, true);
        
        foreach($foro as $hilo){
            if($hilo['titulo'] == $titulo){
                foreach($hilo['mensajes'] as $mensaje){
                    echo "<li>Usuario: " . $mensaje['usuario'] . " - " . $mensaje['contenido'] . "</li>";             
                }
            }
        }
    }

?>