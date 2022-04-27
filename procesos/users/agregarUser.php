<?php
    require_once "../../clases/CrudUser.php";

    $datos = array('name' => $_POST['name'],
                   'last_name' =>$_POST['last_name'],
                   'mail' =>$_POST['mail'],
                   'cellphone' =>$_POST['cellphone'],
                   'user' =>$_POST['user_name'],
                   'password' =>$_POST['password'],
                   'admin' =>$_POST['admin']);

    echo CrudUser::newUser($datos);
?>