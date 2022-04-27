<?php 
    require_once "conexion.php";
    class CrudAuthor extends conectar {

        public function getAllAuthors(){
            $sql="SELECT * FROM authors WHERE isBorrado = 0 ORDER BY name ASC";
            $query=conectar::conexion()->prepare($sql);         
            $query->execute();
            return $query->fetchAll(); //con esto traemos todos los registros (fetch solo un renglon)
            $query->close();
        }

        public function newAuthor($datos){

            $sql="INSERT INTO authors (name, isBorrado) VALUES (:name,0)";
            $query=conectar::conexion()->prepare($sql);   
            $query->bindParam(":name", $datos['name'], PDO::PARAM_STR);
            return $query->execute();
            $query->close();
        } 

        public function getAuthor($id){
            $sql="SELECT id,
                         name,
                         isBorrado
                         FROM authors
                         WHERE id=:id";

            $query=conectar::conexion()->prepare($sql);  
            $query->bindParam(":id", $id, PDO::PARAM_INT);           
            $query->execute();
            return $query->fetch();
            $query->close();
        }

        public function updateAuthor($datos){
            $sql="UPDATE authors SET name = :name  WHERE id=:id";

            $query=conectar::conexion()->prepare($sql);  
            $query->bindParam(":name", $datos['name'], PDO::PARAM_STR); 
            $query->bindParam(":id", $datos['id'], PDO::PARAM_INT); 

            return $query->execute();
            $query->close();
        }

        public function deleteAuthor($id){
            $sql="UPDATE authors SET isBorrado = 1 WHERE id=:id";
            $query=conectar::conexion()->prepare($sql);
            $query->bindParam(":id", $id, PDO::PARAM_INT); 
            return $query->execute();
            $query->close();
        }

        public function getAllAuthorsFiltered($filters=null){
            $sql="SELECT id, name, isBorrado FROM authors ORDER BY name ASC";
            $query=conectar::conexion()->prepare($sql);         
            $query->execute();
            return $query->fetchAll(); //con esto traemos todos los registros (fetch solo un renglon)
            $query->close();
        } 
    }
?>