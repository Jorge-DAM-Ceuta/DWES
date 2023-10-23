<?php

$current = ["1", "3", "5", "7"]

/*while($variable = $current($a)){
    echo $variable;
    next($a);
}*/

/* No, la manera correcta es usar la función current($array). Como en el
ejercicio anterior, no haría falta usar una variable externa. Simplemente
indicando current($array) en la condición del bucle y dentro de él haciendo
next($array) funcionaría, para mostrar sus valores se usa echo key($array) 
para la clave si tuviera y echo current($array) para mostrar su valor. */ 
?>