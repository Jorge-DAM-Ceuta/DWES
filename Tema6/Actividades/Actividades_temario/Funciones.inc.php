<?php 
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

    //Si la comprobación devuelve errores se cierra la conexión y se detiene la ejecución del script.
    if(comprobarConexion($dwes)[0] != null || comprobarConexion($dwes)[1] != null){
        echo "<p>Error $numeroError, $mensajeError conectando a la base de datos: $dwes->connect_error</p>";
        
        $dwes->close();
        exit();
    }else{
        //Operaciones CRUD

     
        //Cerrar conexión
        $dwes->close();
    }

    //CONSULTAR DATOS
    function consultarDatos($dwes){
        $resultado = $dwes->query("SELECT * FROM stock;", MYSQLI_USE_RESULT);

        if($resultado == false){
            print "<p>No se han recibido datos.</p>";
        }else{
            $indice = 1;

            foreach($resultado as $fila){
                echo "<p>Fila$indice: $fila</p>";
                $indice++;
            }
        }

        //Liberar los resultados obtenidos en memoria.
        //$resultado->free();
    }

    //INSERTAR DATOS
    function insertarDatos($dwes){
        $resultado = $dwes->query("");

        if($resultado == true){
            print "<p>Se han insertado $dwes->affected_rows registros.</p>";
        }else{
            print "<p>No se ha realizado la operación correctamente.</p>";
        }
    }

    //ELIMINAR DATOS
    function eliminarDatos($dwes){
        $resultado = $dwes->query("DELETE FROM stock WHERE unidades=0;");

        if($resultado == true){
            print "<p>Se han eliminado $dwes->affected_rows registros.</p>";
        }else{
            print "<p>No se ha realizado la operación correctamente.</p>";
        }
    }

    //Cambiar de conexión de base de datos
    //$dwes->select_db("phpmyadmin");


?>