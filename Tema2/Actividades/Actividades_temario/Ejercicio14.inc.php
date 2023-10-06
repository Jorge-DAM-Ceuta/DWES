<?php

function escribirFecha(){
    date_default_timezone_set("Europe/Madrid");
    setlocale(LC_TIME, "es_ES.UTF-8");
    
    return $fechaActual = strftime("%A, %d de %B de %Y");
}

?>