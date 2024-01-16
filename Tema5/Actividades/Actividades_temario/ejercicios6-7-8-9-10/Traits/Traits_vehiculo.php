<?php

    trait EsDescapotable{
        public function accionarCapota(){
            echo "<h2>Se ha accionado la capota</h2>";
        }
    }

    trait EsManual{
        public function cambiarMarcha(string $marcha){
            echo "<h2>Se ha cambiado la marcha a $marcha</h2>";
        }
    }

    trait PuedeDerrapar{
        public function derrapar(){
            echo "<h2>El vehículo está derrapando</h2>";
        }
    }

?>