<?php 
    $dwes = new mysqli('localhost', 'dwes', '000000', 'dwes');

    //Comprobamos la conexión
    function comprobarConexion($dwes){    
        $numeroError = $dwes->connect_errno;
        $mensajeError = $dwes->connect_error;

        $errores = array(
            $numeroError,
            $mensajeError
        );

        return $errores;
    }

    function editarNumeroUnidadesTienda1($dwes){
        $resultado = $dwes->query("UPDATE stock SET unidades=1 WHERE producto='3DSNG' and tienda=1");

        if($resultado == true){
            print "<p>Se han actualizado $dwes->affected_rows registros sobre unidades del stock en la tienda 1.</p>";
        }else{
            print "<p>No se ha realizado la operación correctamente.</p>";
        }
    }

    function insertarProductoTienda3($dwes){
        $resultado = $dwes->query("INSERT INTO stock (producto, tienda, unidades) VALUES ('3DSNG', 3, 1)");

        if($resultado == true){
            print "<p>Se ha insertado $dwes->affected_rows registros en el stock para la tienda 3.</p>";
        }else{
            print "<p>No se ha realizado la operación correctamente.</p>";
        }
    }

    comprobarConexion($dwes);

    //Si la comprobación devuelve errores se cierra la conexión y se detiene la ejecución del script.
    if(comprobarConexion($dwes)[0] != null || comprobarConexion($dwes)[1] != null){
        echo "<p>Error $numeroError, $mensajeError conectando a la base de datos: $dwes->connect_error</p>";
        
        $dwes->close();
        exit();
    }else{
        //Operaciones CRUD
        editarNumeroUnidadesTienda1($dwes);
        insertarProductoTienda3($dwes);
     
        //Cerrar conexión
        $dwes->close();
    }
?>