<?php
    include_once("./Funciones.inc.php");
    $productos = decodificarJSON();

    function mostrarFormularioEdicion($nombreProducto) {
        echo "<form method='POST' enctype='multipart/form-data'>";
        echo "Nombre: <input type='text' name='nombre' value='$nombreProducto' required><br>";
        echo "Descripción: <input type='text' name='descripcion' value=''><br>";
        echo "Precio: <input type='text' name='precio' value=''><br>";

        echo "Cambiar imagen: <input type='file' name='imagen'><br>";

        echo "<input type='submit' name='editar' value='Editar información'>";
        echo "</form>";
    }

    if (isset($_POST["editar"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
            $nombreProducto = $_POST['nombre'];

            $productoEncontrado = null;

            foreach($productos as $key => $producto) {
                if($producto['nombre'] == $nombreProducto) {
                    $productoEncontrado = $key;
                    break;
                }
            }

            if(isset($_POST['descripcion'])) {
                $productos[$productoEncontrado]['descripcion'] = $_POST['descripcion'];
            }

            if(isset($_POST['precio'])) {
                $productos[$productoEncontrado]['precio'] = $_POST['precio'];
            }

            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $nombreArchivo = $_FILES['imagen']['name'];
                $rutaDestino = "../assets/images/" . $nombreArchivo;

                move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino);

                $productos[$productoEncontrado]['imagen'] = $rutaDestino;
            }

            $jsonString = json_encode($productos, JSON_PRETTY_PRINT);
            file_put_contents("productos.json", $jsonString);

            header("Location: Index.php");
        }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/Style.css">
    <title>Producto</title>
    <style>
        body {
            background-image: url("background.jpg");
            background-size: 100% 200%;
            background-repeat: no-repeat;
            text-align: center;
            margin: 0 auto;
            padding-top: 250px;
        }
    </style>
</head>
    <body>
        <?php
            if(isset($_GET['nombre'])) {
                mostrarDetalles($productos);
            }

            mostrarFormularioEdicion($nombreProducto);
        ?>
    </body>
</html>
