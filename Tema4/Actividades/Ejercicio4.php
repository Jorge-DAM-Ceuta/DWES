<?php
    $_COOKIE = 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 4</title>
    </head>
    <body>
    <!-- Delay de 10s -->
        <?php if(!isset($_POST['aceptar'])){ ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

            <dialog open>
                <p>ACEPTAR COOKIES</p>
                <input type='submit' name='aceptar' value='Aceptar'>
                <input type='submit' name='rechazar' value='Rechazar'>
            </dialog>
        </form>
        
        <?php
            }else{
                $_COOKIE['self'] = "";
            }
        ?>
    </body>
</html>