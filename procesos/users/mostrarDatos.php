<?php
    require_once "../../clases/CrudUser.php";

    $obj = new CrudUser();
    $sql = $obj->getAllUsers();

    $tabla='
            <table class="table table-hover table-condensed table-bordered" id="idTablaUser">
                <thead style= "background-color: #dc3545; color: white; font-weight: bold;">
                    <tr>
                        <td>Nombre(s)</td>
                        <td>Apellido(s)</td>
                        <td>Correo</td>
                        <td>Teléfono</td>
                        <td>Administrador</td>
                        <td>Editar</td>
                        <td>Eliminar</td>                 
                    </tr>
                </thead>
                <tfoot style= "background-color: #ccc; color: white; font-weight: bold;">
                    <tr>
                        <td>Nombre(s)</td>
                        <td>Apellido(s)</td>
                        <td>Correo</td>
                        <td>Teléfono</td>
                        <td>Administrador</td>
                        <td>Editar</td>
                        <td>Eliminar</td>              
                    </tr>
                </tfoot>
        <tbody style="background color: white">';       


    $datosTabla="";
    
    foreach($sql as $key => $value) {

        if($value['isAdmin'] == 0) {
            $isAdmin = "No";
        } else {
            $isAdmin = "Si";
        }

        if($value['isBorrado']==0)
        {
            $datosTabla=$datosTabla.'
                <tr>
                    <td>'.$value['name'].'</td>
                    <td>'.$value['last_name'].'</td>
                    <td>'.$value['mail'].'</td>
                    <td>'.$value['cellphone'].'</td>
                    <td>'.$isAdmin.'
                    </td>
                    <td class= "text-center" style="text align: center; text-center;">
                        <span class="btn btn-warning btn-sm text-light" data-toggle="modal" data-target="#modalEditar"
                            onclick="obtenerDatos('.$value['id'].')">
                                <span class= "fa fa-pencil-square-o"></span>
                        </span>    
                    </td>
                    <td class= "text-center" style="text align: center; text-center;">
                        <span class="btn btn-danger btn-sm text-light" onclick="eliminarDatos('.$value['id'].')">
                                <span class="fa fa-trash-o"></span>
                        </span>       
                    </td>
                </tr>';
        }    
        
    }
    echo $tabla.$datosTabla.'</tbody></table>';
?>

<script>
    $(document).ready(function() {
        $('#idTablaUser').DataTable({

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