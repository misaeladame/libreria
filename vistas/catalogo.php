<?php
    session_start();
?>

<style>
    .card-custom{
        border-color: #685b5b;
        border-style: solid;
        border-width: 1px;
    }
    #cardTamaño{
        display: flex;
    }
</style>

<div class="modal" tabindex="-1" role="dialog" id="modalBook">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <div class="text-center"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <input type="text" id="in" type="hidden">
                <input type="text" id="im" type="hidden">
                <button type="button" class="btn btn-primary" onclick="confirmarLibro()">Confirmar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-md-2">
        <label class="text-success">Ordenar Por</label>
        <select id="order" class="form-control form-control-sm">
            <option value="b.title">Titulo</option>
            <option value="b.price">Precio</option>
            <option value="gName">Género</option>
            <option value="autName">Autor</option>
        </select>
    </div>
    <div id="genreSelect" class="col-md-4 ">
    <!-- Aqui van los selectores para los generos -->
    </div>
    <div id="authorSelect" class="col-md-4">
    <!-- Aqui van los selectores para los autores -->
    </div>
    <div class="col-md-2 d-flex align-items-end">
        <button id="btnFiltrar" type="button" class="btn btn-dark" onclick="filtrarLibros()" >Filtrar</button>    
    </div>
</div>

    <div id="bookContainer" class="row mt-5"> 
    <!-- Aqui cargan todas las cartas con la informacion de los libros -->
    </div>            
