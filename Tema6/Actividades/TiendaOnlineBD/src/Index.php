<?php
    include_once("./Funciones.inc.php");
    
    //Se inicia la sesión.
    session_start();

    //Si la sesión usuario no contiene nada se redirige a iniciar sesión.
    if (!isset($_SESSION['usuario']) || !$_SESSION['usuario']) {
        header("Location: Iniciar_sesion.php");
        exit();
    }

    //Si se ha seteado el valor role se obtiene para mostrar una vista u otra.
    $rolUsuario = isset($_SESSION['usuario']['role']) ? $_SESSION['usuario']['role'] : '';

    //Se obtienen los productos de la base de datos para mostrarlos mediante la estructura del template.
    $productos = obtenerProductos();

    //Se incluye el template para mostrar la vista.
    include_once("../templates/Index.inc.php");
?>