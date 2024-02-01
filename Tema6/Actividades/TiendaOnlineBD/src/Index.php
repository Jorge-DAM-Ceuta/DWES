<?php
    include_once("./Funciones.inc.php");
    
    session_start();

    if (!isset($_SESSION['usuario']) || !$_SESSION['usuario']) {
        header("Location: Iniciar_sesion.php");
        exit();
    }

    $rolUsuario = isset($_SESSION['usuario']['role']) ? $_SESSION['usuario']['role'] : '';

    $productos = obtenerProductos();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!--/*Estilos para clientes*/-->
        <?php if($rolUsuario !== 'Admin'){ ?>
            <link rel="stylesheet" href="../assets/css/IndexCliente.css">
        <?php }else{ ?>
            <link rel="stylesheet" href="../assets/css/IndexAdministrador.css">
        <?php } ?>
        
        <title>Tienda Online</title>
    </head>
    <body>
        <!-- Se muestra la vista para clientes. -->
        <?php if($rolUsuario !== 'Admin'){ ?>
            <nav class="menu">
                <h1>Videojuegos</h1>

                <ul>
                    <li><a href="Cerrar_sesion.php">Cerrar sesión</a></li>
                </ul>    
            </nav>

            <div class="carrito" style="height: 190vh;">
                <h2>Carrito de Compra</h2>
                <?php mostrarCarrito($productos); ?>
            </div>
        
            <!-- Se muestran los productos -->
            <h1>Videojuegos <a class="botonCerrarSesion" href="Cerrar_sesion.php">Cerrar sesión</a></h1>
            <?php mostrarProductosClientes($productos); ?>

        <?php }else{ ?>
            <nav class="menu">
                <h1>Videojuegos</h1>

                <ul>
                    <li><a href="Cerrar_sesion.php">Cerrar sesión</a></li>
                    <li><a href="InsertarProducto.php">Añadir producto</a></li>
                </ul>
            </nav>

            <?php mostrarProductosAdmin($productos); ?>
        <?php }?>
    </body>
</html>

