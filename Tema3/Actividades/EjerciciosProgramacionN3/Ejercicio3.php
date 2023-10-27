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
            if(isset($_POST["calcular"])){
                $precio = $_POST["precio"];
                $tipoCliente = $_POST["cliente"];

                $descuento = 0;

                /*Después de recoger los datos obtenidos del formulario se empiezan a hacer
                las operaciones requeridas sobre el valor del precio. 
                
                Se comprueba el tipo de cliente, si es empresario se le hace un 15% de descuento
                multiplicando el valor del precio por 0.15, en otro caso se aplicará un 20%*/

                if($tipoCliente == "empresario"){
                    $descuentoAplicado = $precio * 0.15;
                }else{
                    $descuentoAplicado = $precio * 0.20;
                }

                /*Si el valor del descuento es mayor que el límite se quedará el valor máximo,
                en este caso 25, en otro caso el valor será el mismo obtenido. */
                if($descuentoAplicado > 25){
                    $descuento = 25;
                }else{
                    $descuento = $descuentoAplicado;
                }

                /*Se calcula el IVA del producto con el descuento aplicado*/
                $calculoIVA = ($precio - $descuento) * 0.21;

                /*Se calcula el precio final obtenido del producto con el descuento aplicado 
                sumado al IVA del producto también con el descuento aplicado */
                $precioFinal = ($precio - $descuento) + $calculoIVA;

                /*Se pinta una tabla HTML con los valores siguintes: */
                echo "<table border='1'>";

                echo "<tr><td>Precio del producto</td><td>" . $precio . "</td></tr>";
                echo "<tr><td>Descuento aplicado</td><td>" . $descuentoAplicado . "</td></tr>";
                echo "<tr><td>Descuento final</td><td>" . $descuento . "</td></tr>";
                echo "<tr><td>Cálculo del IVA</td><td>" . $calculoIVA . "</td></tr>";
                echo "<tr><td>Precio final</td><td>" . $precioFinal . "</td></tr>";
            }

            
        ?>

    </body>
</html>