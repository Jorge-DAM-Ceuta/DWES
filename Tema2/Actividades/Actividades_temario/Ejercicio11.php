<?php

date_default_timezone_set("Europe/Madrid");
setlocale(LC_TIME, "es_ES.UTF-8");

$fechaActual = strftime("%A, %d de %B de %Y");

echo $fechaActual;

//Se muestra la fecha actual en ingles. ??
?>