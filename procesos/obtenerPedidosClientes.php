<?php 
    require_once "../../clases/CrudUserBook.php";

    echo json_encode(CrudBookUser::getPedidos());
?>