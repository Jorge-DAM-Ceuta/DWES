<?php 
//Esta clase se usará para realizar la conexión a la base de datos.
    abstract class BlogDB{
        private static $server = "localhost";
        private static $db = "blog";
        private static $user = "root";
        private static $password = "";

        public static function conectarDB(){
            try{
                $conexion = new PDO("mysql:host=" . BlogDB::$server . ";
                                    dbname=" . BlogDB::$db . ";
                                    charset=utf8", 
                                    BlogDB::$user, 
                                    BlogDB::$password);
            }catch(PDOException $error){
                echo "No se ha podido conectar con el servidor de la base de datos.";
                die("Error " . $error->getCode() . ": " . $error->getMessage());
            }    

            return $conexion;
        }
    }
?>