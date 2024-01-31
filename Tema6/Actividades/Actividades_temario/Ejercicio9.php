<?php 
    $dwes = new mysqli('localhost', 'dwes', 'abc123.', 'dwes');

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
        realizarTransaccion();

        //Cerrar conexión
        $dwes->close();
    }

    function realizarTransaccion(){
        try{
            $dwes = new PDO("mysql:host=localhost;dbname=dwes", "dwes", "abc123.");
            $dwes->beginTransaction();

            $consultaStock = $dwes->prepare("SELECT tienda, unidades FROM stock WHERE producto = 'PAPYRE62GB'");
            $consultaStock->execute();
            $filaStock = $consultaStock->fetch(PDO::FETCH_ASSOC);       
            
            //Si en esa fila la unidad es mayor que 1.
            if($filaStock && $filaStock['unidades'] > 1){
                //Restamos una unidad a la fila actual.
                $consultaRestarUnidad = $dwes->prepare("UPDATE stock SET unidades = unidades - 1 WHERE producto = 'PAPYRE62GB' AND tienda = :tienda");
                $consultaRestarUnidad->bindParam(':tienda', $filaStock['tienda'], PDO::PARAM_INT);
                $consultaRestarUnidad->execute();
        
                //Insertamos una nueva fila con el producto en la tienda 2 con una unidad.
                $consultaInsertarNuevaFila = $dwes->prepare("INSERT INTO stock (producto, tienda, unidades) VALUES ('PAPYRE62GB', 2, 1)");
                $consultaInsertarNuevaFila->execute();
            }
        
            $dwes->commit();
            echo "<p>Se han repartido las unidades del producto entre las 3 tiendas.</p>";
        }catch (PDOException $e){
            echo "<p>Error: " . $e->getMessage() . "</p>";
        }
    }
?>
