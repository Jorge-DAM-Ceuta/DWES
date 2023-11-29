<?php
    $_POST['nombre'] = '';
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 1</title>
    </head>
    <body>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <p>
                <label>Nombre: </label>
                <input type="text" name="nombre" id="nombre" value="<?php echo $_POST['nombre']; ?>" />
                <?php if(isset($_POST['agregar']) && empty($_POST['nombre'])){
                    echo "<span style='color:red;'>Debes introducir un nombre!</span>";
                } ?>
            </p>

            <p>
                <label>Teléfono: </label>
                <input type="number" name="telefono" id="telefono" maxlength="9">
            </p>

            <?php
                if (!empty($contactos)) {
                    foreach($contactos as $contacto){
                        echo "<input type='hidden' name='contactos[]' value='" . $contacto . "'>";
                    }
                }

                echo "<input type='hidden' name='contacto' value='Nombre'=>$nombre, 'Telefono' => $telefono";
            ?>

            <input type="submit" name="agregar" value="Agregar">
        </form>
    </body>
</html>


<?php
    if(isset($_POST['agregar']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
        $contactos = isset($_POST['contactos']) ? $_POST['contactos'] : array();
        array_push($contactos, $_POST['contacto']);

        foreach($contactos as $contacto){
            //Si existe el nombre se sustituye el teléfono antiguo por el nuevo.
            if($contacto['nombre'] = $nombre && !is_null($telefono)){
                $contactos[$contacto['telefono']] = $telefono;

            //Si no se ha introducido teléfono se borra el contacto.
            }else if($contacto['nombre'] = $nombre && is_null($telefono)){
                unset($contactos[$contacto['nombre']]);
            }
        }
        
        /*$nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];

        //Añadimos el nuevo contacto al array
        array_push($contactos, array("Nombre" => $nombre, "Telefono" => $telefono));

        foreach($contactos as $contacto){
            foreach($contacto as $valores => $valor){
                echo "<p>$contacto, $valores, $valor</p>";
            }
        }*/

    }
?>