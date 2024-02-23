<?php
    include_once("./Model/Cuenta.php");

    //Obtenemos los datos de la cuenta del archivo JSON.
    $estadoCuenta = Cuenta::getDatos();

    //Añadimos los valores a mostrar en un array.
    $saldoActual = $estadoCuenta["saldoActual"];
    $movimientos = $estadoCuenta["movimientos"];

    //Creamos un objeto con los datos de la cuenta bancaria, con el saldo actual.
    $cuenta = new Cuenta("Jorge", "Muñoz García", "45124434K", $saldoActual, activa:true);

    //Si se han enviado alguno de los dos formulario se modifica el array de movimientos y se reemplaza en el JSON.
    if(isset($_POST['ingresar']) && $_SERVER['REQUEST_METHOD'] == "POST"){
        $cantidadIngreso = $_POST['cantidad1'];
        $concepto = $_POST['concepto1'];

        $cuenta->ingresarDinero($cantidadIngreso, $concepto);
        header("Location: ./index.php");
    }

    if(isset($_POST['retirar']) && $_SERVER['REQUEST_METHOD'] == "POST"){
        $cantidadRetiro = $_POST['cantidad2'];
        $concepto = $_POST['concepto2'];
        
        $cuenta->retirarDinero($cantidadRetiro, $concepto);
        header("Location: ./index.php");
    }

    include_once("./View/Assets/Templates/Apertura.php");
?>
        <script>
            loadJSON();
        </script>

        <h1>Bienvenido de nuevo, <?php echo $cuenta->getNombre()?>!</h1>

        <div id="saldo">Saldo Actual: <?php echo $saldoActual; ?> euros</div>

<?php   
        include_once("./View/Assets/Templates/MovimientosForm.php");
        include_once("./View/Assets/Templates/MovimientosContainer.php");
    
    include_once("./View/Assets/Templates/Cierre.php");
?>

    