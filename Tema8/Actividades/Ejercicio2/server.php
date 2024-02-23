<?php
    try{
        $conn = new mysqli("localhost", "root", "", "localizaciones");

        // Si la conexión falla detenemos la ejecución.
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);

        }else{
            // Obtenemos las provincias de la tabla provincias.
            $consultaProvincias = "SELECT * FROM provincias";
            $provincias = $conn->query($consultaProvincias);

            // Guardaremos las provincias en este array.
            $arrayProvincias = array();

            // Si de la consulta se obtiene al menos una fila, recorremos las filas y las añadimos al array.
            if($provincias->num_rows > 0){
                while($filaProvincia = $provincias->fetch_assoc()){
                    array_push($arrayProvincias, $filaProvincia);
                }
            }

            // Obtenemos los municipios de la tabla municipios.
            $consultaMunicipios = "SELECT * FROM municipios";
            $municipios = $conn->query($consultaMunicipios);

            // Guardaremos los municipios en este array.
            $arrayMunicipios = array();

            // Si de la consulta se obtiene al menos una fila, recorremos las filas y las añadimos al array.
            if($municipios->num_rows > 0){
                while($filaMunicipios = $municipios->fetch_assoc()){
                    array_push($arrayMunicipios, $filaMunicipios);
                }
            }

            $conn->close();

            // Con echo y json_encode conseguimos "devolver" los resultados en formato JSON para la petición AJAX.
            echo json_encode(array('provincias' => $arrayProvincias, 'municipios' => $arrayMunicipios));
        }
        
    }catch(Exception $error){
        echo json_encode(array('error' => $error->getMessage()));
    }
?>
