<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 17</title>
    </head>
    <body>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <p>
                <label>Nombre: </label>
                <input type="text" name="nombre" id="nombre">
            </p>

            <p>
                <label>Altura: </label>
                <input type="text" name="altura" id="altura">
            </p>

            <p>
                <label>Edad: </label>
                <input type="number" name="edad" id="edad">
            </p>

            <p>
                <label>¿Rechaza llevarnos a juicio por daños y perjuicios de un mal mantenimiento?: </label>
                <p>
                    <label><input type="radio" name="radio" value="Si">Si</label>
                    <label><input type="radio" name="radio" value="No">No</label>           
                </p>    
            </p>

            <input type="submit" name="enviar" id="enviar">
        </form>

        <?php
            include_once "./Ejercicio11.inc.php";

            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['enviar'])){
                $nombre = validarDatos($_POST['nombre']);
                $altura = floatval($_POST['altura']);
                $edad = $_POST['edad'];
                $aceptaAcuerdo = $_POST['radio'];

                $ticket = "";
                if($edad > 16 && $altura > 1.20 && $aceptaAcuerdo == 'Si'){
                    $ticket = imprimirTicket(nombre: $nombre);
                    echo "<h2>$ticket</h2>";
                }else{
                    echo "<h2>No tienes derecho a subir a la atracción</h2>";
                }

                
            }

            function imprimirTicket(string $nombre): string{
                
                $ticket = $nombre . ", ticket " . random_int(0, 99999);

                return $ticket;
            }
        ?>
    </body>
</html>