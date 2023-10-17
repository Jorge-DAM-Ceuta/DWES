<?php

//cd /xampp/htdocs/DWES/Tema2/Practica

$listas = array();

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
            mostrarListaDeTareas($listas);

            break;

        case 2: //Crear lista
            $nombreDeLista = readline("Dale un nombre a la lista:");
            
            $listas[$nombreDeLista] = array();

            mostrarListaDeTareas($listas);

            break;

        case 3: //Añadir nueva tarea en una lista
            $nombreDeLista = readline("¿En qué lista quieres añadir una tarea?");
            $nombreDeTarea = readline("Dale un nombre a la tarea:");

            crearTarea($listas, $nombreDeLista, $nombreDeTarea);

            mostrarListaDeTareas($listas);

            break;

        case 4: //Marcar como completada una tarea de una lista
            $nombreDeLista = readline("¿En qué lista se va a marcar la tarea completada?");
            $nombreDeTarea = readline("¿Qué tarea se va a marcar completada?");

            completarTarea($listas, $nombreDeLista, $nombreDeTarea);

            mostrarListaDeTareas($listas);

            break;

        case 5: //Eliminar tarea de una lista
            $nombreDeLista = readline("¿En qué lista se va a eliminar la tarea?");
            $nombreDeTarea = readline("¿Qué tarea se va a eliminar?");

            eliminarTarea($listas, $nombreDeLista, $nombreDeTarea);
            
            mostrarListaDeTareas($listas);

            break;
        
        case 6: //Elminiar lista
            $nombreDeLista = readline("¿Qué lista deseas eliminar?");

            eliminarLista($listas, $nombreDeLista);

            mostrarListaDeTareas($listas);

            break;

        case 7: //Mostrar tareas pendientes de una lista
            $nombreDeLista = readline("¿De qué lista quieres ver las tareas pendientes?");

            mostrarTareasPendientes($listas, $nombreDeLista);
            
            break;

        case 8: //Crear una nota asociativa a una lista
            $nombreDeLista = readline("¿A qué lista quieres asignarle una nota?");
            $nombreDeNota = readline("¿Cómo se va a llamar tu nota?");
            
            crearNota($listas, $nombreDeLista, $nombreDeNota);

            mostrarListaDeTareas($listas);

            break;

        case 9: //Visualizar una nota asociativa de una lista
            $nombreDeLista = readline("¿De qué lista quieres mostrar su nota?");
            
            mostrarNota($listas, $nombreDeLista);

            break;
    
        default:
            echo "Elige una operación...\n";
            
            break;
    }

}while($operacion != 10);

function mostrarListaDeTareas($listas){
    echo "Lista de tareas: \n";

    for($i = 0; $i<count($listas); $i++){
        $nombreDeLista = array_keys($listas)[$i];
        echo $nombreDeLista . ": \n";

        foreach($listas[$nombreDeLista] as $tareas => $tarea){
            if($tareas == "Nota"){
                echo "  - Nota: " . $tarea . "\n"; //Mostrar junto a la clave en caso de ser nota.
            }else{
                echo "  - " . $tarea . "\n"; //Mostrar elementos sin clave.
            }
        }
    }
}

function crearTarea(&$listas, $nombreDeLista, $nombreDeTarea){
    if(array_key_exists($nombreDeLista, $listas)){
        foreach($listas as $clave => $lista){
            if($clave == $nombreDeLista && (in_array($nombreDeTarea . " - (Sin terminar)", $lista) == false) && (in_array($nombreDeTarea . " - (Terminada)", $lista) == false)){
                array_push($listas[$clave], $nombreDeTarea . " - (Sin terminar)");
            }else{
                echo "Ya existe una tarea con ese nombre en la lista.\n";
            }
        }
    }else{
        echo "La lista de tareas '" . $nombreDeLista . "' no existe...\n"; 
    }
}

function completarTarea(&$listas, $nombreDeLista, $nombreDeTarea){
    if(array_key_exists($nombreDeLista, $listas)){
        foreach($listas[$nombreDeLista] as $clave => $tarea){
            if($tarea == $nombreDeTarea . " - (Terminada)"){
                echo "La tarea ya está marcada como completa.";
            }else if($tarea == $nombreDeTarea . " - (Sin terminar)"){
                $listas[$nombreDeLista][$clave] = $nombreDeTarea . " - (Terminada)";
            }
        }
    }else{
        echo "La lista de tareas '" . $nombreDeLista . "' no existe...\n"; 
    }
}

function eliminarTarea(&$listas, $nombreDeLista, $nombreDeTarea){
    if(array_key_exists($nombreDeLista, $listas)){
        foreach($listas[$nombreDeLista] as $clave => $tarea){
            if($tarea == $nombreDeTarea . " - (Terminada)" || $tarea == $nombreDeTarea . " - (Sin terminar)"){
                unset($listas[$nombreDeLista][$clave]); //Eliminar posición
            }
        }
    }else{
        echo "La lista de tareas '" . $nombreDeLista . "' no existe...\n"; 
    }
}

function eliminarLista(&$listas, $nombreDeLista){
    if(array_key_exists($nombreDeLista, $listas)){
        unset($listas[$nombreDeLista]);
    }else{
        echo "No existe ninguna lista con ese nombre...\n";
    }
}

function mostrarTareasPendientes(&$listas ,$nombreDeLista){
    if(array_key_exists($nombreDeLista, $listas)){

        echo "Tareas pendientes de la lista " . $nombreDeLista . "\n";

        foreach($listas[$nombreDeLista] as $tarea){
            $informacionDeTarea = explode(" - ", $tarea);
            $estado = $informacionDeTarea[1];

            if($estado == "(Sin terminar)"){
                echo $tarea . "\n";
            }
        }
    }else{
        echo "La lista de tareas '" . $nombreDeLista . "' no existe...\n"; 
    }
}

function crearNota(&$listas, $nombreDeLista, $nombreArchivo){
    $fichero = fopen("./Notas/" . $nombreArchivo . ".txt", "w");

    $contenido = readline("Escribe el contenido de la nota:");
    fwrite($fichero, $contenido);

    fclose($fichero);

    if(array_key_exists($nombreDeLista, $listas)){
        $listas[$nombreDeLista]["Nota"] = "./Notas/" . $nombreArchivo . ".txt";
        
    }else{
        echo "La lista de tareas '" . $nombreDeLista . "' no existe...\n"; 
    }
}

function mostrarNota($listas, $nombreDeLista){
    if(array_key_exists($nombreDeLista, $listas)){
        if(array_key_exists("Nota", $listas[$nombreDeLista])){
            $ruta = $listas[$nombreDeLista]["Nota"];

            if(file_exists($ruta)){
                $contenido = file_get_contents($ruta);
                echo "Contenido de la nota de la lista " . $nombreDeLista . ":\n";
                echo $contenido . "\n";
            }
        }else{
            echo "La lista " . $nombreDeLista . " no tiene ninguna nota.\n";
        }
    }else{
        echo "La lista de tareas '" . $nombreDeLista . "' no existe...\n"; 
    }
}

?>