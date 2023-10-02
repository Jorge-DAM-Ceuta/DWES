<?php

/* En esta variación del ejercicio 2 seguimos usando las variables para los nombres de las 
asignaturas, con algunos añadidos. En este caso hemos agrupado el horario en un array, 
también los días lectivos que van en la cabecera de la tabla y las letras de la palabra 
recreo que van en el centro de la tabla. 

Por último hay un array por cada hora de clase con el objetivo de organizar las clases 
por horas para que sea más fácil su escritura en la tabla. */

$asignaturaDWES = "Desarrollo de Web en Entorno Servidor (DWES)";
$asignaturaDWEC = "Desarrollo de Web en Entorno Cliente (DWEC)";
$asignaturaDAW = "Despliegue de Aplicaciones Web (DAW)";
$asignaturaDIW = "Diseño de Interfaces Web (DIW)"; 
$asignaturaEIEM = "Empresa e Iniciativa Emprendedora (EIEM)";

$diasLectivos = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes"];
$horarioList = ["08:25 - 9:20", "9:20 - 10:15", "10:15 - 11:10", "11:30 - 12:25", "12:25 - 13:20", "13:20 - 14:15"];
$horaRecreo = ["R", "E", "C", "R", "E", "O"];

$asignaturasPrimeraHora = [$asignaturaDIW, $asignaturaEIEM, $asignaturaDAW, $asignaturaDWEC, $asignaturaDWES];
$asignaturasSegundaHora = [$asignaturaDIW, $asignaturaDWES, $asignaturaDAW, $asignaturaDIW, $asignaturaDWES];
$asignaturasTerceraHora = [$asignaturaDWES, $asignaturaDWES, $asignaturaDWEC, $asignaturaDIW, $asignaturaDIW];
$asignaturasCuartaHora = [$asignaturaDWES, $asignaturaDAW, $asignaturaDWEC, $asignaturaDWES, $asignaturaDIW];
$asignaturasQuintaHora = [$asignaturaEIEM, $asignaturaDAW, $asignaturaDIW, $asignaturaDWES, $asignaturaDWEC];
$asignaturasSextaHora = [$asignaturaDAW, $asignaturaDWEC, $asignaturaDIW, $asignaturaEIEM, $asignaturaDWEC];

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Horario de clase v2</title>
    </head>
    <body>

        <!-- En este bloque PHP se crea una tabla y mediante bucles sigue la siguiente lógica:
        Se escriben en la cabecera los días de la semana mediante un foreach que recorre su
        correspondiente array. 
        
        Luego, se escribe el comienzo de una fila mediante el uso manual del array de horas, 
        en primer lugar la posición 0. Luego, mediante bucles for tradicionales el objetivo es 
        escribir en la misma fila, después de la hora, todas las asignaturas que hay a esa hora.
        
        Hasta aquí todo bien, la única implementación de condicionales se ha realizado, sabiendo qué 
        día y asignaturas hay clases dobles es comprobar que por ejemplo: El lunes a primera y segunda
        hora hay una misma clase, entonces al escribir las asignaturas de la primera hora, en el bucle 
        se pregunta si la i es igual a 0 para saber que esa asignatura que se encuentra en primer lugar 
        tiene dos horas y añadirle a esa celda un rowspan='2' para expandir el contenido una fila más.

        Entonces, al bucle for de las asignaturas de segunda hora hay que realizar la misma comprobación 
        y en ese caso no escribir nada. -->

        <?php
            echo "<table border='3' width='50%'><tr><th></th>";

            foreach($diasLectivos as $dias){
                echo "<th>$dias</th>";
            }

            echo "</tr><tr><th>$horarioList[0]</th>";

            for($i = 0; $i<5; $i++){
                if($i == 0 || $i == 2 || $i == 4){
                    echo "<td align='center' rowspan='2'>" . $asignaturasPrimeraHora[$i] . "</td>";
                }else{
                    echo "<td align='center'>" . $asignaturasPrimeraHora[$i] . "</td>";
                }
                    
            }

            echo "</tr><tr><th>$horarioList[1]</th>";

            for($i = 0; $i<5; $i++){
                if($i == 0 || $i == 2 || $i == 4){

                }else{
                    echo "<td align='center'>" . $asignaturasSegundaHora[$i] . "</td>";
                }
            }

            echo "</tr><tr><th>$horarioList[2]</th>";

            for($i = 0; $i<5; $i++){
                echo "<td align='center'>" . $asignaturasTerceraHora[$i] . "</td>";
            }

            echo "</tr><tr>";

            foreach($horaRecreo as $letra){
                echo "<th align='center'>" . $letra . "</th>";
            }

            echo "</tr><tr><th>$horarioList[3]</th>";

            for($i = 0; $i<5; $i++){
                if($i == 1 || $i == 3){
                    echo "<td align='center' rowspan='2'>" . $asignaturasCuartaHora[$i] . "</td>";
                }else{
                    echo "<td align='center'>" . $asignaturasCuartaHora[$i] . "</td>";
                }
                    
            }

            echo "</tr><tr><th>$horarioList[4]</th>";

            for($i = 0; $i<5; $i++){
                if($i == 1 || $i == 3){

                }else if($i == 2 || $i == 4){
                    echo "<td align='center' rowspan='2'>" . $asignaturasQuintaHora[$i] . "</td>";
                }else{
                    echo "<td align='center'>" . $asignaturasQuintaHora[$i] . "</td>";
                }
            }

            echo "</tr><tr><th>$horarioList[5]</th>";

            for($i = 0; $i<5; $i++){
                if($i == 2 || $i == 4){

                }else{
                    echo "<td align='center'>" . $asignaturasSextaHora[$i] . "</td>";
                }
            }

            echo "</tr></table>";
        ?>
    </body>
</html>