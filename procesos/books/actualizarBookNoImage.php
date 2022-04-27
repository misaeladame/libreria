<?php 
    require_once "../../clases/CrudBook.php";

    if(isset($_POST['imageU'])){
        $datos = array(
            'title' => $_POST['titleU'],
            'isbn' =>$_POST['isbnU'],
            'author_id' =>$_POST['author_idU'],
            'genre_id' =>$_POST['genre_idU'],
            'price' =>$_POST['priceU'],
            'available' =>$_POST['availableU'],
            'id' =>$_POST['idBook']);

            echo CrudBook::updateBookNoImage($datos);
            
    } else {
        $datos = array(
        'title' => $_POST['titleU'],
        'isbn' =>$_POST['isbnU'],
        'author_id' =>$_POST['author_idU'],
        'genre_id' =>$_POST['genre_idU'],
        'price' =>$_POST['priceU'],
        'available' =>$_POST['availableU'],
        'image'=>$_FILES['imageU'],
        'id'=>$_POST['idBook']);

        echo CrudBook::updateBookImage($datos);
    }
?>