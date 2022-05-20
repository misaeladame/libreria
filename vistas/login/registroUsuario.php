<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LIBRO USADO</title>
        <link rel="stylesheet" href="../../librerias/css/backgroundRegistroLogin.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet"> 
        
        <?php require_once "scripts.php" ?>


    </head>
    <body class="bodyRegistro">
        <div class="container mt-2">
            <div class="row">
                <div class="col-sm-4 offset-md-4">
                    <div class="card card-body text-white bg-dark mb-3">
                        <form class="" id="frmNewUser">
                            <label class="d-flex justify-content-center col-form-label-lg">Registrarse</label>
                            <div class="form-group">
                                <label class="col-form-label col-form-label-sm">Nombre(s)</label>
                                <input name= "name" type="text" class="form-control form-control-sm" id="name" required>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label col-form-label-sm">Apellido(s)</label>
                                <input name= "last_name" type="text" class="form-control form-control-sm" id="last_name" required>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label col-form-label-sm">Correo Electrónico</label>
                                <input name= "mail" type="email" class="form-control form-control-sm" id="mail" placeholder="tunombre@example.com" required>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label col-form-label-sm">Teléfono</label>
                                <input name= "cellphone" type="text" class="form-control form-control-sm" id="cellphone" required>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label col-form-label-sm">Usuario</label>
                                <input name= "user_name" type="text" class="form-control form-control-sm" id="user_name" required>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label col-form-label-sm">Contraseña</label>
                                <div class="input-group" id="show_hide_password">
                                    <input name="password" type="password" class="form-control form-control-sm" id="password" data-toggle="password" required>
                                    <small id="passwordHelpBlock" class="form-text text-muted">
                                        Su contraseña debe tener al menos 8 caracteres, un número y un carácter especial.
                                    </small>
                                    <div class="input-group-addon">
                                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label col-form-label-sm">Confirmar Contraseña</label>
                                <div class="input-group" id="show_hide_password2">
                                    <input name="confirm_password" type="password" class="form-control form-control-sm" id="confirm_password" data-toggle="password" required>
                                    <div class="input-group-addon">
                                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="admin" value="0">
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn btn-danger" id="btnSignUpUser">Registrarme</button>      
                                <a class="anclasRegistro" href="loginUsuario.php">Ingresar</a>
                            </div>   
                        </form>
                    </div>
                </div>
            </div> 
        </div>
    </body>
</html>

<script type="text/javascript">
	$(Document).ready(function(){
		$('#btnSignUpUser').click(function(){                
            function redireccionar(){
                window.location="loginUsuario.php";	
            } 
            var formData = new FormData();
            let name = $('#name').val();
            let last_name = $('#last_name').val();
            let mail = $('#mail').val();
            let cellphone = $('#cellphone').val();
            let user = $('#user_name').val();
            let password = $('#password').val();
            let confirm_password = $('#confirm_password').val();
            let admin = $('#admin').val();


            if(name=="" || last_name=="" || mail=="" || cellphone=="" || user=="" || password=="" || confirm_password==""){
                return swal("Rellene todo los campos.", "Vuelva a intentarlo.", "error");
            }

            if(password!=confirm_password){
                return swal("Las contraseñas no coinciden.", "Vuelva a intentarlo.", "error");
            }

            formData.append('name',name);
            formData.append('last_name',last_name);
            formData.append('mail',mail);
            formData.append('cellphone',cellphone);
            formData.append('user_name',user);
            formData.append('password',password);
            formData.append('admin',password);

            $.ajax({
				type:"POST",
				data: formData,
				url: "../../procesos/users/agregarUser.php",
                contentType: false,
                processData: false,
				success:function(res){
					console.log('r', res);
					if(res==1){
                        swal("Se ha registrado con exito.", "", "success");
						$('#frmNewUser')[0].reset();
                        setTimeout (redireccionar(), 000);  
                    }else {
                        swal("Error al registrarse.", "Intente de nuevo.", "error");
                    }
				}
            });    
		});
	});
</script>

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

    $("#show_hide_password2 a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password2 input').attr("type") == "text"){
            $('#show_hide_password2 input').attr('type', 'password');
            $('#show_hide_password2 i').addClass( "fa-eye-slash" );
            $('#show_hide_password2 i').removeClass( "fa-eye" );
        }else if($('#show_hide_password2 input').attr("type") == "password"){
            $('#show_hide_password2 input').attr('type', 'text');
            $('#show_hide_password2 i').removeClass( "fa-eye-slash" );
            $('#show_hide_password2 i').addClass( "fa-eye" );
        }
    });
});
</script>
