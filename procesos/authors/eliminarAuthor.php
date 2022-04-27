<?php
    require_once "../../clases/CrudAuthor.php";

    $id= $_POST['id'];

    echo json_encode(CrudAuthor::deleteAuthor($id));
 ?>