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