<script>
    

    $(document).ready(function(){	
        getAllData();
    });

    function getAllData() {       

        var userId = '<?php echo $_SESSION['usuario']['id'];?>';
        var tipoUsuario= '<?php echo $_SESSION['usuario']['isAdmin'];?>';

        $.ajax({
			type:"POST",
			contentType: false,
			processData: false,
			url: "../../procesos/books/getAllData.php",
			success:function(r){
				let datos=jQuery.parseJSON(r);

                //Selector de generos
                var genres = datos[1];
                var genreSelect = '<label class="text-primary">Filtrar Por Género</label> <select class="form-control form-control-sm" searchable="Search here.."><option>NINGUN GÉNERO</option>';
                var option = '';
                $.each(genres,function(index,genre){
                    if(genre.isBorrado==0)
                    {
                        option += '<option value="'+genre.id+'">'+genre.name+'</option>';
                    }
                })
                var finalGenre = genreSelect + option + '</select>';      
                $("#genreSelect").append(finalGenre);

                //Selector de Autores
                var authors = datos[2];
                var authorSelect = '<label class="text-primary">Filtrar Por Autor</label> <select class="form-control form-control-sm" searchable="Search here.."><option>NINGUN AUTOR</option>';
                var option = '';
                $.each(authors,function(index,author){
                    if(author.isBorrado==0)
                    {
                        option += '<option value="'+author.id+'">'+author.name+'</option>';
                    }
                })
                var finalAuthor = authorSelect + option + '</select>';      
                $("#authorSelect").append(finalAuthor);

                //Contenedor de Libros
                var books = datos[0];
                var catalogo = '';
                $.each(books, function(index, book){
                    if(book.available==1 && tipoUsuario==0)
                    {
                        catalogo +=                        
                            '<div id="cardTamaño" class="col-lg-3 mb-5">'+
                                '<div class="card card-custom">'+
                                    '<div class="card-body">'+
                                        '<div>'+
                                            '<img src="../../portadas/'+book.image+'" class="card-img-top" style="height: 300px;">'+
                                        '</div>'+
                                        '<div class="text-center align-middle">'+
                                            '<br>'+
                                            '<div class="text-center"><h5><span class="text-dark text-center">'+book.title+'</span></h5></div>'+
                                        '</div>'+ 
                                        '<div class="text-center align-middle">'+
                                            '<button type="button" id="'+book.idBook+'" class="btn btn-danger btn-sm" onclick="pedirLibro('+book.idBook+', '+userId+')"> Agregar  <i class="fas fa-plus-square fa-1x"></i> </button>'+            
                                        '</div>'+
                                        '<div>'+
                                            '<br>'+
                                            '<div class="text-center"><h4><span class="text- text-center">$ '+book.price+'</span></h4></div>'+
                                            '<div class="text-center"><h5><span class="text-dark text-center">'+book.autName+'</span></h5></div>'+
                                            '<div class="text-center"><h5><span class="badge badge-info text-center">'+book.gName+'</span></h5></div>'+
                                        '</div>'+ 
                                    '</div>'+ 
                                '</div>'+ 
                            '</div>'    
                    }
                    else if(book.available==1 && tipoUsuario==1){
                        catalogo +=                        
                            '<div id="cardTamaño" class="col-lg-3 mb-5">'+
                                '<div class="card card-custom">'+
                                    '<div class="card-body">'+
                                        '<div>'+
                                            '<img src="../../portadas/'+book.image+'" class="card-img-top" style="height: 300px;">'+
                                        '</div>'+
                                        '<div class="text-center align-middle">'+
                                            '<br>'+
                                            '<div class="text-center"><h5><span class="text-dark text-center">'+book.title+'</span></h5></div>'+
                                        '</div>'+ 
                                        '<div class="text-center align-middle">'+
                                            // '<button type="button" id="'+book.idBook+'" class="btn btn-danger btn-sm" onclick="pedirLibro('+book.idBook+', '+userId+')"> Agregar  <i class="fas fa-plus-square fa-1x"></i> </button>'+            
                                        '</div>'+
                                        '<div>'+
                                            '<br>'+
                                            '<div class="text-center"><h4><span class="text- text-center">$ '+book.price+'</span></h4></div>'+
                                            '<div class="text-center"><h5><span class="text-dark text-center">'+book.autName+'</span></h5></div>'+
                                            '<div class="text-center"><h5><span class="badge badge-info text-center">'+book.gName+'</span></h5></div>'+
                                        '</div>'+ 
                                    '</div>'+ 
                                '</div>'+ 
                            '</div>'
                    }
                })
                $("#bookContainer").append(catalogo);
            }
		});
    }

    function filtrarLibros() {

        let genreFilter = $('#genreSelect option:selected').val();
        let authorFilter = $('#authorSelect option:selected').val();
        let order = $('#order option:selected').val();


        var formData = new FormData();

        formData.append('genreFilter',genreFilter);
        formData.append('authorFilter',authorFilter);
        formData.append('order',order);


        $("#bookContainer").empty();

        var userId = '<?php echo $_SESSION['usuario']['id'];?>';
        var tipoUsuario= '<?php echo $_SESSION['usuario']['isAdmin'];?>';
        console.log('userId ->', userId);

        $.ajax({
            type:"POST",
            data: formData,
            contentType: false,
            processData: false,
            url: "../../procesos/books/filtrarLibros.php",
            success:function(r){

                let datos=jQuery.parseJSON(r);
                
                //Contenedor de Libros
                var books = datos[0];
                var catalogo = '';
                $.each(books, function(index, book){
                    if(book.available==1 && tipoUsuario==0)
                    {
                        catalogo += 
                            '<div id="cardTamaño" class="col-lg-3 mb-5">'+
                                '<div class="card card-custom">'+
                                    '<div class="card-body">'+
                                        '<div>'+
                                            '<img src="../../portadas/'+book.image+'" class="card-img-top" style="height: 300px;">'+
                                        '</div>'+
                                        '<div class="text-center align-middle">'+
                                            '<br>'+
                                            '<div class="text-center"><h5><span class="text-dark text-center">'+book.title+'</span></h5></div>'+
                                        '</div>'+ 
                                        '<div class="text-center align-middle">'+
                                            '<button type="button" id="'+book.idBook+'" class="btn btn-danger btn-sm" onclick="pedirLibro('+book.idBook+', '+userId+')"> Agregar  <i class="fas fa-plus-square fa-1x"></i> </button>'+            
                                        '</div>'+
                                        '<div>'+
                                            '<br>'+
                                            '<div class="text-center"><h4><span class="text- text-center">$ '+book.price+'</span></h4></div>'+
                                            '<div class="text-center"><h5><span class="text-dark text-center">'+book.autName+'</span></h5></div>'+
                                            '<div class="text-center"><h5><span class="badge badge-info text-center">'+book.gName+'</span></h5></div>'+
                                        '</div>'+ 
                                    '</div>'+ 
                                '</div>'+ 
                            '</div>'
                    }
                    else if(book.available==1 && tipoUsuario==1){
                        catalogo += 
                            '<div id="cardTamaño" class="col-lg-3 mb-5">'+
                                '<div class="card card-custom">'+
                                    '<div class="card-body">'+
                                        '<div>'+
                                            '<img src="../../portadas/'+book.image+'" class="card-img-top" style="height: 300px;">'+
                                        '</div>'+
                                        '<div class="text-center align-middle">'+
                                            '<br>'+
                                            '<div class="text-center"><h5><span class="text-dark text-center">'+book.title+'</span></h5></div>'+
                                        '</div>'+ 
                                        '<div class="text-center align-middle">'+
                                            //'<button type="button" id="'+book.idBook+'" class="btn btn-danger btn-sm" onclick="pedirLibro('+book.idBook+', '+userId+')"> Agregar  <i class="fas fa-plus-square fa-1x"></i> </button>'+            
                                        '</div>'+
                                        '<div>'+
                                            '<br>'+
                                            '<div class="text-center"><h3><span class="text- text-center">$ '+book.price+'</span></h3></div>'+
                                            '<div class="text-center"><h5><span class="text-dark text-center">'+book.autName+'</span></h5></div>'+
                                            '<div class="text-center"><h5><span class="badge badge-info text-center">'+book.gName+'</span></h5></div>'+
                                        '</div>'+ 
                                    '</div>'+ 
                                '</div>'+ 
                            '</div>'
                    }
                })
                $("#bookContainer").append(catalogo);
            }
        });
    }

    function pedirLibro(idLibro, idUser) {
        $('#modalBook').modal('show');
        $('#in').val(idLibro);
        $('#in').hide();
        $('#im').val(idUser);
        $('#im').hide();


    }

    function confirmarLibro() {
        var formData = new FormData();
        let idLibro = $('#in').val();
        let idUser = $('#im').val();

        formData.append('user_id',idUser);
        formData.append('book_id',idLibro);

        $.ajax({
                type:"POST",
                url:"../../procesos/users/pedirLibro.php",
                data:formData,
                contentType: false,
                processData: false,
                success:function(r){
                    if(r==1){
                        swal("Pedido con éxito.", "", "success");
                    } 
                    $('#modalBook').modal('hide');
                }
	        });   
    }
</script>