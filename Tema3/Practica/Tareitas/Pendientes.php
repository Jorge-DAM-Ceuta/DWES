<?php
    include_once("./src/Funciones.inc.php");

    $listas = decodificarListas();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Index</title>
    </head>
    <body>
        <header>
                <h1>Tareitas</h1>

                <nav>
                    <a href="#">Tareitas</a>
                    <a href="./Listas.php">Listas</a>
                    <a href="./Notas.php">Notas</a>
                </nav>
        </header>
        
        <main>
            <section>
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

                        <label for="listas">Añadir a la lista: </label>
                        <select name="listas">
                            <?php
                                mostrarListasEnSelect($listas);
                            ?>
                        </select>

                        <input type="submit" id="nuevaTarea" name="nuevaTarea" value="Añadir">
                    </p>    
                </form>
            </section>

            <section>
                <article>
                    <div>
                        <h2>Pendientes</h2>
                        
                        <table border='1'>
                        <tr>
                            <th></th>
                            <th>Descripción</th>
                            <th>Prioridad</th>
                            <th>Fecha Límite</th>
                            <th>Opciones</th>
                        </tr>
                            
                        <?php
                        //MOSTRAR TAREAS PENDIENTES  
                            mostrarTablaPendientes($listas);
                        ?>

                        </table>
                    </div>
                </article>

                <article>
                    <div>
                        <h2>Completadas</h2>
                        
                        <table border='1'>
                        <tr>
                            <th></th>
                            <th>Descripción</th>
                            <th>Prioridad</th>
                            <th>Fecha Límite</th>
                            <th>Opciones</th>
                        </tr>
                            
                        <?php
                        //MOSTRAR TAREAS COMPLETADAS
                            mostrarTablaCompletadas($listas);
                        ?>

                        </table>
                    </div>
                </article>
            </section>
        </main>

        <?php
            //CREAR UNA NUEVA TAREA
            if(isset($_POST['nuevaTarea']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
                $descripcion = $_POST['descripcion'];
                $prioridad = $_POST['prioridad'];
                $fechaLimite = date("d/m/Y", strtotime($_POST['fechaLimite']));
                $listaPerteneciente = $_POST['listas'];

                agregarTareaALista($descripcion, $prioridad, $fechaLimite, $listaPerteneciente, $listas);
                $listas = decodificarListas();
            }
        ?>
    </body>
</html>