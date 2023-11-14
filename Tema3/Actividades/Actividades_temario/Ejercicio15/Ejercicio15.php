<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 15</title>
    </head>
    <body>

        <?php
            
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['calcular'])) {
              
                $sumaNotas = 0;
                $nombreAlumnos = array();
                $mediasAlumnos = array();

                $rutaJSON = "./Notas.json";
                $jsonString = file_get_contents($rutaJSON);
                $alumnos = json_decode($jsonString, true);

                foreach($alumnos as $objeto => $informacion){
                    foreach($informacion as $asignatura => $notas){
                        //Se guarda el nombre del alumno.
                        if($asignatura == "nombre"){
                            array_push($nombreAlumnos, $notas);
                        }else{
                            foreach($notas as $nota){
                                echo "<h3>NOTAS TOTALES, Nota: $nota</h3>";
                            }
                        } 
                    }
                }

                foreach($nombreAlumnos as $nombres){
                    echo "<h2>NOMBRES: $nombres</h2>";
                }

                /*
                foreach($alumnos as $nombre => $notas){
                    echo "<p>Notas de $nombre: $notas</p>";

                    //Guardamos los nombres de los alumnos en un array para mostrar sus datos luego.
                    array_push($nombreAlumnos, $nombre);

                    //Quitamos los espacios y comas al string de las notas del alumno.
                    $explodeNotas = explode(", ", $notas); 

                    //Recorremos cada posicion del string de las notas del alumno para sumarlas a otra variable.
                    for($i = 0; $i < count($explodeNotas); $i++){
                        $sumaNotas += (int)$explodeNotas[$i];
                    }
                    
                    //Hacemos la media y la guardamos en otro array para mostrarlo luego.
                    $media = $sumaNotas / 5;
                    array_push($mediasAlumnos, $media);

                    //Reiniciamos el valor de la variable para realizar la suma del siguiente alumno.
                    $sumaNotas = 0;
                }
                
                //Mostramos las medias de las notas de cada alumno.
                for($i = 0; $i < count($nombreAlumnos); $i++){
                    echo "<h3>Media de notas de $nombreAlumnos[$i]: $mediasAlumnos[$i]</h3>";
                }

                "Mohamed": "5, 8, 3, 6, 8",
                "Ra\u00fal": "7, 3, 3, 4, 1"

                */

            /*
                $jsonString = json_encode($notas, JSON_PRETTY_PRINT);
                $fichero = fopen($rutaJSON, 'w');
                fwrite($fichero, $jsonString);
                fclose($fichero);
            */
        }
        ?>

        <form name="calcularMedia" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            


            <input type="submit" name="calcular" value="Calcular">
        </form>

        <form name="addAlumn" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            
            <input type="submit" name="add" value="Add">
        </form>
    </body>
</html>