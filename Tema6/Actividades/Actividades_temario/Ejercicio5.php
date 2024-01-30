<?php
    /*
        En el modo por defecto de gestión de transacciones no se pueden revertir los
        cambios usando rollback(), para ello se necesita desactivar el autocommit()
        asignandole un valor false antes de realizar las operaciones CRUD con query().
        
        Si esto se modifica, después de hacer las query pueden hacerse comprobaciones,
        sobre el usuario, por ejemplo, y si todo ha ido bien realizar el commit().
    */
?>