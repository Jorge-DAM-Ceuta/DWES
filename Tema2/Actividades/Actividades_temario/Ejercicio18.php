<?php


$a[0] = 0;
$a[1] = "uno";
$a["tres"] = 3;

foreach($a as $clave => $valor){
    echo $clave . "=>" . $valor . "<br>";
}


/* No hay ningún problema, los array en PHP admiten todo tipo de valores y 
varibales, además no siempre deben contener una en concreto como en este caso.
Incluso no importa que la clave sea un número o un String, se muestran los 
valores de sus posiciones y en la clave se mantienen dos números y el String.
*/
?>