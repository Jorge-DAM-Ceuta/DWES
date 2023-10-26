<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 2</title>
    </head>
    <body>
        <?php
            $array = array();

            for( $i = 1; $i < 6; $i++ ){
                array_push($array, random_int(100, 999));
                echo "<p>" . $array[$i] . "</p>";
                for( $j = 1; $j < 9; $j++ ){
                    array_push($array, array(random_int(100, 999)));
                    echo "<p>" . $array[$j] . "</p>";
                }
            }
        ?>
    </body>
</html>