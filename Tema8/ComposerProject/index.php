<?php 
    error_reporting(E_ALL);

    ini_set("ignore_repeats_errors", TRUE);
    ini_set("display_errors", FALSE);
    ini_set("log_errors", TRUE);

    ini_set("error_log", "php-error.log");
    error_log("> App iniciada");

    require("vendor/autoload.php");
    require("src/lib/routes.php");
?>