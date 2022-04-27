<?php 
    require_once "../../clases/CrudBook.php";
    require_once "../../clases/CrudGenre.php";
    require_once "../../clases/CrudAuthor.php";
  
    $datos = array(
        CrudBook::getAllBooks(),
        CrudGenre::getAllGenres(),
        CrudAuthor::getAllAuthors()
    );

    echo json_encode($datos);
?>