<?php

    /* 
        Si programas tu aplicación correctamente utilizando "beginTransaction" antes de realizar un cambio, ¿siempre será posible revertirlo utilizando "rollback"? Justifica tu respuesta.
    
            En caso de que no se haya confirmado la transacción mediante el método commit() si se puede usar rollback() para revertir los cambios.
            El método beginTransaction() solo prepara e inicia la transacción pero no la confirma.
    */

?>