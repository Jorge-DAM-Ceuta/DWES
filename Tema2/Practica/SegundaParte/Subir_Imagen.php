<?php 

    $errores = "";

    /*Mediante pathinfo almacenamos la información de la extensión de la imagen. */
    $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
    $extensionesPermitidas = array('jpg', 'gif', 'svg');

    /*Nos aseguramos de que la extensión de la imagen corresponde con alguna de las 
    permitidas en el array, en caso contrario lo registra en la variable $errores */
    if(!in_array($extension, $extensionesPermitidas)){
        $errores .= "- La imagen debe ser de la extensión .jpg, .gif o .svg ";
    }

    /*Nos aseguramos de que el tamaño de la imagen sea menor de 2MB */
    if($_FILES['imagen']['size'] >= 2097152){ // 2MB
        $errores .= "- La imagen debe tener un tamaño menor a 2MB.";
    }

    /*Si no se ha registrado ningún mensaje de error en la variable se intenta subir
    la imagen al directorio 'Imagenes' con move_uploaded_file() indicando el archivo y
    la ruta al directorio con el nombre de la imagen. */
    if(empty($errores)){
        $path = "./Imagenes/". basename($_FILES['imagen']['name']); 

        if(move_uploaded_file($_FILES['imagen']['tmp_name'], $path)) {
            echo "El archivo ".  basename( $_FILES['imagen']['name']). " ha sido subido";
        } else{
            echo "El archivo no se ha subido correctamente";
        }
    }else{
        echo $errores;
    }

?>
