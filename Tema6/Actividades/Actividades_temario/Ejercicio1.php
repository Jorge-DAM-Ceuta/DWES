<?php
    /*
        1. Se crea la base de datos con el conjunto de caracteres utf8 y una regla de ordenación del lenguaje español.

        2. Se selecciona la base de datos para realizar las siguientes operaciones sobre ella.
    
        3. Se crea la tabla tienda con la clave primaria "cod" usando el motor de almacenamiento InnoDB.
        
        4. Se crea la tabla producto con la clave primaria "cod", se le asigna un índice a "familia" y la pripiedad UNIQUE a "nombre_corto". 
        
        5. Se crea la tabla stock con la clave primaria compuesta por "producto" y "tienda".

        6. Se crean las claves foráneas para proporcionar relaciones entre las tablas. 
        La tabla "producto" referencia a la tabla "familia" y la tabla "stock" referencia a las tablas "tienda" y "producto".
        Se usa ON UPDATE CASCADE para que si se actualiza la clave en la tabla principal también se actualice en las que se hace referencia.

        7. Se crea el usuario "dwes" con la contraseña "abc123." y se le conceden todos los permisos sobre la base de datos "dwes".
    */
?>