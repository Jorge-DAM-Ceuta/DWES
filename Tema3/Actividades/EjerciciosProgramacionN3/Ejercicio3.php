<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 3</title>
    </head>
    <body>
        <h1>Cálculo precio final de producto</h1>
        
        <form name="form" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
            
            <p>
                <label>Precio del producto:</label>
                <input name="precio" type="number">
            </p>

            <p>
                <label>Tipo de cliente:</label>
                <input name="cliente" value="empresario" type="radio">Cliente de la empresa</input> 
                <input name="cliente" value="preferente" type="radio">Cliente preferente</input>
            </p>
    
            <input type="submit" name="calcular" value="Calcular">
        </form>

        <?php
            $precio = 0.0;
            $descuentoAplicado = 0;
            $descuento = 0; 
            $calculoIVA = 0;
            $precioFinal = 0;

            if(isset($_POST["calcular"])){
                $precio = $_POST["precio"];
                $tipoCliente = $_POST["cliente"];

                $descuento = 0;

                if($tipoCliente == "empresario"){
                    $descuentoAplicado = $precio * 0.15;
                }else{
                    $descuentoAplicado = $precio * (0.15 + 0.05);
                }

                if($descuentoAplicado > 25){
                    $descuento = 25;
                }else{
                    $descuento = $descuentoAplicado;
                }

                $calculoIVA = ($precio - $descuento) * 0.21;

                $precioFinal = ($precio - $descuento) + $calculoIVA;
            }

            echo "<table border='1'>";

            echo "<tr><td>Precio del producto</td><td>" . $precio . "</td></tr>";
            echo "<tr><td>Descuento aplicado</td><td>" . $descuentoAplicado . "</td></tr>";
            echo "<tr><td>Descuento final</td><td>" . $descuento . "</td></tr>";
            echo "<tr><td>Cálculo del IVA</td><td>" . $calculoIVA . "</td></tr>";
            echo "<tr><td>Precio final</td><td>" . $precioFinal . "</td></tr>";
        ?>

    </body>
</html>