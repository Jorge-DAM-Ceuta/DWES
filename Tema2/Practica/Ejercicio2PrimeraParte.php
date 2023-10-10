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
            var_dump($listaDeTareas);

            /*foreach($listaDeTareas as $lista){
                foreach($lista as $tarea){
                    print_r($tarea);
                }
            }*/
            
            break;

        case 2: //Crear lista
            $nombreDeLista = readline("Dale un nombre a la lista:");
            
            array_push($listaDeTareas, $nombreDeLista);

            break;

        case 3: //Añadir nueva tarea en una lista
            $nombreLista = readline("¿En qué lista quieres añadir una tarea?");
            $nombreDeTarea = readline("Dale un nombre a la tarea:");

            if(in_array($nombreLista, $listaDeTareas)){
                foreach($listaDeTareas as $lista){
                    if($lista[0] == $nombreLista){
                        array_push($lista, array($nombreDeTarea));
                    }
                }
            }else{
                echo "La lista de tareas '" . $nombreLista . "' no existe..."; 
            }

            break;

        case 4: //Marcar como completada una tarea de una lista
            
            break;

        case 5: //Eliminar tarea de una lista

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