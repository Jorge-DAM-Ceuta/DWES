<?php
    include_once("Assets/Templates/AperturaForm.php");

    if(isset($_GET["ok"]) && $_GET["ok"] == true){
        echo "<h2>Se ha publicado el artículo</h2>";  
?>   
        <script>eliminarMensaje()</script>
    <?php       
        }
    ?>

    <form action="../Controller/Controller.php" method="POST">
        <p>
            <label>Título:</label> 
            <br/>
            <input type="text" name="titulo">
        </p>

        <p>
            <label>Contenido:</label>
            <br/>
            <textarea type="text" name="contenido"></textarea>
        </p>

        <input type="submit" name="insertar" value="Publicar artículo">
    </form>
    
<?php
    include_once("Assets/Templates/Cierre.php");
?>
