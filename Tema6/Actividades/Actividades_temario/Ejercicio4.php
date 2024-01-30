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

    //INSERTAR DATOS
    function insertarDatos($dwes){
        $resultado = $dwes->query("INSERT ");

        if($resultado == true){
            print "<p>Se han insertado $dwes->affected_rows registros.</p>";
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

     
        //Cerrar conexión
        $dwes->close();
    }
?>