<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 19</title>
    </head>
    <body>
        <h1>Realizar petición POST:</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <label for="codigo">Código:</label>
            <input type="text" id="codigo" name="codigo">
            <input type="submit" name="buscar" value="Buscar">
        </form>
    
        <h1>Realizar petición GET:</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
            <label for="codigo">Código:</label>
            <input type="text" id="codigo" name="codigo">
            <input type="submit" name="buscar" value="Buscar">
        </form>
    </body>
</html>

<?php

    $rutaJSON = "./Inventario.json";
    $jsonString = file_get_contents($rutaJSON);
    $elementos = json_decode($jsonString, true);

    if(($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['buscar'])) || ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['buscar']))) {
        $codigoBuscado = $_REQUEST['codigo'] ?? null;
        $resultado = "";
    
        if($codigoBuscado != null) {
            foreach($elementos as $elemento => $valor) {
                foreach($valor as $valorCampo => $valores) {
                    foreach ($valores as $key => $value) {
                        if($key == "codigo" && $value == (int)$codigoBuscado){
                            foreach ($valores as $campo => $valor) {
                                echo "<p>$campo: $valor; </p>";
                            }
                        }
                    }
                }
            }
        }else{
            echo "<p>No se ha encontrado nada</p>";
        }
    }
?>