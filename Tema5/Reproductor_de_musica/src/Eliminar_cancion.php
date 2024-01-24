<?php
    if(isset($_GET['id'])) {
        $idCancion = urldecode($_GET['id']);

        $rutaJSON = "./json/Canciones.json";
        $jsonString = file_get_contents($rutaJSON);
        $canciones = json_decode($jsonString, true);

        foreach($canciones as $key => $cancion) {
            if($cancion['id'] == $idCancion) {
                unset($canciones[$key]);
                
                $jsonString = json_encode($canciones, JSON_PRETTY_PRINT);
                file_put_contents($rutaJSON, $jsonString);
                
                header("Location: Index.php");
                exit();
            }
        }
    }
?>