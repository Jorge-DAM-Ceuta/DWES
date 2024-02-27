<?php
    echo "<!DOCTYPE html>
    <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <link rel='stylesheet' href='../assets/css/InsertarProducto.css'>
            <title>Añadir producto</title>
        </head>
        <body>
            <form action='' method='POST' enctype='multipart/form-data'>
                <a href='Index.php'>Volver</a>
                
                <label class='nombre'>Nombre: <input type='text' name='nombre' required></label>
                
                <br/>
                
                <label class='descripcion'>Descripción: <input type='text' name='descripcion' required></label>
                
                <br/>
                
                <label class='precio'>Precio: <input type='number' step='0.01' name='precio' required></label>
                
                <br/>

                <label>Imagen: <input type='file' name='imagen' required></label>
                
                <br/>

                <input type='submit' name='aniadir' value='Añadir producto'>
            </form>
        </body>
    </html>"
?>