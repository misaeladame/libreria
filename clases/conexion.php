<?php 
    class conectar { 
        public function conexion(){
            $conexion = new PDO("mysql:host=localhost:3306;dbname=library_db","root","");
            return $conexion;
        }
    }
?>