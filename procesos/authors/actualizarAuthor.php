<?php 
    require_once "../../clases/CrudAuthor.php";

    $datos=array('name' => $_POST['nameU'],
                'id' => $_POST['idAuthor']);

    echo CrudAuthor::updateAuthor($datos);
?>