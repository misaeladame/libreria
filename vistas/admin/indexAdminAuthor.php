
<div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-sm-8 offset-md-2">
                <div class="card border-dark">
                    <div class="card-header text-center font-weight-bold">
                        REGISTRAR AUTOR
                    </div>
                    <div class="card-body text-center">
                        <span class="btn btn-danger alignt-center font-italic" data-toggle="modal" data-target="#addAuthorModal">Agregar Autor</span>
                        <hr>    
                    </div>
                    <div class="card-body">
                        <div id="dataTableAuthor"></div>
                    </div>
                    <div class="card-footer text-muted text-center">
                        LIBRO USADO
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Modal para agregar un autor-->
    <div class="modal fade" id="addAuthorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Autor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmnuevo">
                        <label for="">Nombre</label>
                        <input type="text" class="form-control input-sm" id="name" name="name">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" id="btnAgregarNuevo" class="btn btn-primary">Agregar Nuevo</button>
                </div>
            </div>
        </div>
    </div>
<!-- Modal para editar un autor-->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizar Autor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmEditar">
                            <input type="text" hidden="" id="idAuthor" name="idAuthor">
                            <label for="">Nombre</label>
                            <input type="text" class="form-control input-sm" id="nameU" name="nameU">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal" id="btnActualizar">Actualizar</button>
                </div>
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
            type:"GET",
            url:"../../procesos/authors/mostrarDatos.php",
            success:function(r){
                $('#dataTableAuthor').html(r);
            }
        });
    }
</script>

<script type="text/javascript">
	$(Document).ready(function(){

		$('#btnAgregarNuevo').click(function(){

        //LLAMADAS ASYNCRONAS
            $.ajax({
                type:"POST",
                url:"../../procesos/authors/agregarAuthor.php",
                data:$('#frmnuevo').serialize(),
                success:function(r){
                    console.log('r->', r);
                    if(r==1){
                        $('#frmnuevo')[0].reset(); //limpiar el formulario
                        mostrar();
                        swal("Agregado con éxito.", "", "success");
                        $('#addAuthorModal').modal('hide');
                    } else {
                        swal("Error al agregar.", "", "error");
                    }
                }
	        });
            $('#addAuthorModal').modal('hide');
		});

		$('#btnActualizar').click(function(){
			var datos=$('#frmEditar').serialize();
			 
			$.ajax({
				type:"POST",
				data: datos,
				url: "../../procesos/authors/actualizarAuthor.php",
				success:function(r){
					console.log('r->', r);
                    if(r==1){
                        mostrar();
                        swal("Actualizado con éxito.", "", "success");
                        $('#modalEditar').modal('hide');
                    } else {
                        swal("Error al agregar.", "", "error");
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
			url: "../../procesos/authors/obtenAuthor.php",
			success:function(r){
				datos=jQuery.parseJSON(r);
				$('#idAuthor').val(datos['id']);
				$('#nameU').val(datos['name']);
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
                    url:"../../procesos/authors/eliminarAuthor.php",
                    data:"id=" + id,
                    success:function(r){
                        console.log('r->', r);
                        if(r=="true"){
                            mostrar();
                            swal("Eliminado con éxito.", "", "info");
                        } else {
                            swal("Error al eliminar.", "", "error");
                        }
                    }
                });
            } 
        });
	}
</script>