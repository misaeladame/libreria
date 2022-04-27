<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LIBRO USADO</title>
        <link rel="stylesheet" href="../../librerias/css/backgroundRegistroLogin.css">
        <?php require_once "scripts.php" ?>
    </head>

    <body class="bodyRegistro">
        <div class="container mt-2">
            <div class="row">
                <div class="col-sm-4 offset-md-4">
                    <div class="card card-body text-white bg-dark mb-3">
                        <form class="" id="frmLoginUser" action="verificaLogin.php" method="post">
                            <label class="d-flex justify-content-center col-form-label-lg">Ingresar</label>
                            <div class="form-group">
                                <label class="col-form-label col-form-label-sm">Usuario</label>
                                <input name= "user_name" type="text" class="form-control form-control-sm" id="user_name">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label col-form-label-sm">Contraseña</label>
                                <div class="input-group" id="show_hide_password">
                                    <input name="password" type="password" class="form-control form-control-sm" id="password" data-toggle="password">
                                    <div class="input-group-addon">
                                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-danger" id="btnLoginUser">Entrar</button>   
                                <a class="anclasRegistro" href="registroUsuario.php">Registrarse</a>
                            </div>   
                        </form>
                    </div>
                </div>
            </div> 
        </div>
    </body>
</html>

<script>
    $(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });  
});
</script>

