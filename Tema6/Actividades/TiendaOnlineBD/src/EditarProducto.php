<?php
    include_once("./Funciones.inc.php");
    
    $nombreProducto = isset($_GET['nombre']) ? $_GET['nombre']: "";

    //Obtenemos el array de objetos Producto.
    $productos = obtenerProductos();

    if(isset($_GET['nombre'])){
        //Mostramos los detalles y obtenemos el producto por su nombre.
        $producto = mostrarDetalles($productos);
    } 

    if(isset($_POST["editar"]) && $_SERVER["REQUEST_METHOD"] == "POST"){

        if(isset($_POST['nombre'])){
            $producto->setNombre($_POST['nombre']);
        }

        if(isset($_POST['descripcion'])){
            $producto->setDescripcion($_POST['descripcion']);
        }

        if(isset($_POST['precio'])){
            $producto->setPrecio($_POST['precio'] . "€");
        }

        if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK){
            $nombreArchivo = $_FILES['imagen']['name'];
            $rutaDestino = "../assets/images/" . $nombreArchivo;

            if(move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)){
                $producto->setImagen($rutaDestino);
            }
        }

        editarProducto($nombreProducto, $producto);
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/EditarProducto.css">
        <title>Editar producto</title>
    </head>
    <body>
        <form action="" method='POST' enctype='multipart/form-data'>
            <label class="nombre">Nombre: <input type='text' name='nombre' value='<?php echo $nombreProducto; ?>'></label>
            
            <br/>
            
            <label class="descripcion">Descripción: <input type='text' name='descripcion' value='<?php echo $producto->getDescripcion(); ?>'></label>
            
            <br/>
            
            <label class="precio">Precio: <input type='number' step='0.01' name='precio' value='<?php echo (float)$producto->getPrecio(); ?>'></label>
            
            <br/>

            <label>Cambiar imagen: <input type='file' name='imagen'></label>
            
            <br/>

            <input type='submit' name='editar' value='Editar información'>
        </form>
    </body>
</html>
