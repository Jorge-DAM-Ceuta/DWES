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

                $_SESSION['usuario'] = $elemento['nombre'];
                $_SESSION['correo'] = $elemento['correo'];

                header("Location: ./index.php");
                die();
            }
        } 
    }

    function cerrarSesion(){
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
            echo "<div class='hilo-card'>";
            echo "<p>Autor: " . $hilo['autor'] . "</p>
                <p><strong>" . $hilo['titulo'] . "</strong></p>
                <p>Mensajes:</p>
                <ul>";
            
            foreach($hilo['mensajes'] as $mensaje){
                echo "<li>" . $mensaje['usuario'] . " - " . $mensaje['contenido'] . "</li>";
            }
            
            if ($_SESSION['usuario'] == comprobarAutor($hilo['titulo'])) {
                echo "</ul>
                <a href='./hilo.php?titulo=" . $hilo['titulo'] . "'>Escribir mensaje</a> | <a href='./editar_hilo.php?titulo=" . $hilo['titulo'] . "'>Editar hilo</a>
                <hr>";
             }else{
                echo "</ul>
                <a href='./hilo.php?titulo=" . $hilo['titulo'] . "'>Escribir mensaje</a>
                <hr>";
             }
            
            echo "</div>";
        } 
    }

    function crearHilo($titulo, $autor){
        $rutaJSON = "./foro.json";
        $jsonString = file_get_contents($rutaJSON);
        $foro = json_decode($jsonString, true);

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
                    echo "<li>" . $mensaje['usuario'] . " - " . $mensaje['contenido'] . "</li>";             
                }
            }
        }
    }

    function mostrarAutorHilo($titulo){
        $rutaJSON = "./foro.json";
        $jsonString = file_get_contents($rutaJSON);
        $foro = json_decode($jsonString, true);
        
        foreach($foro as $hilo){
            if($hilo['titulo'] == $titulo){
                echo "<h3>Autor: " . $hilo['autor'] . "</h3>";             
            }
        }
    }

    //FALTA AÑADIR EL USUARIO AL MENSAJE.
    function escribirMensaje($titulo, $mensaje){
        $rutaJSON = "./foro.json";
        $jsonString = file_get_contents($rutaJSON);
        $foro = json_decode($jsonString, true);
        
        foreach($foro as $indice => $hilo){
            if($hilo['titulo'] == $titulo){
                //Añadir el mensaje y usuario

                $nuevoMensaje = array(
                    "contenido" => $mensaje,
                    "usuario" => $_SESSION['usuario']
                );

                array_push($foro[$indice]['mensajes'], $nuevoMensaje);
            
                
                //Guardar el json
                $jsonString = json_encode($foro, JSON_PRETTY_PRINT);
                file_put_contents($rutaJSON, $jsonString);
            }
        }
    }
    function comprobarAutor($titulo) {
        $rutaJSON = "./foro.json";
        $jsonString = file_get_contents($rutaJSON);
        $foro = json_decode($jsonString, true);
    
        foreach ($foro as $hilo) {
            if ($hilo['titulo'] == $titulo) {
                return $hilo['autor'] === $_SESSION['usuario'];
            }
        }
    
        return false; // Si no se encuentra el hilo o el usuario no coincide con el autor
    }

    function editarHilo($titulo, $nuevoTitulo) {
        try {
            $rutaJSON = "./foro.json";
            $jsonString = file_get_contents($rutaJSON);
    
            if ($jsonString === false) {
                throw new Exception("No se pudo leer el archivo JSON.");
            }
    
            $foro = json_decode($jsonString, true);
    
            if ($foro === null) {
                throw new Exception("No se pudo decodificar el archivo JSON.");
            }
    
            foreach ($foro as $indice => $hilo) {
                if ($hilo['titulo'] == $titulo) {
                    if ($_SESSION['usuario'] === $hilo['autor']) {
                        $foro[$indice]['titulo'] = $nuevoTitulo;
    
                        $jsonString = json_encode($foro, JSON_PRETTY_PRINT);
                        if ($jsonString === false) {
                            throw new Exception("Error al codificar el JSON.");
                        }
    
                        $result = file_put_contents($rutaJSON, $jsonString);
                        if ($result === false) {
                            throw new Exception("Error al escribir en el archivo JSON.");
                        }
    
                        header("Location: ./index.php?titulo=" . urlencode($nuevoTitulo));
                        exit();
                    } else {
                        echo "<p>No tienes permiso para editar este hilo.</p>";
                        return;
                    }
                }
            }
    
            echo "<p>Hilo no encontrado.</p>";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    

?>