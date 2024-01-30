<?php

    /*
        __construct(): Este método se llama automáticamente cuando se crea un nuevo objeto de 
        una clase. Se usa para inicializar los atributos y mediante una serie de parámetros.

        __destruct(): Este método se llama automáticamente cuando un objeto es destruido o se
        elimina. Se usa para liberar recursos en memoria, cerrar conexiones, etc... 
        
        __get(): Se usa para acceder a un atributo no accesible directamente desde fuera de la 
        clase si estas son private. Permite realizar operaciones antes de devolver su valor.
        
        __set(): Se usa para asignar un valor a un atributo no accesible directamente desde 
        fuera de la clase.
        
        __isset(): Se llama al usar la función isset() en un atributo no accesible 
        directamente desde fuera de la clase. Permite personalizar la comprobación.
        
        __unset(): Se llama al usar la función unset() en un atributo no accesible
        directamente desde fuera de la clase. Permite personalizar la comprobación.
        
        __toString(): Se llama automáticamente cuando se intenta hacer un echo de un objeto.
        Este devuelve un string personalizable que representa el estado del objeto mostrando
        las propiedades que se requieran.
        
    */  

    class MiClase {
        private $propiedades = array();
    
        public function __construct() {
            echo "Se ha creado un nuevo objeto.\n";
        }
    
        public function __destruct() {
            echo "El objeto ha sido destruido.\n";
        }
    
        public function __get($propiedad) {
            echo "Intento de acceso a la propiedad no existente: $propiedad.\n";
            return isset($this->propiedades[$propiedad]) ? $this->propiedades[$propiedad] : null;
        }
    
        public function __set($propiedad, $valor) {
            echo "Intento de asignar el valor $valor a la propiedad no existente: $propiedad.\n";
            $this->propiedades[$propiedad] = $valor;
        }
    
        public function __isset($propiedad) {
            echo "¿Existe la propiedad $propiedad?\n";
            return isset($this->propiedades[$propiedad]);
        }
    
        public function __unset($propiedad) {
            echo "Intento de eliminar la propiedad no existente: $propiedad.\n";
            unset($this->propiedades[$propiedad]);
        }
    
        public function __toString() {
            return "Representación en cadena de la clase MiClase.\n";
        }
    }
    
    $objeto = new MiClase();
    
    $objeto->propiedad1 = "Valor de la propiedad 1";
    echo $objeto->propiedad1 . "\n";
    
    echo isset($objeto->propiedad2) ? "La propiedad2 existe.\n" : "La propiedad2 no existe.\n";
    
    unset($objeto->propiedad1);
    
    echo $objeto;
?>