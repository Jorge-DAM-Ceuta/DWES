<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>La Espiral</title>
    </head>
    <body>

        <form name="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <p>
                <label>Introduce la longitud de la espiral: </label>
                <input type="number" name="longitud">
            </p>
            
            <input type="submit" name="generar" value="Generar">
        </form>

        <?php
            $caracteres = array('═', '║', '╗', '╔', '╝', '╚');

            if(isset($_POST['generar'])) {
                echo "<p>";
                for($i = 0; $i < $_POST['longitud']; $i++){
                    for($j = 0; $j < $_POST['longitud']; $j++){
                        
                        if($j != $_POST['longitud'] - 1 && $i == 0){
                            echo '═';

                        }else if($j == $_POST['longitud'] - 1 && $i == 0){
                            echo '╗';

                        }
                    }   
                }
                echo "</p>";

                echo "<p>";
                for($i = 0; $i < $_POST['longitud']; $i++){
                    for($j = 0; $j < $_POST['longitud']; $j++){
                        
                        if($j != $_POST['longitud'] - 1 && $i == 0){
                            echo '═';

                        }else if($j == $_POST['longitud'] - 1 && $i == 0){
                            echo '╗';

                        }
                    }   
                }
                echo "</p>";


            }
        ?>
    </body>
</html>