<?php
    include_once("./Funciones.inc.php");

    if(isset($_POST["aniadir"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $nuevoProducto = new Producto($_POST['nombre'], $_POST['descripcion'], $_POST['precio'] . "€");
    
        if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK){
            $nombreArchivo = $_FILES['imagen']['name'];
            $rutaDestino = "../assets/images/" . $nombreArchivo;
    
            if(move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)){
                $nuevoProducto->setImagen($rutaDestino);
            }
        }
    
        insertarProducto($nuevoProducto);
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/InsertarProducto.css">
        <title>Añadir producto</title>
    </head>
    <body>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='POST' enctype='multipart/form-data'>
            <a href='Index.php'>Volver</a>
            
            <label class="nombre">Nombre: <input type='text' name='nombre' required></label>
            
            <br/>
            
            <label class="descripcion">Descripción: <input type='text' name='descripcion' required></label>
            
            <br/>
            
            <label class="precio">Precio: <input type='number' step='0.01' name='precio' required></label>
            
            <br/>

            <label>Imagen: <input type='file' name='imagen' required></label>
            
            <br/>

            <input type='submit' name='aniadir' value='Añadir producto'>
        </form>
    </body>
</html>