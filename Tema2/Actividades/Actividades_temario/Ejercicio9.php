<?php

/* Usaría un bucle for para iterar la posición de la
cadena y mostrar el valor en cada posición */

$cadenaCaracteres = "Hola Caracola";

for($i = 0; $i<strlen($cadenaCaracteres); $i++){
    echo "<br>" . $cadenaCaracteres[$i];
}

?>