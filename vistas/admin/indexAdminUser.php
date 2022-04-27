<div class="container mt-4">
    <div class="row">
        <div class="col-sm-12">
            <div class="card border-dark">
                <div class="card-header text-center font-weight-bold">
                    REGISTRAR USUARIO
                </div>
                <div class="card-body text-center">
                    <span class="btn btn-danger alignt-center font-italic" data-toggle="modal" data-target="#addUserModal">Agregar Usuario</span>
                    <hr>    
                </div>
                <div class="card-body">
                    <div id ="dataTableUser"></div>
                </div>
                <div class="card-footer text-muted text-center">
                    LIBRO USADO
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal para agregar un usuario (admin)-->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmnuevo">
                    <label for="">Nombre(s)</label>
                    <input type="text" class="form-control input-sm" id="name" name="name">
                    <label for="">Apellido(s)</label>
                    <input type="text" class="form-control input-sm" id="last_name" name="last_name">
                    <label for="">Correo</label>
                    <input type="text" class="form-control input-sm" id="mail" name="mail" placeholder="tunombre@example.com">
                    <label for="">Teléfono</label>
                    <input type="text" class="form-control input-sm" id="cellphone" name="cellphone">
                    <label for="">Usuario</label>
                    <input type="text" class="form-control input-sm" id="user_name" name="user_name">
                    <label for="">Contraseña</label>
                    <div class="input-group" id="show_hide_password">
                        <input type="password" class="form-control input-sm" id="password" name="password">
                        <div class="input-group-addon">
                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <label for="">Confirmar Contraseña</label>
                    <div class="input-group" id="show_hide_password2" style="margin-bottom: 10px">
                        <input type="password" class="form-control input-sm" id="confirm_password" name="confirm_password">
                        <div class="input-group-addon">
                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                    </div>
                        <label for="">Administrador</label>
                        <br>
                        <select class="form-control input-sm" id="admin" name="admin">
                            <!-- <option selected disabled>Administrador</option> -->
                            <option value="0">No</option>
                            <option value="1">Si</option>
                        </select>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btnAgregarNuevo" class="btn btn-primary">Agregar Nuevo</button>
            </div>
		</div>
	</div>
</div>

<!-- Modal para editar un usuario (admin) -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmEditar">
                    <input type="text" hidden="" id="idUser" name="idUser">
                    <label for="">Nombre(s)</label>
                    <input type="text" class="form-control input-sm" id="nameU" name="nameU">
                    <label for="">Apellido(s)</label>
                    <input type="text" class="form-control input-sm" id="last_nameU" name="last_nameU">
                    <label for="">Correo</label>
                    <input type="text" class="form-control input-sm" id="mailU" name="mailU">
                    <label for="">Teléfono</label>
                    <input type="text" class="form-control input-sm" id="cellphoneU" name="cellphoneU">
                    <label for="">Administrador</label>
                    <select class="form-control input-sm" id="adminU" name="adminU">
                        <!-- <option selected disabled>Administrador</option> -->
                        <option value="0">No</option>
                        <option value="1">Si</option>
                    </select>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal" id="btnActualizar">Actualizar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	$(Document).ready(function(){	
        mostrar();        
    });

    function mostrar(){            
        $.ajax({
            type:"POST",
            url:"../../procesos/users/mostrarDatos.php",
            success:function(r){
                $('#dataTableUser').html(r);
            }
        });
    }
</script>

<script type="text/javascript">
	$(Document).ready(function(){

		$('#btnAgregarNuevo').click(function(){

            var datos=$('#frmnuevo').serialize();
        
            $.ajax({
                type:"POST",
                url:"../../procesos/users/agregarUser.php",
                data: datos,
                success:function(r){
                    console.log('agregar ->', r);
                    if(r==1){
                        $('#frmnuevo')[0].reset(); //limpiar el formulario
                        mostrar();
                        swal("Agregado con éxito.", "", "success");
                        $('#addUserModal').modal('hide');
                    } else {
                        swal("Error al agregar.", "", "error");
                    }
                }
	        });
		});

		$('#btnActualizar').click(function(){
			var datos=$('#frmEditar').serialize();
			 
			$.ajax({
				type:"POST",
				data: datos,
				url: "../../procesos/users/actualizarUserAdmin.php",
				success:function(r){
                console.log('editar ->', r);
                    if(r==1){
                        mostrar();
                        swal("Actualizado con éxito.", "", "success");

                    } else {
                        swal("Error al actualizar.", "", "error");
                    }
				}
			});
		});
	});
</script>

<script tipe="text/javascript">
	function obtenerDatos(id){
		$.ajax({
			type:"POST",
			data: "id=" + id,
			url: "../../procesos/users/obtenUser.php",
			success:function(r){
				datos=jQuery.parseJSON(r);
				$('#idUser').val(datos['id']);
				$('#nameU').val(datos['name']);
				$('#last_nameU').val(datos['last_name']);
                $('#mailU').val(datos['mail']);
                $('#cellphoneU').val(datos['cellphone']);
                $('#adminU').val(datos['isAdmin']);

			}
		});
	}

	function eliminarDatos(id){
        swal({
            title: "¿Estas seguro de eliminar este registro?",
            text: "Una vez eliminado no podra recuperarse.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
	    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type:"POST",
                    url:"../../procesos/users/eliminarUserAdmin.php",
                    data:"id=" + id,
                    success:function(r){
                        console.log('r->', r);
                        if(r=="true"){
                            mostrar();
                            swal("Eliminado con éxito.", "", "info");
                            $('#modalEditar').modal('hide');
                        } else {
                            swal("Error al eliminar.", "", "error");
                        }
                    }
                });
            
            } 
        });
	}
</script>