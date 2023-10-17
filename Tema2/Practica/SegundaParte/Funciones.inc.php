<?php

    /*Ejercicio 1*/
    function comprobarDNI($dni){
        $letrasDNI = array("T", "R", "W", "A", "G", "M", "Y", "F", "P", "D", "X", "B", "N", "J", "Z", "S", "Q", "V", "H", "L", "C", "K", "E");
        $splitDNI;

        /*Si en la posición anterior a la letra se encuentra un '-' se divide la cadena 
        con explode. Luego se compara que la posición 1 del array que contiene la letra
        coincida con la letra de la posición que devuelve la operación de dividir los 
        números del DNI entre 23 en el array 'letrasDNI'. */
        if($dni[strlen($dni)-2] == "-"){    
            $splitDNI = explode("-", $dni);

            if($splitDNI[1] == $letrasDNI[($splitDNI[0] % 23)]){
                echo "EL DNI ES VÁLIDO.";
            }else{
                echo "EL DNI NO ES CORRECTO.";
            }
        
        /*En el caso de que no contenga guión se compara que la última posición del DNI sea
        igual a la posición del array 'letrasDNI' obtenida del resto de la operación del 
        número del dni obtenido con substr entre 23. */
        }else{
            if($dni[strlen($dni)-1] == $letrasDNI[(substr($dni, 0, -1) % 23)]){
                echo "EL DNI ES VÁLIDO.";
            }else{
                echo "EL DNI NO ES CORRECTO.";
            }
        }
    }

    /*Ejercicio 4*/
    function listarArrayOrdenado($array){

        /*Mediante un array que contiene nombres de personas se usa el método sort
        para ordenarlo alfabéticamente y con las etiquetas <ol> de lista ordenada y un
        foreach se recorre el array y se escribe cada posición con <li> dentro de la lista.*/
            sort($array);

            echo "<ol>";

            foreach($array as $nombre){
                echo "<li>" . $nombre . "</li>";
            }

            echo "</ol>";
    }

    /*Ejercicio 5*/
    function desplegarProvincias(){
        $comunidadesAutonomas = array(
            "Andalucía" => array("Almería", "Cádiz", "Córdoba", "Granada", "Huelva", "Jaén", "Málaga", "Sevilla"),
            "Aragón" => array("Huesca", "Teruel", "Zaragoza"),
            "Asturias" => array("Oviedo"),
            "Baleares" => array("Palma de Mallorca"),
            "Canarias" => array("Santa Cruz de Tenerife", "Las Palmas de Gran Canaria"),
            "Cantabria" => array("Santander"),
            "Castilla-La Mancha" => array("Albacete", "Ciudad Real", "Cuenca", "Guadalajara", "Toledo"),
            "Castilla y León" => array("Ávila", "Burgos", "León", "Salamanca", "Segovia", "Soria", "Valladolid", "Zamora"),
            "Cataluña" => array("Barcelona", "Gerona", "Lérida", "Tarragona"),
            "Comunidad Valenciana" => array("Alicante", "Castellón de la Plana", "Valencia"),
            "Extremadura" => array("Badajoz", "Cáceres"),
            "Galicia" => array("La Coruña", "Lugo", "Orense", "Pontevedra"),
            "Madrid" => array("Madrid"),
            "Murcia" => array("Murcia"),
            "Navarra" => array("Pamplona"),
            "País Vasco" => array("Bilbao", "San Sebastián", "Vitoria"),
            "La Rioja" => array("Logroño")
        );

        /*Mediante la etiqueta <label> se consigue crear un título para la lista desplegable.
        De la que se toma el contenido de cada elemento para recorrerlo en otro foreach y añadir
        las opciones mediante <select> para el desplegable y <option> para cada valor/provincia.*/

        echo "<form>";

        foreach($comunidadesAutonomas as $comunidad => $provincias){
            echo "<label>" . $comunidad . ":</label>";
            echo "<select name='" . $comunidad . "'>";

            foreach($provincias as $provincia){
                echo "<option value='" . $provincia . "'>" . $provincia . "</option>";
            }

            echo "</select><br><br>";
        }

        echo "</form>";
    }
?>