<?php

date_default_timezone_set("Europe/Madrid");
setlocale(LC_TIME, "es_ES", "es_ES.UTF-8");

$fechaActual = getdate();

$nombreDia = $fechaActual["weekday"];
$numeroDia = $fechaActual["mday"];
$mes = $fechaActual["month"];
$anio = $fechaActual["year"];

echo `${nombreDia}, ${numeroDia} ${mes} ${anio} `;

$fecha = date("l,  F  Y");
echo $fecha;
?>