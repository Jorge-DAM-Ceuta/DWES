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
    echo "8. Finalizar ejecución\n";

    $operacion = readline("Elige la operación a realizar:");

    switch($operacion){
        case 1: //Mostrar listas
            print_r($listaDeTareas);

            /*foreach($listaDeTareas as $lista){
                foreach($lista as $tarea){
                    print_r($tarea);
                }
            }*/
            
            break;

        case 2: //Crear lista
            $nombreDeLista = readline("Dale un nombre a la lista:");
            
            $listaDeTareas[$nombreDeLista] = array();

            print_r($listaDeTareas);

            break;

        case 3: //Añadir nueva tarea en una lista
            $nombreDeLista = readline("¿En qué lista quieres añadir una tarea?");
            $nombreDeTarea = readline("Dale un nombre a la tarea:");

            if(array_key_exists($nombreDeLista, $listaDeTareas)){
                foreach($listaDeTareas as $clave => $lista){
                    if($clave == $nombreDeLista ){//&& (in_array($nombreDeTarea . " - (Sin terminar)", $lista) == false || in_array($nombreDeTarea . " - (Terminada)", $lista) == false)){
                        array_push($listaDeTareas[$clave], $nombreDeTarea . " - (Sin terminar)");
                    }else{
                        echo "Ya existe una tarea con ese nombre en la lista.";
                    }
                }
            }else{
                echo "La lista de tareas '" . $nombreDeLista . "' no existe..."; 
            }

            print_r($listaDeTareas);

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

            print_r($listaDeTareas);

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

            print_r($listaDeTareas);

            break;
        
        case 6: //Elminiar lista

            break;

        case 7: //Mostrar tareas pendientes
            
            break;

        case 8:

            break;
    }

}while($operacion != 8);

?>