<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 3</title>
    </head>
    <body>
        <form action="./images/Imagen.php" method="POST" enctype="multipart/form-data/">
            Añadir imagen: 
            <br>
            <input name="archivo" id="archivo" type="file"/>
            <br>
            <input type="submit" name="subir" value="Subir imagen"/>
        </form>

        <?php

            if (isset($_POST['subir'])) {
                /*Se recoge el archivo del formulario*/
                $archivo = $_FILES['archivo']['name'];

                /*Se comprueba que el input no esté vacío y se recogen 
                los datos referentes al tipo, tamaño y archivo temporal*/
                if (isset($archivo) && $archivo != "") {
                        
                    $tipo = $_FILES['archivo']['type'];
                    $tamano = $_FILES['archivo']['size'];
                    $temp = $_FILES['archivo']['tmp_name'];

                    /*Se comprueba el tipo de archivo mediante su extensión y su tamaño*/
                    if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "svg")) && ($tamano < 2000000))) {
                        echo "<strong>Error, el archivo debe ser .gif, .jpg o .svg y debe pesar 2 MB como máximo.</strong>";
                    
                    }else {
                        /*Se intenta subir la imagen al archivo Imagen.php del servidor*/
                        if (move_uploaded_file($temp, "./images/" . $archivo)) {
                            /*Se asignan todos los permisos al archivo y se muestra la imagen*/
                            chmod("./images/" . $archivo, 0777);
                            echo "<p>Se ha subido correctamente la imagen.</p>";
                            echo "<img src='./images/" . $archivo . "'>";
                        }
                        else {
                            //Si no se ha podido subir la imagen, mostramos un mensaje de error
                            echo "<strong>Error al subir la imagen</strong>";
                        }
                    }
                }

            }
        ?>
    </body>
</html>

