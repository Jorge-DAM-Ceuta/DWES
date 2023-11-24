<?php
    session_start();
    
    echo "<h1>" . $_SESSION['usuario'] . ", " . $_SESSION['password'] . "</h2>";

    session_unset();
    session_destroy();
    die();
?>