<?php
    echo "<!DOCTYPE html>
          <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <link rel='stylesheet' href='Views/Assets/CSS/Index.css'>
                <script src='./Views/Assets/JS/Ajax.js'></script>
                <title>Blog</title>
            </head>
            <body>
            <header>
                <h1>Artículos de interés</h1>
                <a class='publicar' href='Views/InsertarForm.php'>Publicar artículo</a>            
            </header>
            
            <div id='filtro'>
                <input type='text' id='busqueda' oninput='filtrarArticulos()' placeholder='Buscar artículo...'>
            </div>
            
            <div id='articulos-lista'>";
?>