<?php
    echo "<!DOCTYPE html>
            <html lang='es'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    
                    <!--/*Estilos para clientes*/-->";
                    
                    if($rolUsuario !== 'Admin'){
                        echo "<link rel='stylesheet' href='../assets/css/IndexCliente.css'>";
                    }else{
                        echo "<link rel='stylesheet' href='../assets/css/IndexAdministrador.css'>";
                    }
                    
                    echo "<title>Tienda Online</title>
                </head>
                <body>";
                    
                    if($rolUsuario !== 'Admin'){ 
                        echo "<nav class='menu'>
                            <h1>Videojuegos</h1>

                            <ul>
                                <li><a href='Cerrar_sesion.php'>Cerrar sesión</a></li>
                            </ul>    
                        </nav>

                        <div class='carrito' style='height: 190vh;'>
                            <h2>Carrito de Compra</h2>";
                            Producto::mostrarCarrito($productos);
                        echo "</div>
                    
                        <!-- Se muestran los productos -->
                        <h1>Videojuegos <a class='botonCerrarSesion' href='Cerrar_sesion.php'>Cerrar sesión</a></h1>";
                        Producto::mostrarProductosClientes($productos);

                    }else{
                        echo "<nav class='menu'>
                            <h1>Videojuegos</h1>

                            <ul>
                                <li><a href='Cerrar_sesion.php'>Cerrar sesión</a></li>
                                <li><a href='InsertarProducto.php'>Añadir producto</a></li>
                            </ul>
                        </nav>";

                        Producto::mostrarProductosAdmin($productos);
                    }
                    
                    echo "</body>
            </html>";
?>
