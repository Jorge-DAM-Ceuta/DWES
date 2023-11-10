<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 12</title>
    </head>
    <body>
        <form name="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <p>
                <label for="numeroEmails">Número de emails a enviar: </label>
                <input name="numeroEmails" id="numeroEmails" type="number" required> 
                <?php 
                    if(isset($_POST['enviar']) && empty($_POST['numeroEmails'])){
                        echo "<span style='color:red'>--&lt; Selecciona un número de emails a enviar!!</span>";
                    }
                ?>
            </p>
            
            <p>
                <label for="seguroMensajeria"><input name="seguroMensajeria" id="seguroMensajeria" type="checkbox" value="Activo">Seguro de mensajería (0.1€ por email)</label>
            </p>

            <p>
                <input name="enviar" id="enviar" type="submit" value="Enviar">
            </p>
        </form>
        
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['enviar'])){
                if(filter_var($_POST['numeroEmails'], FILTER_VALIDATE_INT)) {
                    $numeroEmails = $_POST['numeroEmails'];

                    if(!empty($_POST['seguroMensajeria'])){
                        $seguro = $_POST['seguroMensajeria'];
                    }else{
                        $seguro = '';
                    }
                    
                    $importeTotal = 0;

                    if(is_numeric($numeroEmails) && $seguro == 'Activo'){

                        if($numeroEmails >= 0 && $numeroEmails <= 2000){
                            for($i = 0; $i < $numeroEmails; $i++){
                                $importeTotal += 0.1;
                            }

                        }else if($numeroEmails >= 2001 && $numeroEmails <= 10000){
                            for($i = 0; $i < $numeroEmails; $i++){
                                $importeTotal += 0.7 + 0.1;
                            }

                        }else if($numeroEmails >= 10001){
                            for($i = 0; $i < $numeroEmails; $i++){
                                $importeTotal += 0.2 + 0.1;
                            }
                        }

                    }else if(is_numeric($numeroEmails)){

                        if($numeroEmails >= 0 && $numeroEmails <= 2000){
                            $importeTotal = 0;

                        }else if($numeroEmails >= 2001 && $numeroEmails <= 10000){
                            for($i = 0; $i < $numeroEmails; $i++){
                                $importeTotal += 0.7;
                            }

                        }else if($numeroEmails >= 10001){
                            for($i = 0; $i < $numeroEmails; $i++){
                                $importeTotal += 0.2;
                            }
                        }
                    }

                    echo "<h3>Tu importe a pagar por enviar " . $numeroEmails . " emails es de " . $importeTotal . "€</h3>";
                }
            }
        ?> 
    </body>
</html>