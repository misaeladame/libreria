<?php 
    require_once "../../clases/CrudUser.php";

    $datos = array('name' => $_POST['nameU'],
                   'last_name' =>$_POST['last_nameU'],
                   'mail' =>$_POST['mailU'],
                   'cellphone' =>$_POST['cellphoneU'],
                   'isAdmin'  =>$_POST['adminU'],
                    'id' =>$_POST['idUser']);

    echo CrudUser::updateUserAdmin($datos);
?>