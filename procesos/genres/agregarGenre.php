<?php 
    require_once "../../clases/CrudGenre.php";

    $datos=array('name' => $_POST['name']);
    
    echo CrudGenre::newGenre($datos);
?>