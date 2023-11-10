<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 9</title>
    </head>
    <body>
        <h1>Añadir una nota XML</h1>

        <form name="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            
            <p>
                <label>Título: </label>
                <input type="text" name="titulo" pattern=".+" required>
                <?php 
                    if(isset($_POST['enviar']) && empty($_POST['titulo'])){
                        echo "<span style='color:red'>--&lt; Debes introducir un título!!</span>";
                    }
                ?>
            </p>
            
            <p>
                <label>Fecha límite: </label>
                <input type="date" name="fecha" pattern=".+" required>
                <?php 
                    if(isset($_POST['enviar']) && empty($_POST['fecha'])){
                        echo "<span style='color:red'>--&lt; Debes introducir una fecha!!</span>";
                    }
                ?>
            </p>

            <p>
                <label>Contenido: </label>
                <input type="text" name="contenido" pattern=".+" required>
                <?php 
                    if(isset($_POST['enviar']) && empty($_POST['contenido'])){
                        echo "<span style='color:red'>--&lt; Debes introducir contenido en la nota!!</span>";
                    }
                ?>
            </p>

            <input name="generar" value="Generar" type="submit">
        </form>

        <?php
            include_once('../Ejercicio11.inc.php');

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['generar'])){

                if(file_exists('./contenido.txt')){
                    $archivo = fopen("./contenido.txt", "w") or die("No se puede abrir el fichero.");
                    fwrite($archivo, validarDatos($_POST["contenido"]));
                    fclose($archivo);
                    
                    $archivo = fopen("./contenido.txt", "r") or die("No se puede abrir el fichero.");
                    $contenido = fread($archivo, filesize("./contenido.txt"));
                    fclose($archivo);

                    if(file_exists('./notas.xml')){
                        $notas = simplexml_load_file('./notas.xml');
                        //Se añade un nuevo nodo.
                        $nota = $notas->addChild('nota');
    
                        $nota->addChild('titulo', validarDatos($_POST['titulo']));
                        $nota->addChild('fechaLimite', validarDatos($_POST['fecha']));
                        $nota->addChild('contenido', $contenido);
    
                        file_put_contents('notas.xml', $notas->asXML());
    
                        mostrarNotas();
                    }

                }else{
                    $archivo = fopen("./contenido.txt", "w") or die("No se puede abrir el fichero.");
                    fwrite($archivo, validarDatos($_POST["contenido"]));
                    fclose($archivo);
                    
                    $archivo = fopen("./contenido.txt", "r") or die("No se puede abrir el fichero.");
                    $contenido = fread($archivo, filesize("./contenido.txt"));
                    fclose($archivo);

                    //XML
                    $fichero = fopen('notas.xml','w');
                    fwrite($fichero, '<notas>');
                    fwrite($fichero, '</notas>');
                    fclose($fichero);

                    $notas = simplexml_load_file('./notas.xml');
                    //Se añade un nuevo nodo.
                    $nota = $notas->addChild('nota');

                    $nota->addChild('titulo', validarDatos($_POST['titulo']));
                    $nota->addChild('fechaLimite', validarDatos($_POST['fecha']));
                    $nota->addChild('contenido', $contenido);

                    file_put_contents('notas.xml', $notas->asXML());

                    mostrarNotas();
                }
            }

            function mostrarNotas(){
                $xml = simplexml_load_file('./notas.xml');

                echo "<table border='1'>";

                echo "<tr>
                        <th>Título</th>
                        <th>Fecha límite</th>
                        <th>Contenido</th>
                    </tr>";

                foreach($xml->nota as $nota){
                    echo "
                        <tr>
                            <td>" . $nota->titulo . "</td>
                            <td align='center'>" . $nota->fechaLimite . "</td>
                            <td>" . $nota->contenido . "</td>
                        </tr>
                    ";
                }

                echo "</table>";
                
            }

        ?> 
    </body>
</html>

