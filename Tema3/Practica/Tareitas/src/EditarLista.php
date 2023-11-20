<?php

    include_once("./Funciones.inc.php");

    $listas = decodificarListas("ListaTareas.json");
    $nombreLista = $_GET['lista'];
?>
    
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar lista</title>
        <link rel="stylesheet" href="./assets/css/Style.css">
    </head>
    <body>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
            <p>
                <label>Nuevo nombre para la lista: '<?php echo $nombreLista; ?>': </label>
                <input type="text" name="nombreLista" id="nombreLista">
            </p>

            <input type="submit" name="modificar" id="modificar" value="Editar">
        </form>    
    </body>
</html>
    
<?php

    if(isset($_POST['modificar']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
        $nuevoNombre = $_POST['nombreLista'];
        echo "<p>$nuevoNombre</p>";
        editarLista($listas, $nombreLista, $nuevoNombre);
    }
    
?>