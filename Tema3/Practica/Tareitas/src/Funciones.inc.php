<?php

    function decodificarListas():mixed{

        $ruta = "src/ListaTareas.json";
        $contenido = file_get_contents($ruta);
        $listas = json_decode($contenido, true);
        
        return $listas;
    }

    function mostrarTablaPendientes($listaTareas) {
        foreach ($listaTareas['ListaTareas'] as $lista => $tareas) {
            foreach ($tareas as $tarea) {
                if ($tarea['Estado'] == 'Pendiente') {
                    echo "<tr>";
                    echo "<td align='center'><input type='checkbox' disabled></td>";
                    echo "<td align='center'>" . $tarea['Descripcion'] . "</td>";
                    echo "<td align='center'>" . $tarea['Prioridad'] . "</td>";
                    echo "<td align='center'>" . $tarea['FechaLimite'] . "</td>";
                    echo "<td align='center'><input type='submit' name='editar' value='Editar'><input type='submit' name='completar' value='Completar'><input type='submit' name='eliminar' value='Eliminar'></td>";
                    echo "</tr>";
                }
            }
        }
    }

    function mostrarTablaCompletadas($listaTareas) {
        foreach ($listaTareas['ListaTareas'] as $lista => $tareas) {
            foreach ($tareas as $tarea) {
                if ($tarea['Estado'] == 'Completada') {
                    echo "<tr>";
                    echo "<td align='center'><input type='checkbox' checked disabled></td>";
                    echo "<td align='center'>" . $tarea['Descripcion'] . "</td>";
                    echo "<td align='center'>" . $tarea['Prioridad'] . "</td>";
                    echo "<td align='center'>" . $tarea['FechaLimite'] . "</td>";
                    echo "<td align='center'><input type='submit' name='reiniciar' value='Reiniciar'><input type='submit' name='eliminar' value='Eliminar'></td>";
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
        
        $nuevaTarea = array(
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
    }

    function decodificarNotas():mixed{

        $ruta = "src/Notas.json";
        $contenido = file_get_contents($ruta);
        $notas = json_decode($contenido, true);
        
        return $notas;
    }

?>