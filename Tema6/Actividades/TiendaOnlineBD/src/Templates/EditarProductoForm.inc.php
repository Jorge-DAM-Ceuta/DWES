<?php

echo "<!DOCTYPE html>
        <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <link rel='stylesheet' href='../assets/css/EditarProducto.css'>
                <title>Editar producto</title>
            </head>
            <body>
                <form action='' method='POST' enctype='multipart/form-data'>
                    
                    <label class='nombre'>Nombre: <input type='text' name='nombre' value='" . $nombreProducto . "'></label>
                    
                    <br/>
                    
                    <label class='descripcion'>Descripción: <input type='text' name='descripcion' value='" . $producto->getDescripcion() . "'></label>
                    
                    <br/>
                    
                    <label class='precio'>Precio: <input type='number' step='0.01' name='precio' value='" . (float)$producto->getPrecio() . "'></label>
                    
                    <br/>

                    <label>Cambiar imagen: <input type='file' name='imagen' required></label>
                    <h3>Si quieres mantener la imagen debes insertar la que ya está en el producto</h3>
                    
                    <br/>

                    <input type='submit' name='editar' value='Editar información'>
                </form>
            </body>
        </html>"
?>