<?php 
    require_once "../../clases/CrudUser.php";

    $datos = array('name' => $_POST['name'],
                   'last_name' =>$_POST['last_name'],
                   'mail' =>$_POST['mail'],
                   'cellphone' =>$_POST['cellphone'],
                    'id' =>$_POST['id']);  
                               
    echo CrudUser::updateUserInfo($datos);
?>