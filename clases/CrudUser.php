<?php 
    require_once "conexion.php";
    class CrudUser {

        public function getAllUsers(){

            $sql="SELECT * FROM users";
            $query=conectar::conexion()->prepare($sql);         
            $query->execute();
            return $query->fetchAll(); //con esto traemos todos los registros (fetch solo un renglon)
            $query->close();
        }

        public function newUser($datos){

            $sql="INSERT INTO users (name, last_name, mail, cellphone, user, password, isAdmin, isBorrado) VALUES (:name,:last_name,:mail,:cellphone,:user,:password,:isAdmin,0)";
            $pass = $datos['password'];    
            $passHash = password_hash($pass, PASSWORD_BCRYPT);

            $query=conectar::conexion()->prepare($sql);   
            $query->bindParam(":name", $datos['name'], PDO::PARAM_STR);
            $query->bindParam(":last_name", $datos['last_name'], PDO::PARAM_STR);
            $query->bindParam(":mail", $datos['mail'], PDO::PARAM_STR);
            $query->bindParam(":cellphone", $datos['cellphone'], PDO::PARAM_INT);
            $query->bindParam(":user", $datos['user'], PDO::PARAM_STR);
            $query->bindParam(":password", $passHash, PDO::PARAM_STR);
            $query->bindParam(":isAdmin", $datos['admin'], PDO::PARAM_INT);
            return $query->execute();
            $query->close();                                                 
        }

        public function getUser($id){

            $sql = "SELECT id,
                    name,
                    last_name,
                    mail,
                    cellphone,
                    user,
                    password,
                    isAdmin
                    FROM users
                    WHERE id=:id";

            $query=conectar::conexion()->prepare($sql);  
            $query->bindParam(":id", $id, PDO::PARAM_INT);           
            $query->execute();
            return $query->fetch();
            $query->close();
        }

        public function updateUserAdmin($datos){

          
            $sql = "UPDATE users SET name =:name,
                                     last_name=:last_name,
                                     mail=:mail,
                                     cellphone=:cellphone,
                                     isAdmin=:isAdmin
                    WHERE id=:id";    
                                
            $query=conectar::conexion()->prepare($sql);  
            $query->bindParam(":name", $datos['name'], PDO::PARAM_STR);
            $query->bindParam(":last_name", $datos['last_name'], PDO::PARAM_STR);
            $query->bindParam(":mail", $datos['mail'], PDO::PARAM_STR);
            $query->bindParam(":cellphone", $datos['cellphone'], PDO::PARAM_INT);
            $query->bindParam(":isAdmin", $datos['isAdmin'], PDO::PARAM_INT);
            $query->bindParam(":id", $datos['id'], PDO::PARAM_INT); 
            return $query->execute();
            $query->close();
        }

        public function updateUserInfo($datos){

                $sql = "UPDATE users SET name =:name,
                                        last_name=:last_name,
                                        mail=:mail,
                                        cellphone=:cellphone,
                                        isAdmin=:isAdmin
                                        -- user=:user
                        WHERE id=:id";

                $query=conectar::conexion()->prepare($sql);  
                var_dump('sql=',$query);
                $query->bindParam(":name", $datos['name'], PDO::PARAM_STR);
                $query->bindParam(":last_name", $datos['last_name'], PDO::PARAM_STR);
                $query->bindParam(":mail", $datos['mail'], PDO::PARAM_STR);
                $query->bindParam(":cellphone", $datos['cellphone'], PDO::PARAM_INT);
                $query->bindParam(":isAdmin", $datos['isAdmin'], PDO::PARAM_INT);
                $query->bindParam(":id", $datos['id'], PDO::PARAM_INT);     
                return $query->execute();
                $query->close();
        }

        public function deleteUser($id){
            $sql="UPDATE users SET isBorrado = 1 WHERE id=:id";
            $query=conectar::conexion()->prepare($sql);
            $query->bindParam(":id", $id, PDO::PARAM_INT); 
            return $query->execute();
            $query->close();
        }

        public function newPedido($datos){
            $sql="INSERT INTO users_books (user_id, book_id, date) VALUES (:user_id, :book_id, :date)";
            // $date = date('Y-m-d');
            // date_default_timezone_set("America/Mexico");
            $date = date('Y-m-d');
            $query=conectar::conexion()->prepare($sql);   
            $query->bindParam(":user_id", $datos['user_id'], PDO::PARAM_INT);
            $query->bindParam(":book_id", $datos['book_id'], PDO::PARAM_INT);
            $query->bindParam(":date", $date, PDO::PARAM_STR);
            return $query->execute();
            $query->close();                                                 
        }

        public function getPedido($id){

            $sql= "SELECT ub.book_id AS idBook, ub.user_id AS idUser, ub.date AS fecha, ub.status AS estatus, b.title AS titulo, b.image AS portada FROM users_books AS ub
                   LEFT JOIN books AS b on b.id = ub.book_id
                   WHERE ub.user_id =:id";
                  
            $query=conectar::conexion()->prepare($sql);  
            $query->bindParam(":id", $id, PDO::PARAM_INT);           
            $query->execute();
            return $query->fetchAll();
            $query->close();
        } 
    }
?>