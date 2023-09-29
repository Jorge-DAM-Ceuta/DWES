<?php

$asignaturaDWES = "Desarrollo de Web en Entorno Servidor (DWES)";
$asignaturaDWEC = "Desarrollo de Web en Entorno Cliente (DWEC)";
$asignaturaDAW = "Despliegue de Aplicaciones Web (DAW)";
$asignaturaDIW = "Diseño de Interfaces Web (DIW)"; 
$asignaturaEIEM = "Empresa e Iniciativa Emprendedora (EIEM)";

$primeraHora = "08:25 - 9:20";
$segundaHora = "9:20 - 10:15";
$terceraHora = "10:15 - 11:10";
$horaRecreo = "11:10 - 11:30"; 
$cuartaHora = "11:30 - 12:25";
$quintaHora = "12:25 - 13:20";
$sextaHora = "13:20 - 14:15";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Horario de clase</title>
</head>
<body>
    <table border=3>
        <tr>
            <th></th>
            <th>Lunes</th>
            <th>Martes</th>
            <th>Miércoles</th>
            <th>Jueves</th>
            <th>Viernes</th>
        </tr>
        <tr>
            <th><?php echo $primeraHora ?></th>
            <td rowspan="2" align="center"><?php echo $asignaturaDIW ?></td>
            <td align="center"><?php echo $asignaturaEIEM ?></td>
            <td rowspan="2" align="center"><?php echo $asignaturaDAW ?></td>
            <td align="center"><?php echo $asignaturaDWEC ?></td>
            <td rowspan="2" align="center"><?php echo $asignaturaDWES ?></td>

        </tr>
        <tr>
            <th><?php echo $segundaHora ?></th>
            <td rowspan="2" align="center"><?php echo $asignaturaDWES ?></td>
            <td rowspan="2" align="center"><?php echo $asignaturaDIW ?></td>
        </tr>
        <tr>
            <th><?php echo $terceraHora ?></th>
            <td align="center"><?php echo $asignaturaDWES ?></td>
            <td align="center"><?php echo $asignaturaDWEC ?></td>
            <td align="center"><?php echo $asignaturaDIW ?></td>
        </tr>
        <tr>
            <th>R</th>
            <th>E</th>
            <th>C</th>
            <th>R</th>
            <th>E</th>
            <th>O</th>
        </tr>
        <tr>
            <th><?php echo $cuartaHora ?></th>
            <td align="center"><?php echo $asignaturaDWES ?></td>
            <td rowspan="2" align="center"><?php echo $asignaturaDAW ?></td>
            <td align="center"><?php echo $asignaturaDWEC ?></td>
            <td rowspan="2" align="center"><?php echo $asignaturaDWES ?></td>
            <td align="center"><?php echo $asignaturaDIW ?></td>
        </tr>
        <tr>
            <th><?php echo $quintaHora ?></th>
            <td align="center"><?php echo $asignaturaEIEM ?></td>
            <td rowspan="2" align="center"><?php echo $asignaturaDIW ?></td>
            <td rowspan="2" align="center"><?php echo $asignaturaDWEC ?></td>
        </tr>
        <tr>
            <th><?php echo $sextaHora ?></th>
            <td align="center"><?php echo $asignaturaDAW ?></td>
            <td align="center"><?php echo $asignaturaDWEC ?></td>
            <td align="center"><?php echo $asignaturaEIEM ?></td>
        </tr>

    </table>
</body>
</html>

