<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 10</title>
    </head>
    <body>
        <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <p>
                <label>Sube cualquier tipo de archivo</label>
                <input name="archivo" type="file">
            </p>

            <input name="enviar" value="Subir" type="submit">
        </form>

        <?php

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['enviar']) && !empty($_FILES['archivo']['name'])){
                
                $filePath = './Archivos/' . basename($_FILES['archivo']['name']);
                
                if(move_uploaded_file($_FILES['archivo']['tmp_name'], $filePath)){
                    echo "<h4>El archivo se ha subido</h4>";
                }else{
                    echo "<h4>Error en la subida del archivo</h4>";
                }

            }
        ?> 
    </body>
</html>