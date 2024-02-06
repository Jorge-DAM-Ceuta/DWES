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

        //Se obtiene el contenido de la imagen y se almacena en el objeto $producto.
        if(isset($_FILES['imagen'])){
            $check = getimagesize($_FILES["imagen"]["tmp_name"]);
            
            if($check !== false){
                $image = $_FILES['imagen']['tmp_name'];
                $imgContent = addslashes(file_get_contents($image));

                //Se añade el contenido de la imagen al producto.
                $producto->setImagen($imgContent);
            }
        }

        editarProducto($nombreProducto, $producto);
    }

    include_once("../templates/EditarProductoForm.inc.php");
?>