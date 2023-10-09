<?php

$listaDeTareas = ["Lista de tareas"][""];
$operacion = "";

echo "Menú:\n";
echo "1. Mostrar lista\n";
echo "2. Crear lista\n";
echo "3. Añadir nueva tarea en una lista\n";
echo "4. Marcar como completada una tarea de una lista\n";
echo "5. Eliminar tarea de una lista\n";
echo "6. Eliminar lista\n";
echo "7. Mostrar tareas pendientes\n";


do{

    echo $listaDeTareas;

    switch($operacion){
        case "Mostrar listas":
           
            break;

        case "Crear lista":
            
            break;

        case "Añadir nueva tarea en una lista":
            $listaDeTareas [count($listaDeTareas)] = readline("Escribe el nombre de la tarea:");
            break;

        case "Marcar como completada una tarea de una lista":
            
            break;

        case "Eliminar tarea de una lista":

            break;
        
        case "Elminiar lista":

            break;

        case "Mostrar tareas pendientes":
            
            break;
    }

}while(strtolower($operacion) != "exit");


?>