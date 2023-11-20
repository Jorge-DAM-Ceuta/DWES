<?php
    include_once("./src/Funciones.inc.php");

    $listas = decodificarListas("src/ListaTareas.json");
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Listas</title>
        <link rel="stylesheet" href="./assets/css/Style.css">
    </head>
    <body>
        <header>
                <h1>Listas</h1>

                <nav>
                    <a href="./Index.php">Tareitas</a>
                    <a href="./Listas.php">Listas</a>
                    <a href="./Notas.php">Notas</a>
                </nav>
        </header>
        
        <main>
            <section>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <h2>Añadir nueva lista</h2>

                    <label for="lista">Nombre de lista: </label>
                    <input type="text" id="lista" name="lista">

                    <input type="submit" id="nuevaLista" name="nuevaLista" value="Añadir">
                </form>
            </section>

            <section>
                <article>
                    <div>
                        <table>
                            <tr>
                                <th><h2>Listas actuales</h2></th>
                            </tr>
                                
                            <?php
                            //MOSTRAR LISTAS
                                mostrarListas($listas);
                            ?>
                        </table>
                    </div>
                </article>
            </section>
        </main>

        <?php
            //CREAR UNA NUEVA LISTA
            if(isset($_POST['nuevaLista']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
                $nombreLista = $_POST['lista'];

                agregarLista($listas, $nombreLista);
                $listas = decodificarListas("src/ListaTareas.json");
            }
        ?>
    </body>
</html>