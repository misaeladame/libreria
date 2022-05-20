
<?php   
    session_start();
    $user_id = $_SESSION["usuario"]['id'];
?>  

<div class="container mt-4">
    <div class="row">
        <div class="col-sm-12">
            <div class="card border-dark">
                <div class="card-header text-center font-weight-bold">
                    MIS PEDIDOS
                </div>
                <div class="card-body text-center" ></div>
                <div class="card-body">
                    <div id ="dataTablePedido"></div>
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

        let user_id = '<?php echo $user_id;?>'

        $.ajax({
            type:"POST",
            url:"../../procesos/users/mostrarPedidos.php",
            data: "user_id="+ user_id,
            success:function(r){
                $('#dataTablePedido').html(r);
            }
        });
    }
</script>