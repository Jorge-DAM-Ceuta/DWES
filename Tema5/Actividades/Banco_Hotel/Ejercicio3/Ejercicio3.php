<?php
    include_once("./Funciones.inc.php");
    include_once("./Cuenta.php");

    $estadoCuenta = obtenerJSON();

    $saldoActual = $estadoCuenta["saldoActual"];
    $movimientos = $estadoCuenta["movimientos"];

    $cuenta = new Cuenta("Jorge", "Muñoz García", "45124434K", $saldoActual, activa:true);
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./Style.css">
        <title>Mi banco</title>
    </head>
    <body>
        <h1>Bienvenido de nuevo, <?php echo $cuenta->getNombre()?>!</h1>

        <div id="saldo">Saldo Actual: <?php echo $saldoActual; ?> euros</div>

        <h2>Transferir dinero</h2>

        <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST">
            <p>
                <label>Ingresar: <input type="text" name="cantidad1" placeholder="Cantidad a ingresar"></label>
                <br/>
                <label>Concepto: <input type="text" name="concepto1" placeholder="Concepto"></label>
                <br/>
                <input type="submit" name="ingresar" value="Ingresar">
            </p>

            <p>
                <label>Retirar: <input type="text" name="cantidad2" placeholder="Cantidad a retirar"></label>
                <br/>
                <label>Concepto: <input type="text" name="concepto2" placeholder="Concepto"></label>
                <br/>
                <input type="submit" name="retirar" value="Retirar">
            </p>
        </form>

        <h2>Movimientos</h2>

        <div id="movimientos">    
            <?php
                foreach ($movimientos as $movimiento) {
                    $tipoColor = ($movimiento['tipo'] == 'Ingreso') ? 'ingreso' : 'retiro';
                    echo "<div class='movimiento $tipoColor'>";
                    echo "Tipo: {$movimiento['tipo']}<br>";
                    echo "Cantidad: {$movimiento['cantidad']} euros<br>";
                    echo "Concepto: {$movimiento['concepto']}<br>";
                    echo "Fecha: {$movimiento['fecha']}";
                    echo '</div>';
                }
            ?>
        </div>
        
        <?php
            if(isset($_POST['ingresar']) && $_SERVER['REQUEST_METHOD'] == "POST"){
                $cantidadIngreso = $_POST['cantidad1'];
                $concepto = $_POST['concepto1'];

                $cuenta->ingresarDinero($cantidadIngreso, $concepto);
                header("Location: ./Ejercicio3.php");
            }

            if(isset($_POST['retirar']) && $_SERVER['REQUEST_METHOD'] == "POST"){
                $cantidadRetiro = $_POST['cantidad2'];
                $concepto = $_POST['concepto2'];
                
                $cuenta->retirarDinero($cantidadRetiro, $concepto);
                header("Location: ./Ejercicio3.php");
            }
        ?>
    </body>
</html>