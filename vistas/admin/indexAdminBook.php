<?php 
    require_once "../../clases/conexion.php";
    require_once "../../clases/CrudAuthor.php";
    require_once "../../clases/CrudGenre.php";
    require_once "../../clases/CrudBook.php";

    $obj = new CrudAuthor();
    $sql = $obj->getAllAuthors();

    $obj2 = new CrudGenre();
    $sql2 = $obj2->getAllGenres();

    $obj3 = new CrudBook();
    $sql3 = $obj3->getAllBooks();
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-sm-12">
            <div class="card border-dark">
                <div class="card-header text-center font-weight-bold">
                    REGISTRAR LIBRO
                </div>
                <div class="card-body text-center">
                    <span class="btn btn-danger alignt-center font-italic" data-toggle="modal" data-target="#addBookModal">Agregar Libro</span>
                    <hr>    
                </div>
                <div class="card-body">
                    <div id ="dataTableBook"></div>
                </div>
                <div class="card-footer text-muted text-center">
                    LIBRO USADO
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal para agregar un libro-->
<div class="modal fade" id="addBookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Libro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmnuevo" enctype="multipart/form-data">
                    <label for="">Titulo</label>
                    <input type="text" class="form-control input-sm" id="title" name="title">
                    <label for="">ISBN</label>
                    <input type="text" class="form-control input-sm" id="isbn" name="isbn">

                    <label for="">Autor</label>
                    <select class="form-control" id="author_id" name="author_id">
                        <option selected disabled>Nombre...</option>
                        <?php
                            foreach($sql as $key => $value) {//abre while 
                        ?>
                        <option value="<?php echo $value[0]?>"><?php echo $value[1]?></option>        
                        <?php 
                            }
                        ?>
                    </select>
                    <label for="">Género</label>
                    <select class="form-control" id="genre_id" name="genre_id">
                        <option selected disabled>Tipo...</option>
                        <?php
                            foreach($sql2 as $key => $value2) {//abre while  
                        ?>
                        <option value="<?php echo $value2[0]?>"><?php echo $value2[1]?></option>     
                        <?php 
                            }
                        ?>
                    </select>
                    <label for="">Precio</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="price" name="price">
                    </div>  
                    <label for="">Disponibilidad</label>
                    <select class="form-control form-control-sm" id="available" name="available">
                        <option selected disabled>Disponible</option>
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                    <label for="">Portada</label>
                    <div class="input-group mb-3">
                        <div class="" id="customFile" lang="es">
                            <label class="" for="imagen" data-browse="Buscar"></label>
                            <input type="file" class="" id="image" name="image" aria-describedby="fileHelp">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btnAgregarNuevo" class="btn btn-primary">Agregar Nuevo</button>
            </div>
		</div>
	</div>
</div>
<!-- Modal para editar un libro-->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar Libro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmEditar" enctype="multipart/form-data">
                    <input type="text" hidden="" id="idBook" name="idBook">
                    <label for="">Titulo</label>
                    <input type="text" class="form-control input-sm" id="titleU" name="titleU">
                    <label for="">ISBN</label>
                    <input type="text" class="form-control input-sm" id="isbnU" name="isbnU">

                    <label for="">Autor</label>
                    <select class="form-control" id="author_idU" name="author_idU">
                        <option selected disabled>Nombre...</option>
                        <?php
                            foreach($sql as $key => $value3) {//abre while  
                        ?>
                        <option value="<?php echo $value3['id']?>"><?php echo $value3['name']?></option>                                
                        <?php 
                            }
                        ?>
                    </select>
                    <label for="">Género</label>
                    <select class="form-control" id="genre_idU" name="genre_idU">
                        <option selected disabled>Tipo...</option>
                        <?php
                            foreach($sql2 as $key => $value3) {//abre while                            
                        ?>                        
                        <option value="<?php echo $value3['id']?>"><?php echo $value3['name']?></option>                               
                        <?php 
                            }
                        ?>
                    </select>
                    <label for="">Precio</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="priceU">
                    </div>                    
                    <label for="">Disponibilidad</label>
                    <select class="form-control form-control-sm" id="availableU" name="availableU">
                        <option selected>Disponible</option>
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                    <label for="">Portada</label>
                    <div class="input-group mb-3">
                        <div class="" id="customFile" lang="es">
                            <label class="" for="image" data-browse="Buscar"></label>
                            <input type="file" class="" id="rutaU" name="imageU" aria-describedby="fileHelp">
                        </div>
                    </div>
                    <div>
                        <img src="" id="imgU" alt="" width="75px" height="75px" >
                    </div>
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
            url:"../../procesos/books/mostrarDatos.php",
            success:function(r){
                $('#dataTableBook').html(r);
            }
        });
    }
</script>


<script type="text/javascript">
	$(Document).ready(function(){

		$('#btnAgregarNuevo').click(function(){
            var formData = new FormData();
            let title = $('#title').val();
            let isbn = $('#isbn').val();
            let author = $('#author_id option:selected').val();
            let genre = $('#genre_id option:selected').val();
            let price = $('#price').val();
            let available = $('#available').val();
            let image = $('#image')[0].files[0];
            let idBook = $('#idBook').val();

            formData.append('title',title);
            formData.append('isbn',isbn);
            formData.append('author_id',author);
            formData.append('genre_id',genre);
            formData.append('price',price);
            formData.append('available',available);
            formData.append('image',image);
            formData.append('idBook',idBook);

            console.log(formData);
        
            $.ajax({
                type:"POST",
                url:"../../procesos/books/agregarBook.php",
                data:formData,
                contentType: false,
                processData: false,
                success:function(r){
                    console.log('r->', r);
                    if(r){
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
			var formData = new FormData();
            let id = $('#idBook').val();
            let titleU = $('#titleU').val();
            let isbnU = $('#isbnU').val();
            let authorU = $('#author_idU option:selected').val();
            let genreU = $('#genre_idU option:selected').val();
            let priceU = $('#priceU').val();
            let availableU = $('#availableU').val();
            let imagU = $('#rutaU')[0].files[0];

            if(typeof $('#rutaU')[0].files[0] === 'undefined' ){
                imagU = 1;

            } else {
             imagU = $('#rutaU')[0].files[0];
            }

            formData.append('titleU',titleU);
            formData.append('isbnU',isbnU);
            formData.append('author_idU',authorU);
            formData.append('genre_idU',genreU);
            formData.append('priceU',priceU);
            formData.append('availableU',availableU);
            formData.append('imageU',imagU);
            formData.append('idBook',id);

			$.ajax({
				type:"POST",
				data: formData,
                contentType: false,
                processData: false,
				url: "../../procesos/books/actualizarBookNoImage.php",
				success:function(r){
                    console.log('antes ->',r);
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
			url: "../../procesos/books/obtenBook.php",
			success:function(r){
				datos=jQuery.parseJSON(r);
				$('#idBook').val(datos['id']);
				$('#titleU').val(datos['title']);
				$('#isbnU').val(datos['isbn']);
                $('#author_idU').val(datos['author_id']);
                $('#genre_idU').val(datos['genre_id']);
                $('#priceU').val(datos['price']);
                $('#availableU').val(datos['available']);
                $('#imageU').val(datos['image']);

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
                    url:"../../procesos/books/eliminarBook.php",
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

			