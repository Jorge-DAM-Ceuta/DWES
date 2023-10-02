<?php

/* En esta variante del ejercicio 1 se almacenan las palabras en arrays, 
en vez de cada una en una variable. */
$palabrasIngles = ["Turtle", "Swimming pool", "Pencil", "Language", "Edit", "Picture", "Videgame", "Train", "Run", "Try"];
$palabrasEspanol = ["Tortuga", "Piscina", "Lápiz", "Lenguaje", "Editar", "Dibujo", "Videojuego", "Entrenar", "Correr", "Probar"];

?>

<!DOCTYPE html>
<html lang = "es">
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio1.2</title>
    </head>
    <body>

        <!-- Aquí se crea una tabla con dos cabeceras <th> para los títulos
        y mediante un bucle for en un bloque PHP creamos una columna con dos 
        filas en cada vuelta para mostrar cada elemento del array correspondiente. -->
        <table border="3">
            <tr>
                <th>Inglés</th>
                <th>Español</th>
            </tr>

            <?php
                for($i = 0; $i<10; $i++){
                    echo "<tr><td>$palabrasIngles[$i]</td>";
                    echo "<td>$palabrasEspanol[$i]</td></tr>";
                }
            ?>

        </table>
    </body>
</html>