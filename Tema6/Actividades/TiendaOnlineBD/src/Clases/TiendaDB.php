<?php
    class TiendaDB{
        public static function obtenerConexionBD(){
            $conexionBD = new mysqli("localhost", "root", "", "tiendaonline");

            if ($conexionBD->connect_error) {
                die("Error de conexión: " . $conexionBD->connect_error);
            }
            
            return $conexionBD;
        }
    }