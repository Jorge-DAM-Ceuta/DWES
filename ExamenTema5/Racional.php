<?php
class Racional extends Operacion{

    private $num;
    private $den;

    /**
     * Racional constructor.
     * @param $num
     * @param $den
     * Si el denominador esta vacio, dependiendo del valor de num dara un valor u otro.
     */
    // TODO: Implementa el constructor 
    public function __construct($num, $den){
        $this->num = $num;
        $this->den = $den;

        if($num <= 0 && $den > 0){
            $this->num = $num;
            $this->den = $num/1;
        }else if($num <= 0 && $den <= 0){
            $this->num = 1/1;
            $this->den = 1/1;
        }
    }

    /**
     * @param Racional $b
     * @return string
     * Calcula la suma de dos fracciones
     */
    // TODO: Completa el método
    public function suma (Racional $b) {
        $nuevo = new self(1, 1);

        // 1. - Calcular numerador
        $nuevoNum = $this->num * $b->getDen();
        // 2. - Calcular denominador  
        $nuevoDen = $this->den * $b->getNum();

        //Si tienen el mismo denominador
        if($this->den == $b->getDen()){
            $nuevoDen = $this->den;
            $nuevoNum = $this->num + $b->getNum();
        }

        // 3. - Crear un nuevo racional
        $nuevo = new self($nuevoNum, $nuevoDen);

        // 4. - Devolver el resultado 
        return $nuevo->getNum() . "/" . $nuevo->getDen();
    }

    /**
     * @param Racional $b
     * @return string
     * Calcula la resta de dos fracciones
     */
    // TODO: Implementa el método
    public function resta (Racional $b){
        $nuevo = new self(1, 1);

        // 1. - Calcular numerador
        $num1 = $this->num * $b->getDen();
        $num2 = $this->den * $b->getNum();

        $nuevoNum = $num1 - $num2;
        // 2. - Calcular denominador  
        $nuevoDen = $this->den * $b->getNum();



        //Si tienen el mismo denominador
        if($this->den == $b->getDen()){
            $nuevoDen = $this->den;
            $nuevoNum = $this->num - $b->getNum();
        }

        //Si tienen el mismo numerador
        if($this->num == $b->getNum()){
            $nuevoDen = $this->den * $b->getDen();
            $nuevoNum = 0;
        }

        // 3. - Crear un nuevo racional
        $nuevo = new self($nuevoNum, $nuevoDen);

        // 4. - Devolver el resultado 
        return $nuevo->getNum() . "/" . $nuevo->getDen();
    }

    /**
     * @param Racional $b
     * @return string
     * Calcula la multiplicacion de dos fracciones
     */
    // TODO: Implementa el método
    public function multiplicar (Racional $b){
        $nuevo = new self(1, 1);

        // 1. - Calcular numerador
        $nuevoNum = $this->num * $b->getNum();
        // 2. - Calcular denominador  
        $nuevoDen = $this->den * $b->getDen();

        // 3. - Crear un nuevo racional
        $nuevo = new self($nuevoNum, $nuevoDen);

        // 4. - Devolver el resultado 
        return $nuevo->getNum() . "/" . $nuevo->getDen();
    }

    /**
     * @param Racional $b
     * @return string
     * Calcula la division de dos fracciones
     */
    // TODO: Implementa el método
    public function dividir (Racional $b){
        $nuevo = new self(1, 1);

        // 1. - Calcular numerador
        $nuevoNum = $this->num * $b->getNum();
        // 2. - Calcular denominador  
        $nuevoDen = $this->den * $b->getDen();

        //MCD
        //.........

        // 3. - Crear un nuevo racional
        $nuevo = new self($nuevoNum, $nuevoDen);

        // 4. - Devolver el resultado 
        return $nuevo->getNum() . "/" . $nuevo->getDen();
    }

    /**
     * @return mixed
     * Getters y Setters
     */

    public function getNum(){
        return $this->num;
    }

    public function setNum($num){
        $this->num = $num;
    }

    public function getDen(){
        return $this->den;
    }

    public function setDen($den){
        $this->den = $den;
    }

}
?>