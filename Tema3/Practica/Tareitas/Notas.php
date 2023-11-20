<?php
    include_once("./src/Funciones.inc.php");

    $notas = decodificarNotas("src/Notas.json");
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Notas</title>
        <link rel="stylesheet" href="./assets/css/Style.css">
    </head>
    <body>
        <header>
                <h1>Notas</h1>

                <nav>
                    <a href="./Index.php">Tareitas</a>
                    <a href="./Listas.php">Listas</a>
                    <a href="./Notas.php">Notas</a>
                </nav>
        </header>
        
        <main>
            <section>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <p>
                        <h2>Añadir nueva nota</h2>

                        <label for="titulo">Título: </label>
                        <input type="text" id="titulo" name="titulo">

                        <label for="contenido">Contenido: </label>
                        <input type="text" id="contenido" name="contenido">

                        <label for="color">Color: </label>
                        <input type="color" id="color" name="color">

                        <input type="submit" id="nuevaNota" name="nuevaNota" value="Añadir">
                    </p>    
                </form>
            </section>

            <section>
                <article>
                    <div>
                        <h2>Pendientes</h2>
                        
                        <table border='1'>
                        <tr>
                            <th>Título</th>
                            <th>Contenido</th>
                            <th>Opciones</th>
                        </tr>
                            
                        <?php
                        //MOSTRAR NOTAS  
                            mostrarNotas($notas);
                        ?>

                        </table>
                    </div>
                </article>
            </section>
        </main>

        <?php
            //CREAR UNA NUEVA NOTA
            if(isset($_POST['nuevaNota']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
                $titulo = $_POST['titulo'];
                $contenido = $_POST['contenido'];
                $color = $_POST['color'];

                crearNota($notas, $titulo, $contenido, $color);
                $notas = decodificarNotas("src/Notas.json");
            }
        ?>
    </body>
</html>