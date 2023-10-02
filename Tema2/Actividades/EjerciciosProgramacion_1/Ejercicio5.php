<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Pirámide de asteriscos</title>
    </head>
    <body>

        <!-- Mediante el uso del valor ASCII &nbsp que muestra un 
        espacio en blanco, y el método echo dentro de un párrafo 
        conseguimos espaciar el caracter * para formar una pirámide de 
        9 caracteres con los * -->
        <p><?php echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp * "; ?></p>
        <p><?php echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp * &nbsp&nbsp&nbsp&nbsp *  " ?></p>
        <p><?php echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp * &nbsp&nbsp&nbsp * &nbsp&nbsp&nbsp * "; ?></p>
        <p><?php echo "&nbsp&nbsp&nbsp * &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp * &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp *"; ?></p>
    </body>
</html>