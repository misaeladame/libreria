<?php 
    require_once "../../clases/CrudGenre.php";

    $datos=array('name' => $_POST['nameU'],
                'id' => $_POST['idGenre']);

    echo CrudGenre::updateGenre($datos);
?>