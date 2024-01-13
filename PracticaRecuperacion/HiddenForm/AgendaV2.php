<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Agenda V2</title>
    </head>
    <body>
        <?php
            $nombre = $numero = "";
            $nombresOcultos = $numerosOcultos = "";

            if(isset($_POST["agregar"])){
                $nombre = $_POST["nombre"];
                $numero = $_POST["numero"];

                $nombresOcultos = isset($_POST["nombresOcultos"]) ? $_POST["nombresOcultos"] : "";
                $numerosOcultos = isset($_POST["numerosOcultos"]) ? $_POST["numerosOcultos"] : "";
                
                $nombresOcultos .= ($nombresOcultos != "") ? ", $nombre" : $nombre;
                $numerosOcultos .= ($numerosOcultos != "") ? ", $numero" : $numero;
            }
        ?>

        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <label>Nombre: <input type="text" name="nombre"></label>
            <label>Número: <input type="text" name="numero"></label>
            
            <input name="nombresOcultos" value="<?php echo $nombresOcultos;?>">
            <input name="numerosOcultos" value="<?php echo $numerosOcultos;?>">

            <input type="submit" name="agregar">
        </form>
    </body>
</html>