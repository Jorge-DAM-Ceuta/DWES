<?php

$cadenaCaracteres = "El abecedario completo es algo largo y detallarlo exhaustivamente es costoso";
echo "<h3>" . $cadenaCaracteres . "</h3>";

//10.1)
$vocalesA_Encontradas = substr_count($cadenaCaracteres, 'a') + substr_count($cadenaCaracteres, 'A');
$vocalesE_Encontradas = substr_count($cadenaCaracteres, 'e') + substr_count($cadenaCaracteres, 'E');
$vocalesI_Encontradas = substr_count($cadenaCaracteres, 'i') + substr_count($cadenaCaracteres, 'I');
$vocalesO_Encontradas = substr_count($cadenaCaracteres, 'o') + substr_count($cadenaCaracteres, 'O');
$vocalesU_Encontradas = substr_count($cadenaCaracteres, 'u') + substr_count($cadenaCaracteres, 'U');

echo "<h4>Numero de vocales contenidas en la cadena:</h4> A: " . $vocalesA_Encontradas  . ",&nbsp E: " . $vocalesE_Encontradas . ",&nbsp I: " . $vocalesI_Encontradas . ",&nbsp O: " . $vocalesO_Encontradas . ",&nbsp U:" . $vocalesU_Encontradas;

//10.2)
echo "<br><h4>Consonantes y número de apariciones:</h4>";

foreach(count_chars(strtolower($cadenaCaracteres), 1) as $valor => $contador){
    if(!(chr($valor) == ' ' || chr($valor) == 'a' || chr($valor) == 'e' || chr($valor) == 'i' || chr($valor) == 'o' || chr($valor) == 'u')){
        echo "<br>Hay $contador instancias de '" . chr($valor) . "' en la cadena.";    
    }
}

//10.3)
echo "<br><br><br><h3>Reemplazar todas las 'a' por '*' en la cadena:</h3>";
echo str_replace("a", "*", $cadenaCaracteres);

//10.4)
echo "<br><br><br><h3>Mostrar la cadena a partir de la palabra completo sin incluirla:</h3>";
$texto_Array = explode("completo", $cadenaCaracteres);
echo $texto_Array[1];
?>