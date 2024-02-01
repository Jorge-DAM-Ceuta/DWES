<?php
    include_once("./Funciones.inc.php");
    
    $nombreProducto = isset($_GET['nombre']) ? $_GET['nombre']: "";

    //Obtenemos el array de objetos Producto.
    $productos = obtenerProductos();

    if(isset($_GET['nombre'])){
        //Mostramos los detalles y obtenemos el producto por su nombre.
        $producto = mostrarDetalles($productos);
    } 

    /*Además de comprobar si se ha enviado el formulario comprobamos si los valores de los input contienen algo, 
    en ese caso se setea el valor correspondiente al objeto. En caso contrario mantendrá el valor que ya tiene.*/
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

        //Se sube la imagen a la ruta determinada y si el proceso es correcto seteamos el valor con la ruta de la imagen.
        if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK){
            $nombreArchivo = $_FILES['imagen']['name'];
            $rutaDestino = "../assets/images/" . $nombreArchivo;

            if(move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)){
                $producto->setImagen($rutaDestino);
            }
        }

        editarProducto($nombreProducto, $producto);
    }

    include_once("../templates/EditarProductoForm.inc.php");
?>