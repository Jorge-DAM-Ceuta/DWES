<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 4</title>
    </head>
    <body>
        <h1>Conversor de Unidades</h1>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <p>
                <label for="valor">Valor:</label>
                <input type="number" name="valor">
            </p>

            <p>
                <label>Unidad:</label>
                <select name="primeraUnidad">
                    <option value="Byte">Byte</option>
                    <option value="KB">KB</option>
                    <option value="MB">MB</option>
                    <option value="GB">GB</option>
                    <option value="TB">TB</option>
                </select>
            </p>

            <p>
                <label>Unidad a convertir:</label>
                <select name="segundaUnidad">
                    <option value="Byte">Byte</option>
                    <option value="KB">KB</option>
                    <option value="MB">MB</option>
                    <option value="GB">GB</option>
                    <option value="TB">TB</option>
                </select>
            </p>

            <input type="submit" name="convertir" value="Convertir">
        </form>

        <?php
            /*En este código se obtiene el valor introducido en el input y las unidades de
            conversión que se usarán en la operación. Tenemos un array con las unidades y sus
            valores. En la operación para obtener el resultado se divide el valor de la primera
            unidad con el de la segunda y se multiplica por el valor intoducido para mostrarlo.*/

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['convertir'])) {
                $valor = $_POST["valor"];
                $primeraUnidad = $_POST["primeraUnidad"];
                $segundaUnidad = $_POST["segundaUnidad"];

                $unidad = [
                    "Byte" => 1,
                    "KB" => 1024,
                    "MB" => 1024 * 1024,
                    "GB" => 1024 * 1024 * 1024,
                    "TB" => 1024 * 1024 * 1024 * 1024,
                ];

                $resultado = $valor * ($unidad[$primeraUnidad] / $unidad[$segundaUnidad]);

                echo "<h2>$valor $primeraUnidad son: $resultado $segundaUnidad</h2>";
            }
        ?>
    </body>
</html>