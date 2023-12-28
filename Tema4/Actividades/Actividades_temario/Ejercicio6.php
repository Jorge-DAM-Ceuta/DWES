<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 6</title>
    </head>
    <body>        
        <?php
            try{
                if (isset($_POST['enviar']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
                    $archivo = $_FILES['archivo'];
                    $nombre_temporal = $archivo['tmp_name'];

                    if(file_exists($nombre_temporal)) {
                        $contenido = file_get_contents($nombre_temporal);
                        
                        if($contenido == false){
                            throw new Exception('Error al leer el archivo');
                        }
                    }else{
                        //die("Error: No se ha podido cargar el archivo...");
                        throw new Exception('Error: No se ha podido cargar el archivo...');
                    }      
                }
            }catch(Exception $error){
                $codigo = $error -> getCode();
                $mensaje = $error -> getMessage();
                $archivo = $error -> getFile();
                $linea = $error -> getLine();

                echo "Excepción lanzada en el fichero $file, línea $linea: [Codigo $code] $mensaje";
            }
        ?>

        <form method="post" enctype="multipart/form-data">
            <p>
                <input type="file" name="archivo" accept=".txt">
            </p>

            <p>
                <textarea name="contenido" rows="10" cols="50"><?php echo isset($contenido) ? $contenido : ''; ?></textarea>
            </p>
            
            <input type="submit" name="enviar" value="Cargar Archivo">
        </form>
    </body>
</html>
