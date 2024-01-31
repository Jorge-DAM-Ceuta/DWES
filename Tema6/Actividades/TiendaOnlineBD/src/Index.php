<?php
    include_once("./Funciones.inc.php");
    
    session_start();

    if (!isset($_SESSION['usuario']) || !$_SESSION['usuario']) {
        header("Location: Iniciar_sesion.php");
        exit();
    }

    $rolUsuario = isset($_SESSION['usuario']['role']) ? $_SESSION['usuario']['role'] : '';

    $productos = decodificarJSON();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/Style.css">
        <title>Tienda Online</title>

        <style>
            body{
                background-image: url("background.jpg");
                background-size: 100% 100%;
                background-repeat: no-repeat;
            }

            /*Estilos para administrador*/
            h1{
                text-align: center; 
                margin-left: 30vw; 
                padding-top: 1vh;

                & a{
                    display: inline-block;
                    padding: 5px 10px;
                    border: 1px solid #000000;
                    border-radius: 5px;
                    text-decoration-line: none;
                    color: white;
                    background-color: rgb(255, 97, 97);
                    margin-left: 40vw;
                    font-size: 0.65em;
                }

                & .aniadirProducto{
                    margin-top: 2vh;
                    margin-left: 49vw;
                }
            }

            .producto{
                display: inline-block;
                width: 20vw;
                padding: 61px;
                text-align: center;
                margin-right: 20px;
                margin-bottom: 20px;
                vertical-align: top;
                font-size: 16px;
            }
            
            /*Estilos para clientes*/
            <?php if($rolUsuario !== 'Admin'){ ?>
                h1{
                    text-align: center; 
                    margin-left: 15vw; 
                    padding-top: 1vh;

                    & a{
                        padding: 5px 10px;
                        border: 1px solid #000000;
                        border-radius: 5px;
                        text-decoration-line: none;
                        color: white;
                        background-color: rgb(255, 97, 97);
                        margin-left: 16vw;
                        font-size: 0.65em;
                    }
                }

                .producto{
                    display: inline-block;
                    width: 15vw;
                    padding: 70px;
                    text-align: center;
                    margin-left: 15px;
                    margin-bottom: 20px;
                    vertical-align: top;
                    font-size: 16px;
                }
            <?php } ?>
        </style>
    </head>
    <body>
        <!-- Se muestra la vista para clientes. -->
        <?php if($rolUsuario !== 'Admin'){ ?>
            <div class="carrito" style="height: 190vh;">
                <h2>Carrito de Compra</h2>
                <?php mostrarCarrito($productos); ?>
            </div>
        
            <!-- Se muestran los productos -->
            <h1>Videojuegos <a class="botonCerrarSesion" href="Cerrar_sesion.php">Cerrar sesión</a></h1>
            <?php mostrarProductosClientes($productos); ?>

        <?php }else{ ?>
            <h1>Videojuegos <a href="Cerrar_sesion.php">Cerrar sesión</a> <br/> <a class="aniadirProducto" href="Aniadir_producto.php">Añadir producto</a></h1>
            <?php mostrarProductosAdmin($productos); ?>
        <?php }?>
    </body>
</html>

