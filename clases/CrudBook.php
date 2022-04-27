<?php 
    require_once "conexion.php";
    class CrudBook {

        public function getAllBooks(){
            $sql="SELECT b.id as idBook,b.title, b.isbn, b.author_id, b.genre_id, b.price, b.available, b.image, b.isBorrado AS estaBorrado, a.name AS autName, g.name as gName,a.id,g.id 
                  FROM books as b 
                  LEFT JOIN authors as a on b.author_id = a.id
                  LEFT JOIN genres as g on b.genre_id = g.id
                  WHERE b.isBorrado = 0
                  ORDER BY b.title";
                  
            $query=conectar::conexion()->prepare($sql);         
            $query->execute();
            return $query->fetchAll(); //con esto traemos todos los registros (fetch solo un renglon)
            $query->close();    
        }

        public function newBook($datos){           
            
            
            echo($datos['title']."<br>");
            echo($datos['isbn']."<br>");
            echo($datos['author_id'])."<br>";
            echo($datos['genre_id']."<br>");
            echo($datos['price'])."<br>";
            echo($datos['available']."<br>");
            echo($datos['image']['name']."<br>");

            if(move_uploaded_file($datos['image']["tmp_name"], '../../portadas/'.$datos['image']["name"])){
                $nameImage = $datos['image']["name"];
            } else {
                echo 'error';
            }
                                                                                         //,image                                                      // ,$nameImage')";
            $sql = "INSERT INTO books (title, isbn, author_id, genre_id, price, available, image, isBorrado) VALUES (:title,:isbn,:author_id,:genre_id,:price,:available ,:image,0)";  
            
            $query=conectar::conexion()->prepare($sql);   
            $query->bindParam(":title", $datos['title'], PDO::PARAM_STR);
            $query->bindParam(":isbn", $datos['isbn'], PDO::PARAM_INT);
            $query->bindParam(":author_id", $datos['author_id'], PDO::PARAM_INT);
            $query->bindParam(":genre_id", $datos['genre_id'], PDO::PARAM_INT);
            $query->bindParam(":price", $datos['price'], PDO::PARAM_STR);
            $query->bindParam(":available", $datos['available'], PDO::PARAM_INT);
            $query->bindParam(":image", $datos['image']['name'], PDO::PARAM_STR);
            return $query->execute();
            $query->close();       
        }

        public function getBook($id){

            $sql = "SELECT id,
                    title,
                    isbn,
                    author_id,
                    genre_id,
                    price,
                    available,
                    image,
                    isBorrado
                    FROM books
                    WHERE id='$id'";

            $query=conectar::conexion()->prepare($sql);  
            $query->bindParam(":id", $id, PDO::PARAM_INT);           
            $query->execute();
            return $query->fetch();
            $query->close();
        }

        public function updateBookImage($datos){

            if(move_uploaded_file($datos['image']["tmp_name"], '../../portadas/'.$datos['image']["name"])){
                $nameImage = $datos['image']["name"];
                $sqlI = "SELECT image FROM books WHERE id=:id";

                $query=conectar::conexion()->prepare($sqlI);         
                $query->bindParam(":id", $datos['id'], PDO::PARAM_INT);
                $query->execute();
                $imagen = $query->fetchAll();

                unlink('../../portadas/'.$imagen[0]["image"]);  

            } else {
                echo 'error';
            }

            $sql = "UPDATE books SET title =:title,
                                     isbn=:isbn,
                                     author_id=:author_id,
                                     genre_id=:genre_id,
                                     price=:price,
                                     available=:available,
                                     image=:image
                    WHERE id=:id";

            $query2=conectar::conexion()->prepare($sql);  
            $query2->bindParam(":title", $datos['title'], PDO::PARAM_STR);
            $query2->bindParam(":isbn", $datos['isbn'], PDO::PARAM_STR);
            $query2->bindParam(":author_id", $datos['author_id'], PDO::PARAM_INT);
            $query2->bindParam(":genre_id", $datos['genre_id'], PDO::PARAM_INT);
            $query2->bindParam(":price", $datos['price'], PDO::PARAM_STR);
            $query2->bindParam(":available", $datos['available'], PDO::PARAM_INT);
            $query2->bindParam(":image",  $datos['image']["name"], PDO::PARAM_STR);
            $query2->bindParam(":id", $datos['id'], PDO::PARAM_INT); 
            return $query2->execute();            
            $query2->close();    
        }

        public function updateBookNoImage($datos){        
            $sql = "UPDATE books SET title =:title,
                                     isbn=:isbn,
                                     author_id=:author_id,
                                     genre_id=:genre_id,
                                     price=:price,
                                     available=:available
                    WHERE id=:id";

            $query=conectar::conexion()->prepare($sql);  
            $query->bindParam(":title", $datos['title'], PDO::PARAM_STR);
            $query->bindParam(":isbn", $datos['isbn'], PDO::PARAM_STR);
            $query->bindParam(":author_id", $datos['author_id'], PDO::PARAM_INT);
            $query->bindParam(":genre_id", $datos['genre_id'], PDO::PARAM_INT);
            $query->bindParam(":price", $datos['price'], PDO::PARAM_STR);
            $query->bindParam(":available", $datos['available'], PDO::PARAM_INT);
            $query->bindParam(":id", $datos['id'], PDO::PARAM_INT);
            return $query->execute();
            $query->close();
        }

        public function deleteBook($id){
            $sql="UPDATE books SET isBorrado = 1, available = 0 WHERE id=:id";
            $query=conectar::conexion()->prepare($sql);
            $query->bindParam(":id", $id, PDO::PARAM_INT); 
            return $query->execute();
            $query->close();
        }

        public function getAllBooksFiltered($filters = null){

            $whereClause = "";

            if($filters["genreFilter"] != "NINGUN GÉNERO") {
                $filtro = $filters["genreFilter"];
                $whereClause .= "AND b.genre_id='$filtro'";
            }

            if($filters["authorFilter"] != "NINGUN AUTOR") {
                $authorFiltro = $filters["authorFilter"];
                $whereClause .= " AND b.author_id='$authorFiltro'";
            }

            if($filters["order"] != "NINGUN ORDEN") {
                $order = $filters["order"];
                $whereClause .= " ORDER BY $order";
            }

            $sql="SELECT b.id as idBook,b.title, b.isbn, b.author_id, b.genre_id, b.price, b.available, b.image, a.name AS autName, g.name as gName,a.id,g.id, b.isBorrado AS estaBorrado FROM books as b 
                  LEFT JOIN authors as a on b.author_id = a.id
                  LEFT JOIN genres as g on b.genre_id = g.id
                  WHERE 1 $whereClause";
                  
            $query=conectar::conexion()->prepare($sql);         
            $query->execute();
            return $query->fetchAll(); //con esto traemos todos los registros (fetch solo un renglon)
            $query->close();    
        }
    }
?>