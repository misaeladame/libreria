<?php
    require_once "conexion.php";
    class CrudUserBook{
        public function getPedidos(){

            $sql= "SELECT ub.book_id AS idBook, ub.user_id AS idUser, u.name AS nombre, u.last_name AS apellido, ub.date AS fecha, ub.status AS estatus, ub.id AS idPedido, b.title AS titulo, b.image AS portada, b.isBorrado AS estaBorrado FROM users_books AS ub
                   LEFT JOIN books AS b on b.id = ub.book_id
                   LEFT JOIN users AS u on u.id = ub.user_id";
         
            $query=conectar::conexion()->prepare($sql);          
            $query->execute();
            return $query->fetchAll();
            $query->close();
        }

        public function updatePedido($id){
            
            $sql = "UPDATE users_books SET status=1
                    WHERE id=:id";

            $query=conectar::conexion()->prepare($sql);
            $query->bindParam(":id", $id, PDO::PARAM_INT); 
            return $query->execute();
            $query->close();
        }
    }
?>