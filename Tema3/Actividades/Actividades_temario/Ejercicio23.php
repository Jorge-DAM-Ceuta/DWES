<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 23</title>
    </head>
    <body>
        <h1>Convertir Frases</h1>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <p>
                <label>Introduce tu frase:</label>
                <input type="text" name="frase" required>
            </p>
            
            <p>
                <label>Selecciona el tipo de conversión:</label>
                <select name="tipo">
                    <option value="pregunta">Convertir a pregunta (¿?)</option>
                    <option value="enfasis">Convertir a frase con énfasis (¡!)</option>
                </select>
            </p>

            <input type="submit" name="convertir" value="Convertir">
        </form>
    </body>
</html>

<?php

    if(isset($_POST['convertir']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
        $frase = $_POST['frase'] ?? '';
        $tipo = $_POST['tipo'] ?? '';

        function convertirAPregunta(string $frase):string{
            return "¿$frase?";
        };
    
        function convertirAEnfasis(string $frase):string{
            return "¡$frase!";
        };

        function convertir(string $frase, callable $callback):string{
            return $callback($frase);
        }

        if($_POST["tipo"] == "pregunta"){
            $resultado = convertir($_POST['frase'], 'convertirAPregunta');
        }else{
            $resultado = convertir($_POST['frase'], 'convertirAEnfasis');
        }

        echo "<h2>Resultado: $resultado</h2>";
    }

?>