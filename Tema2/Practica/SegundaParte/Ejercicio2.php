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

/*Esta función lista los array que contiene el array 'listas' y cada uno de sus 
elementos con un formato legible por el usuario. Solo se muestra la clave de los 
subarrays y el valor de sus elementos sin la clave, excepto el elemento Nota. 

El paso por valor de la variable se debe a que no se modificará nada de su interior,
en los demás casos se requiere el paso del array 'listas' por referencia. */
function mostrarListaDeTareas($listas){
    echo "Lista de tareas: \n";

    for($i = 0; $i<count($listas); $i++){
        $nombreDeLista = array_keys($listas)[$i];
        echo $nombreDeLista . ": \n"; //Mostrar nombre de la lista.

        foreach($listas[$nombreDeLista] as $tareas => $tarea){
            if($tareas == "Nota"){
                echo "  - Nota: " . $tarea . "\n"; //Mostrar junto a la clave en caso de ser nota.
            }else{
                echo "  - " . $tarea . "\n"; //Mostrar elementos sin clave.
            }
        }
    }
}

/*Esta función permite crear una tarea dentro de una lista concreta dentro del array 'listas'.
Se comprueba que la lista exista en el array y se recorren las listas hasta comprobar que el
nombre de la lista coincida con el nombre en la clave del array y que no exista una tarea con
el mismo nombre en su interior. Si se cumplen las dos condiciones se añade el elemento en esa
lista con el nombre que ha introducido el usuario. */
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

/*Esta función permite marcar como completada una tarea en una lista. Se comprueba que exista
esa lista y se recorre sus elementos hasta comprobar que coindice el nombre de la tarea que
ha introducido el usuario con el valor de una de sus posiciones para cambiar su valor. En
caso de que la tarea ya esté marcada como completa se informará al usuario y en caso de que
la tarea no exista en la lista también se mostrará un mensaje. */
function completarTarea(&$listas, $nombreDeLista, $nombreDeTarea){
    if(array_key_exists($nombreDeLista, $listas)){
        foreach($listas[$nombreDeLista] as $clave => $tarea){
            if($tarea == $nombreDeTarea . " - (Terminada)"){
                echo "La tarea ya está marcada como completa.\n";
            }else if($tarea == $nombreDeTarea . " - (Sin terminar)"){
                $listas[$nombreDeLista][$clave] = $nombreDeTarea . " - (Terminada)";
            }else{
                echo "No existe la tarea " . $nombreDeTarea . " en la lista.\n";
            }
        }
    }else{
        echo "La lista de tareas '" . $nombreDeLista . "' no existe...\n"; 
    }
}

/*Esta función permite eliminar una tarea de una lista. Se comprueba que exista la lista y 
se recorre la lista en busca de un elemento cuyo valor coincida con el nombre de la tarea
introducida por el usuario. En caso de que la encuentre se eliminará el elemento con unset(), 
en caso contrario se mostrará un mensaje indicando que no existe la tarea en la lista. */
function eliminarTarea(&$listas, $nombreDeLista, $nombreDeTarea){
    if(array_key_exists($nombreDeLista, $listas)){
        foreach($listas[$nombreDeLista] as $clave => $tarea){
            if($tarea == $nombreDeTarea . " - (Terminada)" || $tarea == $nombreDeTarea . " - (Sin terminar)"){
                unset($listas[$nombreDeLista][$clave]); //Eliminar posición
            }else{
                echo "No existe la tarea " . $nombreDeTarea . " en la lista.\n";
            }
        }
    }else{
        echo "La lista de tareas '" . $nombreDeLista . "' no existe...\n"; 
    }
}

/*Esta función permite eliminar una lista. Se comprueba que la lista exista y se elimina 
mediante el método unset(), en caso contrario se mostrará un mensaje al usuario. */
function eliminarLista(&$listas, $nombreDeLista){
    if(array_key_exists($nombreDeLista, $listas)){
        unset($listas[$nombreDeLista]);
    }else{
        echo "No existe ninguna lista llamada " . $nombreDeLista . "...\n";
    }
}

/*Esta función permite mostrar las tareas pendientes de una lista. Se comprueba que exista la 
lista y se muestra un título, luego, con un foreach se recorren las posiciones de la lista y 
mediante un método de manejo de cadenas se separa la cadena del valor en dos. Se usa la 
posición 1 que contendrá el estado de la tarea, si es igual a (Sin terminar) se mostrará la tarea. */
function mostrarTareasPendientes(&$listas ,$nombreDeLista){
    if(array_key_exists($nombreDeLista, $listas)){

        echo "Tareas pendientes de la lista " . $nombreDeLista . "\n";

        foreach($listas[$nombreDeLista] as $tarea){
            $informacionDeTarea = explode(" - ", $tarea);
            $estado = $informacionDeTarea[1];

            if($estado == "(Sin terminar)"){
                echo "  - " . $tarea . "\n";
            }
        }
    }else{
        echo "La lista de tareas '" . $nombreDeLista . "' no existe...\n"; 
    }
}

/*Esta función permite mediante los métodos fopen(), fwrite() y fclose() crear un archivo 
con el contenido que el usuario necesite. Se crea un fichero en el directorio 'Notas' con 
la extensión .txt y mediante un readline() se recoge el contenido escrito por el usuario.

Luego, si la lista existe crea un elemento en su interior con la clave 'Nota' cuyo valor
será la ruta relativa a la nota en el directorio Notas. */
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

/*Esta función permite visualizar el contenido de una nota en una lista de tareas mediante
el método file_get_contents() indicándole la ruta al fichero. En primer lugar se comprueba
que la lista existe, luego comprueba que exista el elemento con clave 'Nota' en el array.

Si es así se almacena el valor/ruta en la variable $ruta y se comprueba que exista el fichero
en el directorio, de ser así se almacena el contenido en la variable $contenido con el método
file_get_contents() y se muestra un título y su valor mediante un echo. */
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