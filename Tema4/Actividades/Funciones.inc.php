<?php
    function validarDatos(&$variable){
        trim($variable);
        stripslashes($variable);
        htmlspecialchars($variable);
        
        return $variable;
    }

    function cifrarPassword(&$password){
        return password_hash($password, PASSWORD_ARGON2I);
    }

?>