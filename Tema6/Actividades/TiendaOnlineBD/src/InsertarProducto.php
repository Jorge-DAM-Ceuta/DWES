<?php
    include_once("./Funciones.inc.php");

    //Si se pulsa el botón añadir:
    if(isset($_POST["aniadir"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        //Se crea un nuevo producto con los datos del formulario, todos son required.
        $nuevoProducto = new Producto($_POST['nombre'], $_POST['descripcion'], $_POST['precio'] . "€");
    
        //Se obtiene el contenido de la imagen y se almacena en el objeto $producto.
        if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK){
            $check = getimagesize($_FILES["imagen"]["tmp_name"]);
            
            if($check !== false){
                $image = $_FILES['imagen']['tmp_name'];
                $imgContent = addslashes(file_get_contents($image));

                //Se añade el contenido de la imagen al producto.
                $nuevoProducto->setImagen($imgContent);
            }
        }
    
        //Se inserta la imagen en la base de datos; esta función también llama a la función insertarProducto.
        insertarImagen($nuevoProducto);
    }

    include_once("../templates/InsertarProductoForm.inc.php");
?>