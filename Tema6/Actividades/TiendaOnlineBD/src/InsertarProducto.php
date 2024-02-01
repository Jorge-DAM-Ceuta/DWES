<?php
    include_once("./Funciones.inc.php");

    //Si se pulsa el botón añadir:
    if(isset($_POST["aniadir"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        //Se crea un nuevo producto con los datos del formulario, todos son required.
        $nuevoProducto = new Producto($_POST['nombre'], $_POST['descripcion'], $_POST['precio'] . "€");
    
        //Se sube la imagen a la ruta determinada.
        if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK){
            $nombreArchivo = $_FILES['imagen']['name'];
            $rutaDestino = "../assets/images/" . $nombreArchivo;
    
            //Si se ha realizado la subida correctamente se setea el atributo imagen con la ruta de la imagen.
            if(move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)){
                $nuevoProducto->setImagen($rutaDestino);
            }
        }
    
        //Se inserta el nuevo producto en la base de datos.
        insertarProducto($nuevoProducto);
    }

    include_once("../templates/InsertarProductoForm.inc.php");
?>