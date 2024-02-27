<?php
    include_once("./Clases/Producto.php");


    if (isset($_POST["aniadir"]) && $_SERVER["REQUEST_METHOD"] == "POST") {

        $nuevoProducto = new Producto($_POST['nombre'], $_POST['descripcion'], $_POST['precio'] . "€");

        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
            $check = getimagesize($_FILES["imagen"]["tmp_name"]);

            if ($check !== false) {
                $image = $_FILES['imagen']['tmp_name'];
                $imgContent = addslashes(file_get_contents($image));


                $nuevoProducto->setImagen($imgContent);
            }
        }

        Producto::insertarImagen($nuevoProducto);
    }

    include_once("Templates/InsertarProductoForm.inc.php");