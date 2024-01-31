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
        <style>
            body {
                background-image: url("background.jpg");
                background-size: 100% 200%;
                background-repeat: no-repeat;
                text-align: center;
                margin: 0 auto;
                padding-top: 250px;
            }

            a{
                position: relative;
                display: inline-block;
                margin-bottom: 2vh;
                margin-right: 19vw;
                padding: 5px 10px;
                background-color: rgb(255, 97, 97);
                color: white;
                border: 1px solid #000000;
                border-radius: 5px;
                text-decoration-line: none; 
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
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='POST' enctype='multipart/form-data'>
            <a href='Index.php'>Volver</a>
            
            <label class="nombre">Nombre: <input type='text' name='nombre' required></label>
            
            <br/>
            
            <label class="descripcion">Descripción: <input type='text' name='descripcion'></label>
            
            <br/>
            
            <label class="precio">Precio: <input type='text' name='precio'></label>
            
            <br/>

            <label>Imagen: <input type='file' name='imagen'></label>
            
            <br/>

            <input type='submit' name='aniadir' value='Añadir producto'>
        </form>
    </body>
</html>