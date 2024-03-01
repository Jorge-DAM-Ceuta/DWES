<?php 
    $router = new \Bramus\Router\Router();
    session_start();

    //Obtenemos el archivo de las variables de entorno y las cargamos.
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../config/");
    $dotenv->load();

    $router->get("/", function(){
        echo "Pantalla de inicio:";
        echo $_ENV["DB"];
    });

    $router->run();
?>