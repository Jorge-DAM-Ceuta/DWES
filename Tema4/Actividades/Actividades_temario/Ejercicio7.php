<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 7</title>
    </head>
    <body>        
        <?php
            function errorPersonalizado($nivelError, $mensajeError) {
                echo "<b>Error:</b> [$nivelError] $mensajeError<br>";
                die("Finalizando Script");
            }

            function esArchivoTxt($nombre_archivo) {
                $extension = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
                return strtolower($extension) == 'txt';
            }

            set_error_handler("errorPersonalizado", E_USER_WARNING);

            if (isset($_POST['enviar']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
                $archivo = $_FILES['archivo'];

                $nombre_temporal = $archivo['tmp_name'];

                if(file_exists($nombre_temporal) && esArchivoTxt($archivo['name'])) {
                    $contenido = file_get_contents($nombre_temporal);
                } else {
                    trigger_error("No se ha podido cargar el archivo o no es un archivo .txt", E_USER_WARNING);
                }      
            }
        ?>

        <form method="post" enctype="multipart/form-data">
            <p>
                <input type="file" name="archivo">
            </p>

            <p>
                <textarea name="contenido" rows="10" cols="50"><?php echo isset($contenido) ? $contenido : ''; ?></textarea>
            </p>
            
            <input type="submit" name="enviar" value="Cargar Archivo">
        </form>
    </body>
</html>
