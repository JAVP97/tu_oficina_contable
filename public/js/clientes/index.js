$(document).ready(function(){
    listadoClientes();
});

async function listadoClientes() {
    console.log("listadoClientes");
    $.ajax({
        type: "GET",
        url: "/listado_clientes",
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
        },
        success : function(data){
            console.log(data);
        
        }
    });
    // $('#laravel_datatable').DataTable({
    //     "processing": true,
    //     "serverSide": true,
    //     "responsive": false,
    //     "autoWidth": false,
    //     "language": {
    //         "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    //     },
    //     "ajax": {
    //     url: "{{route('clientes.index')}}",
    //     type: 'GET',
    //     },
    //     "columns": [
    //             { data: 'razon_social_cliente', name: 'razon_social_cliente' },
    //             { data: 'rut_cliente', name: 'rut_cliente' },
    //             { data: 'email_cliente', name: 'email_cliente' },
    //             { data: 'telefono_cliente', name: 'telefono_cliente' },
    //             { data: 'direccion_cliente', name: 'direccion_cliente' },
    //             { data: 'giro_id', name: 'giro_id' },
    //             { data: 'region_id', name: 'region_id' },
    //             { data: 'comuna_id', name: 'comuna_id' },
    //             {data: 'action', name: 'action', orderable: false},
    //         ],
    //     "order": [[0, 'asc']]
    // });
}