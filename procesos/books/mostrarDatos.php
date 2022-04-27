<?php
    require_once "../../clases/CrudBook.php";

    $obj = new CrudBook();
    $sql = $obj->getAllBooks();

    $tabla='
            <table class="table table-hover table-condensed table-bordered" id="idTableBook">
                <thead style= "background-color: #dc3545; color: white; font-weight: bold;">
                    <tr>
                        <td>Titulo</td>
                        <td>ISBN</td>
                        <td>Autor</td>
                        <td>Género</td>
                        <td>Precio</td>
                        <td>Disponibilidad</td>
                        <td>Portada</td>
                        <td>Editar</td>
                        <td>Eliminar</td>                 
                    </tr>
                </thead>
                <tfoot style= "background-color: #ccc; color: white; font-weight: bold;">
                    <tr>
                        <td>Titulo</td>
                        <td>ISBN</td>
                        <td>Autor</td>
                        <td>Género</td>
                        <td>Precio</td>
                        <td>Disponibilidad</td>
                        <td>Portada</td>
                        <td>Editar</td>
                        <td>Eliminar</td>              
                    </tr>
                </tfoot>
        <tbody style="background color: white">';       


    $datosTabla="";
    
    foreach($sql as $key => $value) {
        if($value["available"]==1){
            $estado = "Si";
        }else {
            $estado = "No";
        }
        $datosTabla=$datosTabla.
        

            '<tr>
                <td>'.$value['title'].'</td>
                <td>'.$value['isbn'].'</td>
                <td>'.$value['autName'].'</td>
                <td>'.$value['gName'].'</td>
                <td>'.$value['price'].'</td>
                <td>'.$estado.'</td>
                <td>'.'<img width="75px" height="75px" src="../../portadas/'.$value['image'].'" alt="">'.'</td>
                <td class= "text-center" style="text align: center; text-center;">
                    <span class="btn btn-warning btn-sm text-light" data-toggle="modal" data-target="#modalEditar"
                        onclick="obtenerDatos('.$value['idBook'].')">
                            <span class= "fa fa-pencil-square-o"></span>
                    </span>    
                </td>
                <td class= "text-center" style="text align: center; text-center;">
                    <span class="btn btn-danger btn-sm text-light" onclick="eliminarDatos('.$value['idBook'].')">
                            <span class="fa fa-trash-o"></span>
                    </span>       
                </td>
            </tr>';
        
    }
    echo $tabla.$datosTabla.'</tbody></table>';
?>

<script>
    $(document).ready(function() {
        
        $('#idTableBook').DataTable({

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