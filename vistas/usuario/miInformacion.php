<?php   
    session_start();
    $user_id = $_SESSION["usuario"]['id'];
?>  
<div class="container mt-2">
        <div class="row">
            <div class="col-sm-4 offset-md-4">
                <div class="card card-body text-dark bg-light mb-3">
                    <form class="" id="frmMiInformacion" //onsubmit="mostrarModal()">
                        <label class="d-flex justify-content-center col-form-label-lg">Información Personal</label>
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">Nombre(s)</label>
                            <input name= "name" type="text" class="form-control form-control-sm" id="name" disabled>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">Apellido(s)</label>
                            <input name= "last_name" type="text" class="form-control form-control-sm" id="last_name" disabled>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">Correo Electrónico</label>
                            <input name= "mail" type="email" class="form-control form-control-sm" id="mail" placeholder="tunombre@example.com" disabled>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label col-form-label-sm">Teléfono</label>
                            <input name= "cellphone" type="text" class="form-control form-control-sm" id="cellphone" disabled>
                        </div>
                        <div class="d-flex justify-content-center">
                            <span type="button" class="btn btn btn-warning" id="btnEditarInfo" data-toggle="modal" data-target="#modalEditar">Editar</span>      
                        </div>  
                    </form>
                </div>
            </div>
        </div> 
    </div>

<!-- Modal para editar un usuario (estandar)-->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar Información</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmEditar" onsubmit="mostrarForm()">
                    <input type="text" hidden="" id="idUser" name="idUser">
                    <label for="">Nombre(s)</label>
                    <input type="text" class="form-control input-sm" id="nameU" name="nameU">
                    <label for="">Apellido(s)</label>
                    <input type="text" class="form-control input-sm" id="last_nameU" name="last_nameU">
                    <label for="">Correo</label>
                    <input type="text" class="form-control input-sm" id="mailU" name="mailU">
                    <label for="">Teléfono</label>
                    <input type="text" class="form-control input-sm" id="cellphoneU" name="cellphoneU">
                    <input type="hidden" name="adminU" value="0">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal" id="btnActualizar" onclick="mostrarModal()">Actualizar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	$(Document).ready(function(){	
        mostrarModal();        
    });

    function mostrarModal(){

        let user_id = '<?php echo $user_id;?>'
		$.ajax({
			type:"POST",
			data: "id=" + user_id,
			url: "../../procesos/users/obtenUser.php",
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

<script type="text/javascript">
	$(Document).ready(function(){	
        mostrarForm();        
    });

    function mostrarForm(){

        let user_id = '<?php echo $user_id;?>'
		$.ajax({
			type:"POST",
			data: "id=" + user_id,
			url: "../../procesos/users/obtenUser.php",
			success:function(r){
				datos=jQuery.parseJSON(r);
				$('#idUser').val(datos['id']);
				$('#name').val(datos['name']);
				$('#last_name').val(datos['last_name']);
                $('#mail').val(datos['mail']);
                $('#cellphone').val(datos['cellphone']);
			}
		});
	}
</script>

<script>
$('#btnActualizar').click(function(){ 
    var formData = new FormData();
        let id = '<?php echo $user_id;?>'
        let name = $('#nameU').val();
        let last_name = $('#last_nameU').val();
        let mail = $('#mailU').val();
        let cellphone = $('#cellphoneU').val();
        let admin = $('#adminU').val();
        
        formData.append('name',name);
        formData.append('last_name',last_name);
        formData.append('mail',mail);
        formData.append('cellphone',cellphone);  
        formData.append('admin',admin); 
        formData.append('id',id);

        $.ajax({
			    type:"POST",
				data: formData,
				url: "../../procesos/users/actualizarUserInfo.php",
                contentType: false,
                processData: false,
				success:function(res){
					if(res!=1){
						swal("Información actualizada con éxito.", "", "success");
                        $('#modalEditar').modal('hide');
                    }else {
                        swal("Error al actualizar información.", "Intente de nuevo.", "error");
                    }
				}
        }); 
});
</script>