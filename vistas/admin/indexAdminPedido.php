<div class="container mt-4">
    <div class="row">
        <div class="col-sm-12">
            <div class="card border-dark">
                <div class="card-header text-center font-weight-bold">
                    PEDIDOS DE CLIENTES
                </div>
                <div class="card-body">
                    <div id ="dataTablePedidosClientes" onsubmit="obtenerDatos()"></div>
                </div>
                <div class="card-footer text-muted text-center">
                    LIBRO USADO
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
            type:"POST",
            url:"../../procesos/mostrarPedidosClientes.php",
            success:function(r){
                $('#dataTablePedidosClientes').html(r);
            }
        });
    }

    function changeStatus(id)
    {
        console.log('status -> ', status);
        swal({
            title: "¿Confirmar Pedido?",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
	    })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    type:"POST",
                    url:"../../procesos/users/actualizarPedido.php",
                    data:"id=" + id,
                    success:function(r){
                        console.log('r->', r);
                        if(r==1){
                            mostrar();
                            swal("Actualizado con éxito.", "", "info");
                        } else {
                            swal("Error al actualizar.", "", "error");
                        }
                    }
                });
            } 
        });
    }
</script>

