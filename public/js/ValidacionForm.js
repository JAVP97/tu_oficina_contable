$(document).ready(function(){
    $( "#btn-send" ).click(function() {
        var isValid = true; 
        //Validacion Producto
        var tbl = $("#resultado tr").length;
        if (tbl == 0)
        {
            isValid = false;
            alert('DEBE AGREGAR UN ARTICULO PARA GENERAR UNA SALIDA');
            return false;
        }else{
            // Validaci贸n de Encabezado
            if($('#fecha_movimiento').val().length == '')
            {
                $('#fecha_movimiento').addClass('is-invalid');
                $('#msg_fecha_movimiento').html('Por favor ingrese la fecha de movimiento').show();
                return false;
            }else{
                $('#fecha_movimiento').removeClass('is-invalid');
                $('#fecha_movimiento').addClass('is-valid');
            }
            if($('#proyecto_id').val().length == '')
            {
                $('#proyecto_id').addClass('is-invalid');
                $('#msg_proyecto_id').html('Por favor seleccione un proyecto').show();
                return false;
            }else{
                $('#proyecto_id').removeClass('is-invalid');
                $('#proyecto_id').addClass('is-valid');
            }
            if($('#cliente').val().length == '')
            {
                $('#cliente').addClass('is-invalid');
                $('#msg_cliente').html('Por favor ingrese un cliente').show();
                return false;
            }else{
                $('#cliente').removeClass('is-invalid');
                $('#cliente').addClass('is-valid');
            }
            if($('#encargado_recibir').val().length == '')
            {
                $('#encargado_recibir').addClass('is-invalid');
                $('#msg_encargado_recibir').html('Por favor ingrese un encargado').show();
                return false;
            }else{
                $('#encargado_recibir').removeClass('is-invalid');
                $('#encargado_recibir').addClass('is-valid');
            }
            // Validacion sobre stock
            var cantidad = $('.cantidad_req').val();
            var stock = $('.stock_disponible');
            var bandera_stock = 0;
        
            $.each(stock,(k, v) => {
                debugger;
                var id = $(v).attr("id").split("_")[2];
                var stock_actual = $(`#stock_actual_${id}`).val();
                var cantidad_requerida = $(`#result-cant-${id}`).val(); //
                if(parseInt(stock_actual) < parseInt(cantidad_requerida)){  
                var requerido_stock = $(`#requerido_stock_${id}`).addClass('table-danger'); // Alert Stock
                var stock_dis = $(`#disponible_stock_${id}`).addClass('table-success'); // Disponibilidad de Stock
                    bandera_stock++;    
                }
                // console.log("id", id);
            });
        var solicitud_stock = $('#autoriza_sobre_stock').is(':checked');
        if(bandera_stock > 0){
            if (!solicitud_stock) { 
                isValid = false;
                var requerido_stock; //agregar color de alerta en la casilla del stock
                var stock_dis; //agregar color de disponibilidad de stock
                alert("No se puede generar la salida, verifique que la cantidad sea menor o igual que el stock en bodega.");
                return false;
            }else{
                isValid
            }
        }else{
            isValid
        }
            $('#myModal').modal('show');
            return true;
        }
      });
    });