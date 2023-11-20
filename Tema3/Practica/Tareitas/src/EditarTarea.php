<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar tarea</title>
        <link rel="stylesheet" href="../assets/css/Style.css">
    </head>
    <body>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

            <?php
                include_once("./Funciones.inc.php");

                $listas = decodificarListas("ListaTareas.json");

                $id = $_GET["id"];
                $lista = $_GET["lista"];

                //echo "<h1>1NOMBRE LISTA: $lista</h1>";

                cargarTarea($listas, $id, $lista);

                //eliminarTarea($listas, $id, $lista);
                //echo "<h1>2NOMBRE LISTA: $lista</h1>";
            ?>

            <input type="submit" name="modificar" value="Editar tarea">
        </form>

        <?php

            echo "<h1>3NOMBRE LISTA: $lista</h1>";

            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modificar'])){
                $descripcion = $_POST['descripcion'];
                $prioridad = $_POST['prioridad'];
                $fechaLimite = date("d/m/Y", strtotime($_POST['fechaLimite']));
                $estado = $_POST['estado'];

                echo"<p>$descripcion, $prioridad, $fechaLimite, $lista, $estado</p>";

                agregarTareaALista($descripcion, $prioridad, $fechaLimite, $lista, $listas, $estado);

            }
        ?>
    </body>
</html>
