<?php 
    require_once "../../clases/CrudBook.php";

    $id=$_POST['id'];

    echo json_encode(CrudBook::getBook($id));
?>