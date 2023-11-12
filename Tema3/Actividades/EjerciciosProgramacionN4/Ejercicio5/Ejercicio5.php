<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 5</title>
    </head>
    <body>
        <h1>Conversor de Unidades</h1>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <p>
                <label for="valor">Valor:</label>
                <input type="text" name="numero">
            </p>

            <p>
                <label>Tipo de número:</label>
                <select name="tipoNumero1">
                <option value="Decimal">Decimal</option>
                    <option value="Binario">Binario</option>
                    <option value="Octal">Octal</option>
                    <option value="Hexadecimal">Hexadecimal</option>
                    <option value="Romano">Romano</option>
                </select>
            </p>

            <p>
                <label>Tipo para converir a convertir:</label>
                <select name="tipoNumero2">
                <option value="Decimal">Decimal</option>
                    <option value="Binario">Binario</option>
                    <option value="Octal">Octal</option>
                    <option value="Hexadecimal">Hexadecimal</option>
                    <option value="Romano">Romano</option>
                </select>
            </p>

            <input type="submit" name="convertir" value="Convertir">
        </form>

        <?php
            /*Este código usa las funciones del archivo .inc de conversión de valores para realizar 
            las conversiones. Para las conversiones de números no decimales primero se convierte el 
            determinado número a decimal y luego se convierte a la unidad seleccionada.*/

            include_once "./Ejercicio5.inc.php";

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['convertir'])) {
                $numero = $_POST['numero'];
                $tipoNumero1 = $_POST['tipoNumero1'];
                $tipoNumero2 = $_POST['tipoNumero2'];

                switch ($tipoNumero1) {
                    case 'Decimal':
                        $numero = $numero;
                        break;

                    case 'Binario':
                        $numero = binario_Decimal($numero);
                        break;

                    case 'Octal':
                        $numero = octal_Decimal($numero);
                        break;

                    case 'Hexadecimal':
                        $numero = hexadecimal_Decimal($numero);
                        break;

                    case 'Romano':
                        $numero = romano_Decimal($numero);
                        break;
                        
                    default:
                        $numero = 0;
                }

                switch ($tipoNumero2) {
                    case 'Decimal':
                        $numero = $numero;
                        break;

                    case 'Binario':
                        $numero = decimal_Binario($numero);
                        break;

                    case 'Octal':
                        $numero = decimal_Octal($numero);
                        break;

                    case 'Hexadecimal':
                        $numero = decimal_Hexadecimal($numero);
                        break;

                    case 'Romano':
                        $numero = decimal_Romano($numero);
                        break;

                    default:
                        $numero = 0;
                }

                echo "<h2>Número convertido: $numero</h2>";
            }
        ?>
    </body>
</html>