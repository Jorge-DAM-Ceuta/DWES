<?php

    function decodificarListas($rutaJSON):mixed{

        $ruta = $rutaJSON;
        $contenido = file_get_contents($ruta);
        $listas = json_decode($contenido, true);
        
        return $listas;
    }

    function mostrarTablaPendientes($listaTareas) {
        foreach ($listaTareas['ListaTareas'] as $lista => $tareas) {
            foreach ($tareas as $tarea) {
                if ($tarea['Estado'] == 'Pendiente') {
                    $id = $tarea['id'];            
                    echo "<tr>";
                    echo "<td align='center'><input type='checkbox' disabled></td>";
                    echo "<td align='center'>" . $tarea['Descripcion'] . "</td>";
                    echo "<td align='center'>" . $tarea['Prioridad'] . "</td>";
                    echo "<td align='center'>" . $tarea['FechaLimite'] . "</td>";
                    echo "<td align='center'><input type='submit' name='editar' value='Editar'> &nbsp; <a href='./src/MarcarCompletada.php?id=$id&lista=$lista'>Completar</a> &nbsp; <a href='./src/EliminarTarea.php?id=$id&lista=$lista'>Eliminar</a></td>";
                    echo "</tr>";
                }
            }
        }
    }

    function mostrarTablaCompletadas($listaTareas) {
        foreach ($listaTareas['ListaTareas'] as $lista => $tareas) {
            foreach ($tareas as $tarea) {
                if ($tarea['Estado'] == 'Completada') {
                    $id = $tarea['id'];
                    echo "<tr>";
                    echo "<td align='center'><input type='checkbox' checked disabled></td>";
                    echo "<td align='center'>" . $tarea['Descripcion'] . "</td>";
                    echo "<td align='center'>" . $tarea['Prioridad'] . "</td>";
                    echo "<td align='center'>" . $tarea['FechaLimite'] . "</td>";
                    echo "<td align='center'><a href='./src/MarcarPendiente.php ? id=$id & lista=$lista'>Reiniciar</a> &nbsp; <a href='./src/EliminarTarea.php ? id=$id & lista=$lista'>Eliminar</a></td>";
                    echo "</tr>";
                }
            }
        }
    }

    function mostrarListasEnSelect($listasTareas) {
        foreach ($listasTareas['ListaTareas'] as $nombreLista => $tareas) {
            echo "<option value='$nombreLista'>$nombreLista</option>";
        }
    }

    function agregarTareaALista($descripcion, $prioridad, $fechaLimite, $nombreLista, array &$listasTareas) {
        
        //Obtener el último id.
        $maxID = 0;
        
        //Obtenemos la lista en concreto para recorrerla.
        $tareas = $listasTareas['ListaTareas'][$nombreLista];

        foreach ($tareas as $tarea) {
            if ($tarea['id'] > $maxID) {
                $maxID = $tarea['id'];
            }
        }
        
        //Obtenemos un id superior al más alto.
        $maxID ++;

        $nuevaTarea = array(
            "id" => $maxID,
            "Descripcion"=> $descripcion,
            "Prioridad"=> $prioridad,
            "FechaLimite"=> $fechaLimite,
            "Estado"=> "Pendiente"
        );
        
        if (array_key_exists($nombreLista, $listasTareas['ListaTareas'])) {
            $lista = &$listasTareas['ListaTareas'][$nombreLista];
            array_push($lista, $nuevaTarea);

            $ruta = "src/ListaTareas.json";
            $jsonString = json_encode($listasTareas, JSON_PRETTY_PRINT);
            $fichero = fopen($ruta, 'w');
            fwrite($fichero, $jsonString);
            fclose($fichero);
        }

        header("Location: Index.php");
    }

    function eliminarTarea(&$listaTareas, $id, $lista){
        $tareas = &$listaTareas['ListaTareas'][$lista];
        
        foreach($tareas as $indice => $tarea) {
            if($tarea['id'] == $id) {
                unset($tareas[$indice]);
            }
        }
        
        $ruta = "ListaTareas.json";
        $jsonString = json_encode($listaTareas, JSON_PRETTY_PRINT);
        $fichero = fopen($ruta, 'w');
        fwrite($fichero, $jsonString);
        fclose($fichero);

        header("Location: ../Index.php");
    }

    function marcarTareaCompletada(&$listaTareas, $id, $lista){
        $tareas = &$listaTareas['ListaTareas'][$lista];

        foreach($tareas as &$tarea) {
            if($tarea['id'] == $id && $tarea['Estado'] == 'Pendiente') {
                $tarea['Estado'] = 'Completada';
            }
        }

        $ruta = "ListaTareas.json";
        $jsonString = json_encode($listaTareas, JSON_PRETTY_PRINT);
        $fichero = fopen($ruta, 'w');
        fwrite($fichero, $jsonString);
        fclose($fichero);

        header("Location: ../Index.php");
    }

    function marcarTareaPendiente(&$listaTareas, $id, $lista){
        $tareas = &$listaTareas['ListaTareas'][$lista];

        foreach($tareas as &$tarea) {
            if($tarea['id'] == $id && $tarea['Estado'] == 'Completada') {
                $tarea['Estado'] = 'Pendiente';
            }
        }

        $ruta = "ListaTareas.json";
        $jsonString = json_encode($listaTareas, JSON_PRETTY_PRINT);
        $fichero = fopen($ruta, 'w');
        fwrite($fichero, $jsonString);
        fclose($fichero);

        header("Location: ../Index.php");
    }

    function editarTarea(&$listaTareas, $id, $lista){
        $tareas = &$listaTareas['ListaTareas'][$lista];

        foreach($tareas as &$tarea) {
            if($tarea['id'] == $id) {
                $descripcion = $tarea['Descripcion'];
                $prioridad = $tarea['Prioridad'];
                $fechaLimite = $tarea['FechaLimite'];
                $estado = $tarea['Estado'];
            }
        }

        echo "<p>
                <label>Descripción: </label>
                <input type='text' name='descripcion' value='$descripcion'>
            </p>
            
            <p>
                <label>Descripción: </label>
                <input type='text' name='prioridad' value='$prioridad'>
            </p>
            
            <p>
                <label>Descripción: </label>
                <input type='date' name='fechaLimite' value='$fechaLimite'>
            </p>
            
            <p>
                <label>Descripción: </label>
                <input type='text' name='estado' value='$estado'>
            </p>";

        $ruta = "ListaTareas.json";
        $jsonString = json_encode($listaTareas, JSON_PRETTY_PRINT);
        $fichero = fopen($ruta, 'w');
        fwrite($fichero, $jsonString);
        fclose($fichero);

        header("Location: ../Index.php");
    }

    function decodificarNotas():mixed{

        $ruta = "src/Notas.json";
        $contenido = file_get_contents($ruta);
        $notas = json_decode($contenido, true);
        
        return $notas;
    }

?>