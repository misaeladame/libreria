<?php 
    require_once "../../clases/CrudBook.php";
    require_once "../../clases/CrudGenre.php";
    require_once "../../clases/CrudAuthor.php";

    $filters = array(
        "genreFilter" => $_POST["genreFilter"],
        "authorFilter" => $_POST["authorFilter"],
        "order" => $_POST["order"]
    );
    
    $datos = array(
        CrudBook::getAllBooksFiltered($filters),
        CrudGenre::getAllGenres(),
        CrudAuthor::getAllAuthors()
    );

    echo json_encode($datos);
?>