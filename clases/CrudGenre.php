<?php 
    require_once "conexion.php";
    class CrudGenre extends conectar {

        public function getAllGenres(){
            $sql="SELECT * FROM genres WHERE isBorrado = 0 ORDER BY name ASC";
            $query=conectar::conexion()->prepare($sql);         
            $query->execute();
            return $query->fetchAll(); //con esto traemos todos los registros (fetch solo un renglon)
            $query->close();
        }

        public function newGenre($datos){

            $sql="INSERT INTO genres (name, isBorrado) VALUES (:name,0)";
            $query=conectar::conexion()->prepare($sql);   
            $query->bindParam(":name", $datos['name'], PDO::PARAM_STR);
            return $query->execute();
            $query->close();
        } 

        public function getGenre($id){
            $sql="SELECT id,
                         name,
                         isBorrado
                         FROM genres
                         WHERE id=:id";

            $query=conectar::conexion()->prepare($sql);  
            $query->bindParam(":id", $id, PDO::PARAM_INT);           
            $query->execute();
            return $query->fetch();
            $query->close();
        }

        public function updateGenre($datos){
            $sql="UPDATE genres SET name = :name  WHERE id=:id";

            $query=conectar::conexion()->prepare($sql);  
            $query->bindParam(":name", $datos['name'], PDO::PARAM_STR); 
            $query->bindParam(":id", $datos['id'], PDO::PARAM_INT); 
            return $query->execute();
            $query->close();
        }

        public function deleteGenre($id){
            $sql="UPDATE genres SET isBorrado = 1 WHERE id=:id";
            $query=conectar::conexion()->prepare($sql);
            $query->bindParam(":id", $id, PDO::PARAM_INT); 
            return $query->execute();
            $query->close();
        }

        public function getAllGenresFiltered($filters=null){
            $sql="SELECT id, name, isBorrado FROM genres ORDER BY name ASC";
            $query=conectar::conexion()->prepare($sql);         
            $query->execute();
            return $query->fetchAll(); //con esto traemos todos los registros (fetch solo un renglon)
            $query->close();
        }
    }
?>