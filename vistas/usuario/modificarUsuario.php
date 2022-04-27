<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LIBRO USADO</title>
        <link rel="stylesheet" href="librerias/css/estilos.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet"> 
        <?php require_once "scripts.php" ?>
    </head>
    <body class="bodyRegistro">
        <div class="container mt-2">
            <div class="row">
                <div class="col-sm-4 offset-md-4">
                    <div class="card card-body text-white bg-dark mb-3">
                        <form class="" id="frmUpdateUser">
                            <label class="d-flex justify-content-center col-form-label-lg">Modificar Mis Datos</label>
                            <div class="form-group">
                                <label class="col-form-label col-form-label-sm">Nombre(s)</label>
                                <input name= "name" type="text" class="form-control form-control-sm" id="name">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label col-form-label-sm">Apellido(s)</label>
                                <input name= "last_name" type="text" class="form-control form-control-sm" id="last_name">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label col-form-label-sm">Correo Electrónico</label>
                                <input name= "mail" type="email" class="form-control form-control-sm" id="mail" placeholder="tunombre@example.com">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label col-form-label-sm">Teléfono</label>
                                <input name= "cellphone" type="text" class="form-control form-control-sm" id="cellphone">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label col-form-label-sm">Usuario</label>
                                <input name= "user_name" type="text" class="form-control form-control-sm" id="user_name">
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn btn-danger" id="btnActualizar">Actualizar</button>      
                                <a class="anclasRegistro" href="recuperarContraseña.php">Olvidaste tu contraseña?</a>
                            </div>   
                        </form>
                    </div>
                </div>
            </div> 
        </div>
    </body>
</html>

<script tipe="text/javascript">
	function agregaFrmActualizar(idUser){
		$.ajax({
			type:"POST",
			data: "idUser=" + idUser,
			url: "procesos/users/obtenUser.php",
			success:function(r){
				datos=jQuery.parseJSON(r);
				$('#idUser').val(datos['id']);
                $('#nameU').val(datos['name']);
                $('#last_nameU').val(datos['last_name']);
                $('#mailU').val(datos['mail']);
                $('#cellphoneU').val(datos['cellphone']);
			}
		});
	}
</script>

