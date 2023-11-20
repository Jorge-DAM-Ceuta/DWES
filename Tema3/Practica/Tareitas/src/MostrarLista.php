<?php
    include_once("./Funciones.inc.php");
    $listas = decodificarListas("ListaTareas.json");
    $lista = $_GET['lista'];
    define('LISTA', $lista);
    $titulo = "Tareas de la lista '$lista'";
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $titulo; ?></title>
        <link rel="stylesheet" href="./assets/css/Style.css">
    </head>
    <body>
        <header>
            <h1>Tareitas</h1>

            <nav>
                <a href="../Index.php">Tareitas</a>
                <a href="../Listas.php">Listas</a>
                <a href="../Notas.php">Notas</a>
            </nav>
        </header>
        <h1>Tareas de la lista '<?php echo $lista; ?>'</h1>

        <table border="1">
            <tr>
                <th></th>
                <th>Descripción</th>
                <th>Prioridad</th>
                <th>Fecha Límite</th>
            </tr>

            <?php
                mostrarLista($listas, $lista);
            ?>  
        </table>

        <br/>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <p>
                <h2>Añadir nueva tarea</h2>

                <label for="descripcion">Descripción: </label>
                <input type="text" id="descripcion" name="descripcion">

                <label for="prioridad">Prioridad: </label>
                <select name="prioridad">
                    <option value="Alta">Alta</option>
                    <option value="Media">Media</option>
                    <option value="Baja">Baja</option>
                </select>
                
                <label for="fechaLimite">Fecha límite: </label>
                <input type="date" id="fechaLimite" name="fechaLimite">

                <input type="submit" id="nuevaTarea" name="nuevaTarea" value="Añadir">
            </p>    
        </form>

        <?php
            if(isset($_GET['nuevaTarea']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
                $descripcion = $_POST['descripcion'];
                $prioridad = $_POST['prioridad'];
                $fechaLimite = date("d/m/Y", strtotime($_POST['fechaLimite']));

                agregarTareaALista($descripcion, $prioridad, $fechaLimite, LISTA, $listas);
                header("Location: ./src/MostrarLista.php?lista=LISTA");
            }
        ?>
    </body>
</html>