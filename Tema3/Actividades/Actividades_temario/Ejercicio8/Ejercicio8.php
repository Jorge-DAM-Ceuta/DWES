<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 8</title>
    </head>
    <body>
        <h1>Añadir una nota XML</h1>

        <form name="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            
            <p>
                <label>Título: </label>
                <input type="text" name="titulo" pattern=".+">
            </p>
            
            <p>
                <label>Fecha límite: </label>
                <input type="date" name="fecha" pattern=".+">
            </p>

            <p>
                <label>Contenido: </label>
                <input type="text" name="contenido" pattern=".+">
            </p>

            <input name="generar" value="Generar" type="submit">
        </form>

        <?php

            if (isset($_POST['generar'])){
                if(file_exists('./notas.xml')){
                    $notas = simplexml_load_file('./notas.xml');
                    //Se añade un nuevo nodo.
                    $nota = $notas->addChild('nota');

                    $nota->addChild('titulo', $_POST['titulo']);
                    $nota->addChild('fechaLimite', $_POST['fecha']);
                    $nota->addChild('contenido', $_POST['contenido']);

                    file_put_contents('notas.xml', $notas->asXML());

                    mostrarNotas();

                }else{
                    $fichero = fopen('notas.xml','w');
                    fwrite($fichero, '<notas>');
                    fwrite($fichero, '</notas>');
                    fclose($fichero);

                    $notas = simplexml_load_file('./notas.xml');
                    //Se añade un nuevo nodo.
                    $nota = $notas->addChild('nota');

                    $nota->addChild('titulo', $_POST['titulo']);
                    $nota->addChild('fechaLimite', $_POST['fecha']);
                    $nota->addChild('contenido', $_POST['contenido']);

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