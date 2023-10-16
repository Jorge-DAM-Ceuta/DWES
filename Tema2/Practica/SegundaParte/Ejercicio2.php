<?php

//cd /xampp/htdocs/DWES/DWES/Tema2/Practica

$listaDeTareas = array();

do{

    echo "Menú:\n";
    echo "1. Mostrar lista\n";
    echo "2. Crear lista\n";
    echo "3. Añadir nueva tarea en una lista\n";
    echo "4. Marcar como completada una tarea de una lista\n";
    echo "5. Eliminar tarea de una lista\n";
    echo "6. Eliminar lista\n";
    echo "7. Mostrar tareas pendientes\n";
    echo "8. Crear una nota en una lista\n";
    echo "9. Leer nota de una lista\n";
    echo "10. Finalizar ejecución\n";

    $operacion = readline("Elige la operación a realizar:");

    switch($operacion){
        case 1: //Mostrar listas
            mostrarListaDeTareas($listaDeTareas);

            break;

        case 2: //Crear lista
            $nombreDeLista = readline("Dale un nombre a la lista:");
            
            $listaDeTareas[$nombreDeLista] = array();

            mostrarListaDeTareas($listaDeTareas);

            break;

        case 3: //Añadir nueva tarea en una lista
            $nombreDeLista = readline("¿En qué lista quieres añadir una tarea?");
            $nombreDeTarea = readline("Dale un nombre a la tarea:");

            if(array_key_exists($nombreDeLista, $listaDeTareas)){
                foreach($listaDeTareas as $clave => $lista){
                    if($clave == $nombreDeLista && (in_array($nombreDeTarea . " - (Sin terminar)", $lista) == false) && (in_array($nombreDeTarea . " - (Terminada)", $lista) == false)){
                        array_push($listaDeTareas[$clave], $nombreDeTarea . " - (Sin terminar)");
                    }else{
                        echo "Ya existe una tarea con ese nombre en la lista.\n";
                    }
                }
            }else{
                echo "La lista de tareas '" . $nombreDeLista . "' no existe..."; 
            }

            mostrarListaDeTareas($listaDeTareas);

            break;

        case 4: //Marcar como completada una tarea de una lista
            $nombreDeLista = readline("¿En qué lista se va a marcar la tarea completada?");
            $nombreDeTarea = readline("¿Qué tarea se va a marcar completada?");

            if(array_key_exists($nombreDeLista, $listaDeTareas)){
                foreach($listaDeTareas[$nombreDeLista] as $clave => $tarea){
                    if($tarea == $nombreDeTarea . " - (Terminada)"){
                        echo "La tarea ya está marcada como completa.";
                    }else if($tarea == $nombreDeTarea . " - (Sin terminar)"){
                        $listaDeTareas[$nombreDeLista][$clave] = $nombreDeTarea . " - (Terminada)";
                    }
                }
            }else{
                echo "La lista de tareas '" . $nombreDeLista . "' no existe..."; 
            }

            mostrarListaDeTareas($listaDeTareas);

            break;

        case 5: //Eliminar tarea de una lista
            $nombreDeLista = readline("¿En qué lista se va a eliminar la tarea?");
            $nombreDeTarea = readline("¿Qué tarea se va a eliminar?");

            if(array_key_exists($nombreDeLista, $listaDeTareas)){
                foreach($listaDeTareas[$nombreDeLista] as $clave => $tarea){
                    if($tarea == $nombreDeTarea . " - (Terminada)" || $tarea == $nombreDeTarea . " - (Sin terminar)"){
                        unset($listaDeTareas[$nombreDeLista][$clave]); //Eliminar posición
                    }
                }
            }else{
                echo "La lista de tareas '" . $nombreDeLista . "' no existe..."; 
            }

            mostrarListaDeTareas($listaDeTareas);

            break;
        
        case 6: //Elminiar lista
            $nombreDeLista = readline("¿Qué lista deseas eliminar?");

            if(array_key_exists($nombreDeLista, $listaDeTareas)){
                unset($listaDeTareas[$nombreDeLista]);
            }else{
                echo "No existe ninguna lista con ese nombre...";
            }

            mostrarListaDeTareas($listaDeTareas);

            break;

        case 7: //Mostrar tareas pendientes de una lista
            $nombreDeLista = readline("¿De qué lista quieres ver las tareas pendientes?");

            if(array_key_exists($nombreDeLista, $listaDeTareas)){
                foreach($listaDeTareas[$nombreDeLista] as $tarea){
                    $informacionDeTarea = explode(" - ", $tarea);
                    $estado = $informacionDeTarea[1];

                    echo "\n";

                    if($estado == "(Sin terminar)"){
                        echo $tarea . "\n";
                    }
                }
            }else{
                echo "La lista de tareas '" . $nombreDeLista . "' no existe..."; 
            }

            break;

        case 8:
            $nombreDeLista = readline("¿A qué lista quieres asignarle una nota?");
            $nombreDeNota = readline("¿Cómo se va a llamar tu nota?");
            
            crearNota($listaDeTareas, $nombreDeLista, $nombreDeNota);

            mostrarListaDeTareas($listaDeTareas);

            break;

        case 9:
            
            
            break;
    
        default:
            echo "Elige una operación...";
            
            break;
    }

}while($operacion != 10);

function mostrarListaDeTareas($listaDeTareas){
    echo "Lista de tareas: \n";

    for($i = 0; $i<count($listaDeTareas); $i++){
        $nombreDeLista = array_keys($listaDeTareas)[$i];
        echo $nombreDeLista . ": \n";

        for($j = 0; $j<count($listaDeTareas[$nombreDeLista]); $j++){
            echo "  - " . $listaDeTareas[$nombreDeLista][$j] . "\n";
        }
    }
}

function crearNota($listaDeTareas, $nombreDeLista, $nombreArchivo){
    $fichero = fopen("./Notas/" . $nombreArchivo . ".txt", "w");

    $contenido = readline("Escribe el contenido de la nota:");
    fwrite($fichero, $contenido);

    fclose($fichero);

    if(array_key_exists($nombreDeLista, $listaDeTareas)){
        array_push($listaDeTareas[$nombreDeLista]["Nota"], "./Notas/" . $nombreArchivo . ".txt"); 
        var_dump($listaDeTareas);
    }else{
        echo "La lista de tareas '" . $nombreDeLista . "' no existe..."; 
    }

}

?>