<?php
    include_once("./Clases/Producto.php");

    $nombreProducto = isset($_GET['nombre']) ? $_GET['nombre'] : "";

    $productos = Producto::obtenerProductos();

    if(isset($_GET['nombre'])){
        $producto = Producto::mostrarDetallesEditar($productos);
    }

    if(isset($_POST["editar"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        if(!empty($_POST['nombre'])){
            $producto->setNombre($_POST['nombre']);
        }

        if (!empty($_POST['descripcion'])){
            $producto->setDescripcion($_POST['descripcion']);
        }

        if(!empty($_POST['precio'])){
            $producto->setPrecio($_POST['precio'] . "€");
        }

        if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK){
            $check = getimagesize($_FILES["imagen"]["tmp_name"]);

            if($check !== false){
                $image = $_FILES['imagen']['tmp_name'];
                $imgContent = addslashes(file_get_contents($image));

                $producto->setImagen($imgContent);
            }
        }

        Producto::editarProducto($nombreProducto, $producto);
    }

    include_once("Templates/EditarProductoForm.inc.php");
