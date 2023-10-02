<?php

$asignaturaDWES = "Desarrollo de Web en Entorno Servidor (DWES)";
$asignaturaDWEC = "Desarrollo de Web en Entorno Cliente (DWEC)";
$asignaturaDAW = "Despliegue de Aplicaciones Web (DAW)";
$asignaturaDIW = "Diseño de Interfaces Web (DIW)"; 
$asignaturaEIEM = "Empresa e Iniciativa Emprendedora (EIEM)";

$diasLectivos = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes"];
$horaRecreo = ["R", "E", "C", "R", "E", "O"];
$horarioList = ["08:25 - 9:20", "9:20 - 10:15", "10:15 - 11:10", "11:10 - 11:30", "11:30 - 12:25", "12:25 - 13:20", "13:20 - 14:15"];

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Horario de clase v2</title>
    </head>
    <body>

        <!-- En este bloque se crea una tabla que mediante apertura 
        de bloques PHP para mostrar los valores correspondientes al
        horario de clase mediante echo. -->

        <table border=3>
            <?php

                    echo "<tr><th></th>";
                    foreach($diasLectivos as $dias){
                        echo "<th>$dias</th>";
                    }
                ?>
            </tr>
            <tr>
                <?php
                    echo "<th>$horarioList[0]</th>";

                    for(){

                    }
                ?>
                
                
            </tr>
            

        </table>
    </body>
</html>