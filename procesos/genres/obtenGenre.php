<?php 
    require_once "../../clases/CrudGenre.php";

    $id=$_POST['id'];

    echo json_encode(CrudGenre::getGenre($id));
?>