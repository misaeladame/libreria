<?php
    require_once "../../clases/CrudUser.php";
    
    $obj = new CrudUser();
    $sql = $obj->getPedido($_POST['user_id']);

    $tabla='
            <table class="table table-hover table-condensed table-bordered" id="idTablePedido">
                <thead style= "background-color: #dc3545; color: white; font-weight: bold;">
                    <tr>
                        <td>Titulo</td>
                        <td>Portada</td>
                        <td>Fecha de Pedido</td>
                        <td>Estatus</td>             
                    </tr>
                </thead>
                <tfoot style= "background-color: #ccc; color: white; font-weight: bold;">
                    <tr>
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

        switch($value['estatus']) {
            case 0:
                $estatus = '<span class="badge badge-warning">PENDIENTE</span>';
            break;

            case 1:
                $estatus = '<span class="badge badge-success">ENTREGADO</span>';
            break;
        }


        $datosTabla=$datosTabla.'
            <tr>
                <td>'.$value['titulo'].'</td>
                <td>'.'<img width="75px" height="75px" src="../../portadas/'.$value['portada'].'" alt="">'.'</td>
                <td>'.$value['fecha'].'</td>
                <td>'.$estatus.'</td>           
            </tr>';
        
    }
    echo $tabla.$datosTabla.'</tbody></table>';
?>

<script>
    $(document).ready(function() {
        $('#idTablePedido').DataTable({
        
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