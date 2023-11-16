<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar tarea</title>
    </head>
    <body>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

            <?php
                include_once("./Funciones.inc.php");

                $listas = decodificarListas("ListaTareas.json");

                $id = $_GET["id"];
                $lista = $_GET["lista"];

                editarTarea($listas, $id, $lista);
            ?>

            <input type="submit" name="modificar" value="Editar tarea">
        </form>

        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modificar'])){
                $descripcion = $_POST['descripcion'];
                $prioridad = $_POST['prioridad'];
                $fechaLimite = $_POST['fechaLimite'];
                $estado = $_POST['estado'];
            }
        ?>
    </body>
</html>
