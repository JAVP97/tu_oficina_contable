$(document).ready(function(){

    $(document).on('click', '.pagination a', function(event){
        event.preventDefault(); 
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });

    $(".editarCliente").click(function(){
        let id = $(this).attr("id");
        editarCliente(id);
    });

    $(".eliminarCliente").click(async function(){
        let id = $(this).attr("id");
        const res = confirm("Seguro deseas eliminar el cliente?");
        if (res) {
            $.ajax({
                type: "DELETE",
                url: `clientes/${id}`,
                dataType: 'json',
                data: {
                    "_token":  $('meta[name="csrf-token"]').attr('content'),
                },
                success : function(response){
                    window.location.reload();
                }
            });
        }
    });
    
});

function fetch_data(page) {
    $.ajax({url:"/clientes/pagination/fetch_data?page="+page,
        success:function(data){
            $('#table_data').html(data);
        }
    });
}

function editarCliente(id) {
    $.ajax({url:`/clientes/edit/${id}`,
        success:function(data){
            if (data) {
                //Set info en formulario para Editar
                $("#personalidad").val(data.personalidad);
                $("#nombre_empresa").val(data.nombre_empresa);
                $("#giro_cliente").val(data.giro_cliente);
                $("#rut").val(data.rut_empresa);
                $("#profesion").val(data.profesion);
                $("#direccion").val(data.direccion);
                $("#region_id").val(data.region_id);
                $("#comuna_id").val(data.comuna_id);
                $("#telefono").val(data.telefono);
                $("#comentario").val(data.comentario);
                $("#pass_sii").val(data.pass_sii);
                $("#tasa_ppm").val(data.tasa_ppm);
                $("#frecuencia_cobro").val(data.frecuencia_cobro);
                $("#email").val(data.email);
                $("#exento_iva").val(data.exento_iva);
                $("#importaciones").val(data.importaciones);
                $("#remuneraciones").val(data.remuneraciones);
                $("#contabilidad").val(data.contabilidad);
                $("#facturacion").val(data.facturacion);
                //Abro modal
                $('#editModal').modal('show');
                
                //UPDATE
                $("#actualizarCliente").click(function(e){
                    e.preventDefault();
                    $.ajax({
                        type: "PUT",
                        url: `clientes/${id}`,
                        dataType: 'json',
                        data: {
                            "_token":  $('meta[name="csrf-token"]').attr('content'),
                            personalidad: $("#personalidad").val(),
                            nombre_empresa: $("#nombre_empresa").val(),
                            giro_cliente: $("#giro_cliente").val(),
                            rut_empresa: $("#rut").val(),
                            profesion: $("#profesion").val(),
                            direccion: $("#direccion").val(),
                            region_id: $("#region_id").val(),
                            comuna_id: $("#comuna_id").val(),
                            comentario: $("#comentario").val(),
                            telefono: $("#telefono").val(),
                            pass_sii: $("#pass_sii").val(),
                            tasa_ppm: $("#tasa_ppm").val(),
                            frecuencia_cobro: $("#frecuencia_cobro").val(),
                        },
                        success : function(response){
                            $('#editModal').modal('toggle');
                            alert('Registro Actualizado');
                        },
                        complete : function(xhr, status) {
                            //$('#laravel_datatable').DataTable().ajax.reload(null, false);
                            //Recargamos la pagina
                             window.location.reload();
                        }
                    });
                });
            }
        }
    });
}