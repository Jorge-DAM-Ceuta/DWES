<?php
    namespace JorgeDwes\Blog\Controller;
    use JorgeDwes\Blog\Model\Articulo;

    //Si se ha recogido el id y el numero de operacion:
    if(isset($_GET["id"]) && isset($_GET["numOperacion"])){
        $id = $_GET["id"];
        $numOperacion = $_GET["numOperacion"];

        //Este switch se usará unicamente para eliminar un artículo pero al obtener numOperacion podríamos ampliar su usabilidad añadiendo funciones.
        switch($numOperacion){
            //Obtener articulo por id y mostrar una vista con sus detalles, por ejemplo. (Sin implementar).
            case 1: 
                $articuloConsultado = Articulo::getArticuloByID($id);
                break;

            //Eliminar un articulo por id y mostrar el mensaje de informativo que devuelve.
            case 2:
                Articulo::delete($id);
                header("Location: ../../index.php");
                break;
                
            default: 
                echo "<h3 style='color: red;'>No hay número de operación</h3>";
                break;
        }
        //Si el número de operación es '4' se eliminará el artículo.
    }

    //Insertar un articulo
    if(isset($_POST["insertar"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        $titulo = $_POST["titulo"];
        $contenido = $_POST["contenido"];

        $localtime = localtime(time(), true);
        $fechaActual = $localtime["tm_year"] + 1900 . "-" . $localtime["tm_mon"] + 1 . "-" . $localtime["tm_mday"] . " " . $localtime["tm_hour"] . ":" . $localtime["tm_min"] . ":" . $localtime["tm_sec"];

        $articulo = new Articulo($titulo, $contenido, $fechaActual);
        $articulo->insert();

        header("Location: ../Views/InsertarForm.php?ok=true");
    }
?>