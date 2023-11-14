<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 15</title>
    </head>
    <body>

        <form name="addAlumn" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            
            <p>
                <label>Nombre del alumno: </label>
                <input type="text" name="nombre" id="nombre" required>
            </p>

            <p>
                <label>Notas de DWES: </label>
                <input type="text" name="DWES" id="DWES" placeholder="5 notas separadas por  ', '" size="30" required>
            </p>

            <p>
                <label>Notas de DWEC: </label>
                <input type="text" name="DWEC" id="DWEC" placeholder="5 notas separadas por  ', '" size="30" required>
            </p>

            <p>
                <label>Notas de DIW: </label>
                <input type="text" name="DIW" id="DIW" placeholder="5 notas separadas por  ', '" size="30" required>
            </p>

            <p>
                <label>Notas de DAW: </label>
                <input type="text" name="DAW" id="DAW" placeholder="5 notas separadas por  ', '" size="30" required>
            </p>

            <p>
                <label>Notas de EIEM: </label>
                <input type="text" name="EIEM" id="EIEM" placeholder="5 notas separadas por  ', '" size="30" required>
            </p>

            <input type="submit" name="add" value="Añadir alumno">
        </form>

        <form name="calcularMedia" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="submit" name="calcular" value="Calcular media">
        </form>

        <?php
            //FORMULARIO DE CÁLCULO...
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['calcular'])) {
                $nombreAlumnos = array();
                $mediasAlumnos = array();
                $sumaNotas = 0;
                
                $rutaJSON = "./Notas.json";
                $jsonString = file_get_contents($rutaJSON);
                $alumnos = json_decode($jsonString, true);

                //MOSTRAR NOTAS DE CADA ALUMNO.
                foreach($alumnos as $objeto => $informacion){
                    foreach($informacion as $asignatura => $notas){
                        if($asignatura == "nombre"){
                            echo "<h2>Notas de $notas</h2>";

                        }else{
                            echo "<p>$asignatura:";
                            
                            foreach($notas as $nota){
                                echo ", $nota";
                            }

                            echo "</p>";
                        } 
                    }
                }

                //CALCULAR LAS MEDIAS DE CADA ALUMNO.
                foreach($alumnos as $objeto => $informacion){
                    foreach($informacion as $asignatura => $notas){
                        if($asignatura == "nombre"){
                            array_push($nombreAlumnos, $notas);

                        //Se suman las notas y en la última asignatura,
                        //se añade la suma al array y se asigna de nuevo a 0.
                        }else if($asignatura == "EIEM"){
                            foreach($notas as $nota){
                                $sumaNotas += $nota;
                            }

                            array_push($mediasAlumnos, $sumaNotas / 25);   
                            $sumaNotas = 0;

                        }else{
                            foreach($notas as $nota){
                                $sumaNotas += $nota;
                            }
                        } 
                    }
                }

                //MOSTRAR LA MEDIA DE CADA ALUMNO.
                for($i = 0; $i<count($nombreAlumnos); $i++){
                    echo "<h2>Media del alumno $nombreAlumnos[$i]: $mediasAlumnos[$i]</h2>";
                }

        }

        //FORMULARIO PARA AÑADIR ALUMNO...
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
            $rutaJSON = "./Notas.json";
            $jsonString = file_get_contents($rutaJSON);
            $alumnos = json_decode($jsonString, true);
            
            $nuevoAlumno = array(
                "nombre" => $_POST['nombre'],
                "DWES" => convertirNotas($_POST['DWES']),
                "DWEC" => convertirNotas($_POST['DWEC']),
                "DIW" => convertirNotas($_POST['DIW']),
                "DAW" => convertirNotas($_POST['DAW']),
                "EIEM" => convertirNotas($_POST['EIEM'])
            );

            array_push($alumnos, $nuevoAlumno);

            echo "<h2>Se ha añadido el alumno con éxito.</h2>";

            $jsonString = json_encode($alumnos, JSON_PRETTY_PRINT);
            $fichero = fopen($rutaJSON, 'w');
            fwrite($fichero, $jsonString);
            fclose($fichero);

        }

        //FUNCIÓN PARA CONVERTIR EL VALOR DEL INPUT EN VARIOS NÚMEROS...
        function convertirNotas(string $texto): array{
            $notas = explode(", ", $texto);

            foreach($notas as &$nota){
                $nota = (int)$nota;
            }

            return $notas;
        }

        ?>
    </body>
</html>