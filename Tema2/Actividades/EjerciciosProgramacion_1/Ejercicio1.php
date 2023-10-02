<?php 

/* En este bloque de PHP declaramos las variables 
cuyo valor vamos a representar en la tabla HTML */

$primeraPalabraIngles = "Turtle";
$primeraPalabraEspanol = "Tortuga";

$segundaPalabraIngles = "Swimming pool";
$segundaPalabraEspanol = "Piscina";

$terceraPalabraIngles = "Pencil";
$terceraPalabraEspanol = "Lápiz";

$cuartaPalabraIngles = "Language";
$cuartaPalabraEspanol = "Lenguaje";

$quintaPalabraIngles = "Edit";
$quintaPalabraEspanol = "Editar";

$sextaPalabraIngles = "Picture";
$sextaPalabraEspanol = "Dibujo";

$septimaPalabraIngles = "Videogame";
$septimaPalabraEspanol = "Videojuego";

$octavaPalabraIngles = "Train";
$octavaPalabraEspanol = "Entrenar";

$novenaPalabraIngles = "Run";
$novenaPalabraEspanol = "Correr";

$decimaPalabraIngles = "Try";
$decimaPalabraEspanol = "Probar";

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 1</title>
    </head>
    <body>
        <!-- Aquí se crea una tabla HTML mediante las etiquetas
        <table> para la tabla acompañado del atributo border para delimitar,
        <th> para los títulos, <tr> para las columnas y <td> para las filas. 
        
        Dentro de cada fila usamos etiquetas de apertura PHP para usar
        el método echo y mostrar los valores de las variables en las filas. -->
        <table border="3">
            <tr>
                <th>Inglés</th>
                <th>Español</th>
            </tr>
            <tr>
                <td><?php echo $primeraPalabraIngles?></td>
                <td><?php echo $primeraPalabraEspanol?></td>
            </tr>
            <tr>
                <td><?php echo $segundaPalabraIngles?></td>
                <td><?php echo $segundaPalabraEspanol?></td>
            </tr>
            <tr>
                <td><?php echo $terceraPalabraIngles?></td>
                <td><?php echo $terceraPalabraEspanol?></td>
            </tr>
            <tr>
                <td><?php echo $cuartaPalabraIngles?></td>
                <td><?php echo $cuartaPalabraEspanol?></td>
            </tr>
            <tr>
                <td><?php echo $quintaPalabraIngles?></td>
                <td><?php echo $quintaPalabraEspanol?></td>
            </tr>
            <tr>
                <td><?php echo $sextaPalabraIngles?></td>
                <td><?php echo $sextaPalabraEspanol?></td>
            </tr>
            <tr>
                <td><?php echo $septimaPalabraIngles?></td>
                <td><?php echo $septimaPalabraEspanol?></td>
            </tr>
            <tr>
                <td><?php echo $octavaPalabraIngles?></td>
                <td><?php echo $octavaPalabraEspanol?></td>
            </tr>
            <tr>
                <td><?php echo $novenaPalabraIngles?></td>
                <td><?php echo $novenaPalabraEspanol?></td>
            </tr>
            <tr>
                <td><?php echo $decimaPalabraIngles?></td>
                <td><?php echo $decimaPalabraEspanol?></td>
            </tr>

        </table>
    </body>
</html>