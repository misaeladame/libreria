<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LIBRO USADO</title>
        <link rel="stylesheet" href="../../librerias/css/estilos.css">
        <?php require_once "scripts.php" ?>
    </head>
    <body class="bodyRegistro">
        <div class="container">
            <?php 
                include '../../clases/login.php';
                $db = new Login();
                extract($_POST);
                $db->verificaLogin("$user_name","$password");              
            ?>
        </div>
    </body>
</html>