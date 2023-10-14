<?php

    function comprobarDNI($dni){
        $letrasDNI = array("T", "R", "W", "A", "G", "M", "Y", "F", "P", "D", "X", "B", "N", "J", "Z", "S", "Q", "V", "H", "L", "C", "K", "E");
        $splitDNI;

        if($dni[strlen($dni)-2] == "-"){    
            $splitDNI = explode("-", $dni);

            if($splitDNI[1] == $letrasDNI[($splitDNI[0] % 23)]){
                echo "EL DNI ES VÁLIDO.";
            }else{
                echo "EL DNI NO ES CORRECTO.";
            }
            
        }else{
            if($dni[strlen($dni)-1] == $letrasDNI[(substr($dni, 0, -1) % 23)]){
                echo "EL DNI ES VÁLIDO.";
            }else{
                echo "EL DNI NO ES CORRECTO.";
            }
        }
    }

    function listarArrayOrdenado($array){
            sort($array);

            echo "<ol>";

            foreach($array as $nombre){
                echo "<li>" . $nombre . "</li>";
            }

            echo "</ol>";
    }

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

        echo "<form>";

        foreach($comunidadesAutonomas as $comunidad => $provincias){
            echo "<label for='" . $comunidad . "'>" . $comunidad . ":</label>";
            echo "<select name='" . $comunidad . "'>";

            foreach($provincias as $provincia){
                echo "<option value='" . $provincia . "'>" . $provincia . "</option>";
            }

            echo "</select><br><br>";
        }

        echo "</form>";
    }
?>