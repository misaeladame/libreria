<?php 
    require_once "../../clases/CrudAuthor.php";

    $datos=array(
        'name' => $_POST['name']);
    
    echo CrudAuthor::newAuthor($datos);  
?>