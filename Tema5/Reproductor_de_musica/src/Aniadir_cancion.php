<?php
    include_once("./Funciones.inc.php");
    $productos = decodificarJSON();

    if(isset($_POST["aniadir"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $nuevoProducto = array(
            "nombre" => $_POST['nombre'],
            "descripcion" => $_POST['descripcion'],
            "precio" => $_POST['precio'],
            "imagen" => ""
        );
    
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
            $nombreArchivo = $_FILES['imagen']['name'];
            $rutaDestino = "../assets/images/" . $nombreArchivo;
    
            move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino);
    
            $nuevoProducto['imagen'] = $rutaDestino;
        }
    
        $productos[] = $nuevoProducto;
    
        $jsonString = json_encode($productos, JSON_PRETTY_PRINT);
        file_put_contents("Productos.json", $jsonString);

        header("Location: Index.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/Style.css">
        <title>Añadir producto</title>
        
    </head>
    <body>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='POST' enctype='multipart/form-data'>
            <a href='Index.php'>Volver</a>
            
            <label>Nombre: <input type='text' name='nombre' required></label>
            
            <br/>
            
            <label>Descripción: <input type='text' name='descripcion'></label>
            
            <br/>
            
            <label>Precio: <input type='text' name='precio'></label>
            
            <br/>

            <label>Imagen: <input type='file' name='imagen'></label>
            
            <br/>

            <input type='submit' name='aniadir' value='Añadir producto'>
        </form>
    </body>
</html>