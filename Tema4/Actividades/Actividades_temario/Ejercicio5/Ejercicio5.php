<?php
    try{
        if(isset($_POST['cambiar'])){
            $lenguaje = $_POST['lenguaje'];
            setcookie('lenguaje', $lenguaje, time() + 60 * 1);
            header("Location: ./Ejercicio5.php");
            exit();
        }

        $lenguajes = array(
            'ES' => ['Bienvenido', './Banderas/es.png', 'yellow'],
            'EN' => ['Welcome', './Banderas/en.png', 'red'],
            'IT' => ['Benvenuto', './Banderas/it.png', 'green'],
            'FR' => ['Bienvenue', './Banderas/fr.png', 'aqua']
        );

        $lenguajeActual = isset($_COOKIE['lenguaje']) ? $_COOKIE['lenguaje'] : 'ES';

        $texto = $lenguajes[$lenguajeActual][0];
        $bandera = $lenguajes[$lenguajeActual][1];
        $color = $lenguajes[$lenguajeActual][2];
    
    }catch(Exception $error){
        echo "No se ha podido cambiar el idioma.";
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 5</title>
    </head>
    <body style="background-color: <?php echo $color; ?>">
        <h1><?php echo $texto; ?></h1>
        <img style="display: inline-block;" src="<?php echo $bandera; ?>" width="50px">
        
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <select name="lenguaje">
                <option value="ES">Español</option>
                <option value="EN">Inglés</option>
                <option value="IT">Italiano</option>
                <option value="FR">Francés</option>
            </select>

            <input type="submit" name="cambiar" value="Cambiar">
        </form>
    </body>
</html>
