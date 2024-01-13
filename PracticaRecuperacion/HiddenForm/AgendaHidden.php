<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Agenda</title>
    </head>
    <body>
        <?php
            $nombre = ""; 
            $numero = "";
            $nombresOcultos = "";
            $numerosOcultos = "";

            if(isset($_POST['agregar']) && $_SERVER['REQUEST_METHOD'] == "POST"){
                $nombreActual = $_POST["nombre"];
                $numeroActual = $_POST["numero"];
                
                //HIDDEN VALUES
                $nombresOcultos = isset($_POST["nombresOcultos"]) ? $_POST["nombresOcultos"] : "";
                $numerosOcultos = isset($_POST["numerosOcultos"]) ? $_POST["numerosOcultos"] : "";

                //ADD VALUES
                $nombresOcultos .= ($nombresOcultos != "") ? ", $nombreActual" : $nombreActual;
                $numerosOcultos .= ($numerosOcultos != "") ? ", $numeroActual" : $numeroActual;
            }
        ?>

        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <label>Nombre: <input type="text" name="nombre"></label>
            <label>Número: <input type="text" name="numero"></label>

            <input type="hidden" name="nombresOcultos" value="<?php echo $nombresOcultos;?>">
            <input type="hidden" name="numerosOcultos" value="<?php echo $numerosOcultos;?>">

            <input type="submit" name="agregar" value="Agregar contacto">
        </form>
    </body>
</html>