<?php
    require_once "../../clases/CrudUser.php";

    $datos = array('user_id' => $_POST['user_id'],
                   'book_id'=> $_POST['book_id']);

    echo CrudUser::newPedido($datos);
?>