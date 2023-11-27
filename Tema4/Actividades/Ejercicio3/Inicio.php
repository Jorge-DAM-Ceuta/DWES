<?php
    session_start();
    
    echo "<h1>Hola " . $_SESSION['usuario'] . ", has iniciado sesión correctamente.</h2>";

    session_unset();
    session_destroy();
    die();
?>