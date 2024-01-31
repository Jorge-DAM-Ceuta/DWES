<?php

    /*
        A. Si utilizas mysqli para establecer una conexión, ¿qué método usaras para utilizar otra base de datos?
            
            Para establecer una conexión con otra base de datos se usa el método select_db().

        B. ¿Cuál es la forma procedimental para establecer conexiones utilizando mysqli?
            
            La forma procedimental se realiza mediante los parámetros del la clase mysqli o con el método mysqli_connect().

        C. En mysqli, ¿de qué clase es el objeto que devuelve una llamada al método query?
            
            Para las consultas devuelve una instancia de la clase mysqli_result, en caso de una operación CRUD devuelve un valor booleano o un objeto mysqli_stmt si es una query preparada.

        D. En InnoDB por defecto cada consulta se incluye dentro de su propia transacción. ¿Cuál es el nombre de la función de mysqli que permite cambiar este comportamiento?
            
            Para cambiar el comportamiento de las ejecuciones automáticas de las sentencias query se usa el método autocommit() con el parámetro false. 

        E. ¿Qué clase debes utilizar si quieres ejecutar consultas preparadas en mysqli?
            
            Para iniciar la sentencia preparada hay que crear una variable con el objeto de la conexión mysqli y usar su método stmt_init().
            Para preparar una sentencia se usa la variable mencionada anteriormente con el método de la clase prepare() que recibe una operación CRUD.  
            Se pueden usar parámetros "?" o parámetros nombrados para pasarle los datos oportunos en cada sentencia preparada en el método prepare().
            Estos parámetros se le asignan mediante el método bind_param() indicando el tipo de dato y los datos que recibe.
            Para ejecutar la sentencia preparada se usa el método de la clase execute() mediante la variable que se obtuvo con stmt_init().
            Por último se debe usar el método close() tanto para esta variable como para el objeto de conexión mysqli cuando se termine de usar.

        F. En mysqli, ¿cuál debe ser el valor del parámetro del método fetch_array para que devuelva un array asociativo?
            
            Para que devuelva un array asociativo se debe pasar por parámetro el valor MYSQLI_ASSOC.
    */

?>