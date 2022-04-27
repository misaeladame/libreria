<?php
    require_once "../clases/CrudUserBook.php";
    
    $obj = new CrudUserBook();
    $sql = $obj->getPedidos();

    $tabla='
            <table class="table table-hover table-condensed table-bordered" id="idTablePedidosClientes">
                <thead style= "background-color: #dc3545; color: white; font-weight: bold;">
                    <tr>
                        <td>Cliente</td>
                        <td>Titulo</td>
                        <td>Portada</td>
                        <td>Fecha de Pedido</td>
                        <td>Estatus</td>             
                    </tr>
                </thead>
                <tfoot style= "background-color: #ccc; color: white; font-weight: bold;">
                    <tr>
                        <td>Cliente</td>
                        <td>Titulo</td>
                        <td>Portada</td>
                        <td>Fecha de Pedido</td>
                        <td>Estatus</td>              
                    </tr>
                </tfoot>
        <tbody style="background color: white">';       


    $datosTabla="";
    foreach($sql as $key => $value) {
        $estatus = "";
        $nombreCliente =  $value['nombre'];
        $nombreCliente .= " ";
        $nombreCliente .= $value['apellido'];
    
        switch($value['estatus']) {
            case 0:
                $estatus = '<span class="badge badge-warning">PENDIENTE</span>
                            <br><br><button type="button" class="btn btn-dark btn-sm" onclick="changeStatus('.$value['idPedido'].')" >Confirmar</button>';
            break;

            case 1:
                $estatus = '<span class="badge badge-success">ATENDIDO</span>
                            <br><br><button type="button" class="btn btn-dark btn-sm" disabled>Confirmar</button>';
            break;
        }


        $datosTabla=$datosTabla.'
            <tr>
                <td>'.$nombreCliente.'</td>
                <td>'.$value['titulo'].'</td>
                <td>'.'<img width="75px" height="75px" src="../../portadas/'.$value['portada'].'" alt="">'.'</td>
                <td>'.$value['fecha'].'</td>
                <td class= "text-center" style="text align: center; text-center;">'.$estatus.'</td>           
            </tr>';
        
    }
    echo $tabla.$datosTabla.'</tbody></table>';
?>

<script>
    $(document).ready(function() {
        $('#idTablePedidosClientes').DataTable({

        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" 
        },

        dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
            ]
        });
});
</script>