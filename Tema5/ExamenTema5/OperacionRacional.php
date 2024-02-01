<?php

    include_once("./Racional.php");

/**
 * Class OperacionRacional
 * Realiza una operación racional
 */
class OperacionRacional extends Operacion{

    public function __construct($operacion) {
        parent::__construct($operacion);
    }

    /**
     * @param $fraccion
     * @return string
     * Simplifica la fraccion pasada por parametro, utilizando el mcd
     */
    // TODO: Completa el método
    public function simplifica($fraccion){

        // 1. - Separamos los operandos de una fracción
        $operandos = preg_split('/\//',$fraccion);
        $op1 = $operandos[0];
        $op2 = $operandos[1];

        // 2. - Calculamos el mcd 

        // 3. - Realizamos la simplificación

        // 4. - Devolvemos el resultado
        
    }

    /**
     * @param OperacionRacional $objeto
     * @return string
     * Separa los operandos para crear con ellos 2 objetos fraccion Racional
     * Y se encarga de llamar a la funcion necesaria para sumar,restar,etc.
     */
    // TODO: Implementa el método
    public function operacionRacional(OperacionRacional $objeto){

        // 1. - Separa los operandos de la operación entre fracciones

        // 2. - Crea los dos racionales con los operandos obtenidos

        // 3. - Comprueba el operador, realiza el calculo que corresponda y devuelve el resultado

        // PISTA:
        // - Tanto al separar operandos como al obtener el operador, 
        //   es muy importante el uso de getters.
    }
}
?>