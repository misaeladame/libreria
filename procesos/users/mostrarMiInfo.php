<?php 
    require_once "../../clases/CrudUser.php";

    $id=$_POST['id'];

    echo json_encode(CrudUser::getUser($id));
?>