<?php

function escribirFecha(){
    date_default_timezone_set("Europe/Madrid");
    setlocale(LC_TIME, "es_ES.UTF-8");

    $fechaActual = getdate();

    $nombreDia = $fechaActual["weekday"];

    switch($nombreDia){
        case "Monday": 
            $nombreDia = "Lunes";
            break;
        case "Tuesday": 
            $nombreDia = "Martes";
            break;
        case "Wednesday": 
            $nombreDia = "Miércoles";
            break;
        case "Thursday": 
            $nombreDia = "Jueves";
            break;
        case "Friday": 
            $nombreDia = "Viernes";
            break;
        case "Saturday": 
            $nombreDia = "Sábado";
            break;
        case "Sunday": 
            $nombreDia = "Domingo";
            break;
                                
    }

    $numeroDia = $fechaActual["mday"];

    $mes = $fechaActual["month"];

    switch($mes){
        case "January": 
            $mes = "Enero";
            break;
        case "February": 
            $mes = "Febrero";
            break;
        case "March": 
            $mes = "Marzo";
            break;
        case "April": 
            $mes = "Abril";
            break;
        case "May": 
            $mes = "Mayo";
            break;
        case "June": 
            $mes = "Junio";
            break;
        case "July": 
            $mes = "Julio";
            break;
        case "August": 
            $mes = "Agosto";
            break;
        case "September": 
            $mes = "Septiembre";
            break;
        case "October": 
            $mes = "Octubre";
            break;
        case "November": 
            $mes = "Noviembre";
            break;
        case "December": 
            $mes = "Diciembre";
            break;
                                
    }

    $anio = $fechaActual["year"];

    $fechaActual = $nombreDia . ", " . $numeroDia . " de " . $mes . " de " . $anio;

    return $fechaActual;
}

?>