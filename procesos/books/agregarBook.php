<?php
    require_once "../../clases/CrudBook.php";

    $datos = array('title' => $_POST['title'],
                   'isbn' =>$_POST['isbn'],
                   'author_id' =>$_POST['author_id'],
                   'genre_id' =>$_POST['genre_id'],
                   'price' =>$_POST['price'],
                   'available' =>$_POST['available'],
                   'image'=>$_FILES['image']);

    echo CrudBook::newBook($datos);
?>