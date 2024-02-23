<?php
    session_start();
    session_destroy();

    header("Location: Iniciar_sesion.php");
    exit();