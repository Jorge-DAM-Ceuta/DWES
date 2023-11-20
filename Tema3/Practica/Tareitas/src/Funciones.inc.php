<?php

    //LISTAS
    function decodificarListas($rutaJSON):mixed{

        $ruta = $rutaJSON;
        $contenido = file_get_contents($ruta);
        $listas = json_decode($contenido, true);
        
        return $listas;
    }

    function mostrarListasEnSelect($listasTareas) {
        foreach ($listasTareas['ListaTareas'] as $nombreLista => $tareas) {
            echo "<option value='$nombreLista'>$nombreLista</option>";
        }
    }

    function agregarLista(&$listas, $nombreLista) {
        if (!isset($listas['ListaTareas'][$nombreLista])) {
            $listas['ListaTareas'][$nombreLista] = [];
        } else {
            echo "La lista $nombreLista ya existe.";
        }

        $ruta = "src/ListaTareas.json";
        $jsonString = json_encode($listas, JSON_PRETTY_PRINT);
        $fichero = fopen($ruta, 'w');
        fwrite($fichero, $jsonString);
        fclose($fichero);

        header("Location: Listas.php");
    }

    function mostrarListas($listas){
        foreach($listas['ListaTareas'] as $nombreLista => $tareas) {
            echo "<tr><td align='center'><strong>$nombreLista</strong></td><td><a href='./src/MostrarLista.php?lista=$nombreLista'>Mostrar</a> &nbsp; <a href='./src/MarcarTareas.php?lista=$nombreLista'>Completar todas las tareas</a> &nbsp; <a href='./src/EliminarTareas.php?lista=$nombreLista'>Eliminar todas las tareas</a> &nbsp; <a href='./src/EditarLista.php?lista=$nombreLista'>Editar</a> &nbsp; <a href='./src/EliminarLista.php?lista=$nombreLista'>Eliminar</a></td></tr>";
        }
    }

    //MOSTRAR LISTA EN CONCRETO
    function mostrarLista($listas, $lista){
        foreach($listas['ListaTareas'][$lista] as $tareas => $tarea) {
            echo "<tr>";
                    echo "<td align='center'><input type='checkbox' disabled></td>";
                    echo "<td align='center'>" . $tarea['Descripcion'] . "</td>";
                    echo "<td align='center'>" . $tarea['Prioridad'] . "</td>";
                    echo "<td align='center'>" . $tarea['FechaLimite'] . "</td>";
            echo "</tr>";
        }
    }

    function marcarTodoCompletado(&$listas, $lista){
        foreach ($listas['ListaTareas'][$lista] as &$tarea) {
            $tarea['Estado'] = 'Completada';
        }

        $ruta = "ListaTareas.json";
        $jsonString = json_encode($listas, JSON_PRETTY_PRINT);
        $fichero = fopen($ruta, 'w');
        fwrite($fichero, $jsonString);
        fclose($fichero);

        header("Location: ../Listas.php");
    }

    function vaciarLista(&$listas, $lista){
        $listas['ListaTareas'][$lista] = [];

        $ruta = "ListaTareas.json";
        $jsonString = json_encode($listas, JSON_PRETTY_PRINT);
        $fichero = fopen($ruta, 'w');
        fwrite($fichero, $jsonString);
        fclose($fichero);

        header("Location: ../Listas.php");
    }

    function eliminarLista(&$listas, $lista){
        unset($listas['ListaTareas'][$lista]);
        
        $ruta = "ListaTareas.json";
        $jsonString = json_encode($listas, JSON_PRETTY_PRINT);
        $fichero = fopen($ruta, 'w');
        fwrite($fichero, $jsonString);
        fclose($fichero);

        header("Location: ../Listas.php");
    }

    function editarLista(&$listas, $lista, $nuevoNombre){
        $tareas = $listas['ListaTareas'][$lista];

        //echo "<p>TAREAS: $tareas</p>"; var_dump($tareas);

        $listas['ListaTareas'][$nuevoNombre] = $tareas;

        //echo "<p>LISTAS: $listas</p>"; var_dump($listas);

        unset($listas['ListaTareas'][$lista]);

        $ruta = "ListaTareas.json";
        $jsonString = json_encode($listas, JSON_PRETTY_PRINT);
        $fichero = fopen($ruta, 'w');
        fwrite($fichero, $jsonString);
        fclose($fichero);

        header("Location: ../Listas.php");
    }

    //------TAREAS------
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
                    echo "<td align='center'><a href='./src/EditarTarea.php?id=$id&lista=$lista'>Editar</a> &nbsp; <a href='./src/MarcarCompletada.php?id=$id&lista=$lista'>Completar</a> &nbsp; <a href='./src/EliminarTarea.php?id=$id&lista=$lista'>Eliminar</a></td>";
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
                    echo "<td align='center'><a href='./src/MarcarPendiente.php?id=$id&lista=$lista'>Reiniciar</a> &nbsp; <a href='./src/EliminarTarea.php?id=$id&lista=$lista'>Eliminar</a></td>";
                    echo "</tr>";
                }
            }
        }
    }

    function agregarTareaALista($descripcion, $prioridad, $fechaLimite, $nombreLista, array &$listasTareas, $estado="Pendiente") {
        
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
            "Estado"=> $estado
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

    function cargarTarea(&$listaTareas, $id, $lista){
        $tareas = &$listaTareas['ListaTareas'][$lista];

        foreach($tareas as &$tarea) {
            if($tarea['id'] == $id) {
                $descripcion = $tarea['Descripcion'];
                //$prioridad = $tarea['Prioridad'];
                $fechaLimite = date("Y/m/d", strtotime($tarea['FechaLimite']));
                //$estado = $tarea['Estado'];
            }
        }

        echo "<p>
                <label>Descripción: </label>
                <input type='text' name='descripcion' size='40' value='$descripcion'>
            </p>
            
            <p>
                <label>Prioridad: </label>
                <select name='prioridad'>
                    <option value='Alta'>Alta</option>
                    <option value='Media'>Media</option>
                    <option value='Baja'>Baja</option>
                </select>
            </p>
            
            <p>
                <label>Fecha límite: </label>
                <input type='date' name='fechaLimite' required>
            </p>
            
            <p>
                <label>Estado: </label>
                <select name='estado'>
                    <option value='Completada'>Completada</option>
                    <option value='Pendiente'>Pendiente</option>
                </select>
            </p>";
    }

    function decodificarNotas($ruta){

        $contenido = file_get_contents($ruta);
        $notas = json_decode($contenido, true);
        
        return $notas;
    }

    function mostrarNotas($notas){
        foreach ($notas['Notas'] as $nota) {
            $titulo = $nota['titulo'];
            $color = $nota['color'];

            echo "<tr style='background-color: $color;'>";
                echo "<td>" . $nota['titulo'] . "</td>";
                echo "<td>" . $nota['contenido'] . "</td>";
                echo "<td><a href='./src/EliminarNota.php?titulo=$titulo'>Eliminar</a></td>";
            echo "</tr>";
        }
    }

    function crearNota(&$notas, $titulo, $contenido, $color){
        array_push($notas['Notas'], array("titulo" => $titulo, "contenido" => $contenido, "color" => $color));
        
        $ruta = "src/Notas.json";
        $jsonString = json_encode($notas, JSON_PRETTY_PRINT);
        $fichero = fopen($ruta, 'w');
        fwrite($fichero, $jsonString);
        fclose($fichero);

        header("Location: Notas.php");
    }

    function eliminarNota(&$notas, $titulo){
        var_dump($notas);

        foreach($notas['Notas'] as $indice => $nota) {
            if($nota['titulo'] == $titulo) {
                unset($notas['Notas'][$indice]);
            }
        }

        $ruta = "Notas.json";
        $jsonString = json_encode($notas, JSON_PRETTY_PRINT);
        $fichero = fopen($ruta, 'w');
        fwrite($fichero, $jsonString);
        fclose($fichero);

        header('location: ../Notas.php');
    }

?>