<?php

$a = "-3.1416";

printf("La variable \'\$a\' vale %+.2f", $a);

/*En la función no detecta el valor de la variable en la cadena, su uso parece 
correcto ya que la sintaxis de la oración muestra el nombre de la variable pero 
si interpreta el valor %+.2f como que el número debe tener solo dos decimales. 

También valdría de esta manera: */

printf("<br>La variable '\$a' vale %+.2f", $a);

?>