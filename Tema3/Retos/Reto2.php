<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reto 2</title>
    </head>
    <body>
        <?php
            $numero = "";

            if(isset($_POST['enviar'])) {
                $numero = $_POST['number'];
    
                for($i = 0; $i < count($numero); $i++) {
                    if($numero[$i] % 3 == 0 && $numero[$i] % 5 == 0){
                        print "<p color='green'>" . $numero[$i] . "</p>";
                    }else if($numero[$i] % 3 == 0){
                        print "<p color='yellow'>" . $numero[$i] . "</p>";
                    }else if($numero[$i] % 5 == 0){
                        print "<p color='red'>" . $numero[$i] . "</p>";
                    }
                }
              
            }else { 
                
            ?>    
         
            <form name="input" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    <p>
                        <label>Introduce un número: </label>
                        <input type="number" name="numero"/>
                    </p> 

                    <input type="submit" value="Enviar" name="enviar"/>
                </form>

            
            <!-- Este bloque PHP se usa para cerrar la llave del bloque else. -->
            <?php
            } ?>
    </body>
</html>