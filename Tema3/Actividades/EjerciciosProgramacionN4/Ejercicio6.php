<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 6</title>
    </head>
    <body>
        <h1>Lenguaje hacker</h1>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <p>
                <label>Ingresa tu texto:</label>
                <textarea name="texto" rows="4" cols="50" required></textarea>
            </p>

            <input type="submit" name="convertir" value="Convertir">
        </form>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['convertir'])) {
                    $texto = $_POST['texto'];
                    $resultado = '';
                    
                    for ($i = 0; $i < strlen($texto); $i++) {
                        $caracter = strtolower($texto[$i]);
                        $nuevoCaracter = obtenerReemplazo(strtolower($caracter));
        
                        $resultado .= $nuevoCaracter;
                        
                    }
            
                    echo "<p>Texto original: $texto</p>";
                    echo "<p>Texto en lenguaje hacker: $resultado</p>";
            }
            
            function obtenerReemplazo($caracter){
                $reemplazos = [
                    'a' => '4',
                    'á' => '4',
                    'b' => 'I3',
                    'c' => '[',
                    'd' => ')',
                    'e' => '3',
                    'é' => '3',
                    'f' => '|=',
                    'g' => '&',
                    'h' => '#',
                    'i' => '1',
                    'í' => '1',
                    'j' => ',_|',
                    'k' => '>|',
                    'l' => '1',
                    'm' => '/\/',
                    'n' => '^/',
                    'ñ' => 'ñ',
                    'o' => '0',
                    'ó' => '0',
                    'p' => '|*',
                    'q' => '(_,)',
                    'r' => 'I2',
                    's' => '5',
                    't' => '7',
                    'u' => '(_)',
                    'ú' => '(_)',
                    'v' => '\/',
                    'w' => '\/\/',
                    'x' => '><',
                    'y' => 'j',
                    'z' => '2'
                ];
            
                return isset($reemplazos[$caracter]) ? $reemplazos[$caracter] : $caracter;
            }
        ?>
    </body>
</html>