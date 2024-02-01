<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Eliminar del carrito</title>
    </head>
    <body>
        <?php
            //Se comprueba que se haya obtenido el nombre del producto por GET
            if(isset($_GET['nombre'])) {
                $nombreProducto = $_GET['nombre'];
                /*Se verifica que la cookie carrito exista y se decodifica en un array 
                llamado carrito, en caso contrario lo inicializa como un nuevo array.*/
                $carrito = isset($_COOKIE['carrito']) ? json_decode($_COOKIE['carrito'], true) : array();
            
                //Se comprueba que el producto esté en el carrito.
                if(isset($carrito[$nombreProducto])) {
                    //Si su cantidad es mayor a 0 se quita uno a la cantidad.
                    if($carrito[$nombreProducto]['cantidad'] > 0){
                        $carrito[$nombreProducto]['cantidad'] -= 1;
                    }
                
                    //Si la cantidad llega a cero se elimina el producto del carrito.
                    if($carrito[$nombreProducto]['cantidad'] == 0){
                        unset($carrito[$nombreProducto]);
                    }
                }
            
                //Se codifica el array a formato json y se setea la cookie con los valores.
                $carritoJson = json_encode($carrito);
                setcookie('carrito', $carritoJson, time() + 100000 * 60);
            
                //Redirige a la pestaña principal.
                header("Location: ./Index.php");
                exit();
            }
        ?>
    </body>
</html>