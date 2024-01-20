<?php
    include_once("./Funciones.inc.php");
    
    $nombreProducto = isset($_GET['nombre']) ? $_GET['nombre']: "";
    $productos = decodificarJSON();
    
    if(isset($_GET['nombre'])){
        $producto = mostrarDetalles($productos);
    }
    
    if (isset($_POST["editar"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
        echo "Formulario enviado correctamente<br>";

        foreach ($productos as &$prod) {
            $productoActual = $prod['nombre'];
    
            if ($productoActual == $nombreProducto) {
                echo "Producto encontrado para edición<br>";
                if (isset($_POST['nombre'])) {
                    $prod['nombre'] = $_POST['nombre'];
                }
    
                if (isset($_POST['descripcion'])) {
                    $prod['descripcion'] = $_POST['descripcion'];
                }
    
                if (isset($_POST['precio'])) {
                    $prod['precio'] = $_POST['precio'];
                }
    
                if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
                    $nombreArchivo = $_FILES['imagen']['name'];
                    $rutaDestino = "../assets/images/" . $nombreArchivo;
    
                    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
                        $prod['imagen'] = $rutaDestino;
                    } else {
                        die("Error al mover la imagen.");
                    }
                }
    
                $jsonString = json_encode($productos, JSON_PRETTY_PRINT);
                file_put_contents("Productos.json", $jsonString);

                header("Location: Index.php");
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/Style.css">
        <title>Editar producto</title>
        <style>
            body {
                background-image: url("background.jpg");
                background-size: 100% 200%;
                background-repeat: no-repeat;
                text-align: center;
                margin: 0 auto;
                padding-top: 250px;
            }

            div{
                margin-top: -20vh;
            }

            form{
                max-width: 400px;
                margin: 20px auto;
                padding: 20px;
                background-color: #f4f4f4;
                border: 1px solid #ccc;
                border-radius: 8px;

                & label{
                    display: block;
                    margin-bottom: 10px;
                }

                & input{
                    width: 100%;
                    padding: 8px;
                    margin-bottom: 10px;
                    box-sizing: border-box;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                }

                & input[type="submit"] {
                    background-color: rgb(255, 97, 97);
                    color: white;
                    border: 1px solid #000000;
                    border-radius: 5px;
                    padding: 10px 15px;
                    cursor: pointer;
                }

                & .nombre {
                    font-weight: bold;
                }

                & .descripcion, .precio {
                    font-style: italic;
                }
            }
        </style>
    </head>
    <body>
        <form action="" method='POST' enctype='multipart/form-data'>
            <label class="nombre">Nombre: <input type='text' name='nombre' value='<?php echo $nombreProducto; ?>' required></label>
            
            <br/>
            
            <label class="descripcion">Descripción: <input type='text' name='descripcion' value='<?php echo $producto['descripcion']; ?>'></label>
            
            <br/>
            
            <label class="precio">Precio: <input type='text' name='precio' value='<?php echo $producto['precio']; ?>'></label>
            
            <br/>

            <label>Cambiar imagen: <input type='file' name='imagen'></label>
            
            <br/>

            <input type='submit' name='editar' value='Editar información'>
        </form>
    </body>
</html>
