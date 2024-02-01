<?php
    //Se inicia y destruye la sesión.
    session_start();
    session_destroy();

    //Se redirige al inicio de sesión.
    header("Location: Iniciar_sesion.php");
    exit();
?>
