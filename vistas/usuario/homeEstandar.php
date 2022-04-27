<!DOCTYPE html>
<html lang="en">
    <head>  
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <script src="https://kit.fontawesome.com/db04285c97.js" crossorigin="anonymous"></script>
        <?php require_once "scripts.php" ?>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" id="miHome" href="#">Inicio</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" id="catalogo" href="#">Catalogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="misPedidos" href="#">Mis Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="miInfo" onclick="mostrar()" href="#">Mi Información</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0 text-light">
                        <i class="fa fa-user-circle-o mr-1" aria-hidden="true"></i>
                            <?php 
                                session_start();
                                if(isset($_SESSION["usuario"]))
                                {
                                    echo "<a class='mr-sm-2'>".$_SESSION["usuario"]["name"]."</a>";
                                }                           
                            ?>
                            <a class="nav-link form-inline my-2 my-lg-0 btn btn-info" id="" href="../login/cerrarSesion.php">Cerrar Sesion</a>
                    </form>
            </div>
        </nav>
        <div id="container" class="container">
        <!-- Aqui es donde se cargan todos los apartados de la pagina -->
        </div>
    </body>
</html>

<script>
    $(document).ready(function() {
        $("#container").load("../inicio.php");
    });

    $('#miHome').click(function(){
        $("#container").load("../inicio.php");
    }); 

    $('#catalogo').click(function(){
        $("#container").load("../catalogo.php");
    }); 

    $('#misPedidos').click(function(){
        $("#container").load("misPedidos.php");
    }); 

    $('#miInfo').click(function(){
        $("#container").load("miInformacion.php");
    });
</script>