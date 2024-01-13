function agregar ()
{
    var id;
    if($("#resultado tr#result-table").length == 0) {
        id = 1;
    } else {
        id = parseInt($("#resultado tr#result-table:last").find("td:eq(0)").text())+1;
    }
    $("tbody#resultado").append(`
        <tr id="result-table" class="columnas-${id} text-center">
            <td  scope="row" class="align-middle"><b>${id}</b></td>
            <td  scope="row" class="align-middle "><input type='number' name='cantidad[]' id='cantidad'  class='form-control cantidad mx-auto text-center cantidad_req'  onChange='obtTotalMat(${id});' onkeyup='obtTotalMat(${id});' value='0' style='width:80px'></td>
            <td  scope="row" class="align-middle text-center"><input type='text' name='servicio[]' id='servicio'  class='form-control servicio mx-auto text-center' value='0' style='width:220px'></td>
            <td  scope="row" class="align-middle"><input type='number' name='valor_neto[]' id='valor_neto'  class='form-control valor_unitreq mx-auto text-center'  onChange='obtTotalMat(${id});' onkeyup='obtTotalMat(${id});' value='0' style='width:100px'></td> 
            <td  scope="row" class="align-middle"><input type='number' name='total_neto[]' readonly id='totales' class='form-control-plaintext valor_totreq text-center' onchange='calcTotal();' value='0'></td> 
            <td  scope="row" class="align-middle" id="descuento_alert_${id}"><input type='number' name='descuento[]' id='descuento_${id}' class='form-control text-center mx-auto descuento_req' step='any'  style='width:50px' onChange='CalPorcentaje(${id});' onkeyup='CalPorcentaje(${id});' value='0'></td> 
            <td  scope="row" class="align-middle"><input type='number' name='descuento_clp[]' id='descuentoclp_${id}' class='form-control-plaintext descuentoclp text-center' readonly step='any' value='0' onkeyup='CalCLP(${id});' readonly></td> 
            <td  scope="row" class="align-middle"><input type='number' name='total_descuento_item[]' id='total_descuento_item' readonly class='form-control-plaintext text-center total_descuento' value='0' onChange='TotalPorcentaje();' step='any'></td>
            <td  scope="row" class="align-middle text-center"><a class='btn btn-danger btn-sm text-white' onclick="eliminar(${id})"><i class="far fa-trash-alt"></i></a></td> 
        </tr>
    `);
}

//ELIMINAR ITEM

function eliminar(id)
{
    
    $('.columnas-'+id).remove();

    obtTotalMat(id);

    calcTotal();

    CalCLP(id);

    descuentoPesos();

    CalPorcentaje(id);

    TotalPorcentaje();

    TotalItems();

    sumaDescuento();

}

//Obtener total de #precio_unitario * #cantidad_req
function obtTotalMat(id)
{
    var tot = $(".columnas-"+id+" .cantidad_req").val() * $(".columnas-"+id+" .valor_unitreq").val();
    $(".columnas-"+id+" .valor_totreq").val(tot);

    

    calcTotal();

    CalCLP(id);

    descuentoPesos();

    CalPorcentaje(id);

    TotalPorcentaje();

    TotalItems();

    sumaDescuento();

}
//Calcular total
function calcTotal()
{
    var tot = 0;
    $(".valor_totreq").each(function () {
        tot+=Number($(this).val());
    });
    $("#sub_total_pre").val(tot);
}



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Obtener CLP PESOS de #totales * #descuento_id / 100 = #total_item
//Obtener % de #totales * #descuento_id / 100 = #total_item
function CalPorcentaje(id)
{
    var tot_des = ($(".columnas-"+id+" .valor_totreq").val() * $(".columnas-"+id+" .descuento_req").val()) / 100;
    var tot_final = $(".columnas-"+id+" .valor_totreq").val() - tot_des;
    $(".columnas-"+id+" .total_descuento").val(tot_final.toFixed(0));
    TotalPorcentaje();
    descuentoPesos();
    CalCLP(id);
    TotalItems();
    sumaDescuento();
}

function CalCLP(id)

{

    var tot_des_clp = ($(".columnas-"+id+" .valor_totreq").val() * $(".columnas-"+id+" .descuento_req").val()) / 100;



    $(".columnas-"+id+" .descuentoclp").val(tot_des_clp.toFixed(0));

    

   descuentoPesos();

}

function descuentoPesos() {

    var tot_des_clp = 0;

    $(".descuentoclp").each(function () {

        tot_des_clp+=Number($(this).val());

    });

    $("#descuento_pesos").val(tot_des_clp.toFixed(0));

}

//Calcular total

function TotalPorcentaje()

{

    var tot_final = 0;

    $(".valor_unitreq").each(function () {

        tot_final+=Number($(this).val());

    });



    TotalItems();

}

//Suma del sub total CAMBIO 27-08-2020

function TotalItems()

{

    var suma = 0;

    $(".valor_unitreq").each(function () {

        suma+=Number($(this).val());

    });



   // $("#sub_total").val(suma);

   var resultado = parseInt($("#sub_total_pre").val()) - parseInt($("#descuento_pesos").val());

    $("#neto_pre").val(resultado.toFixed(0));



    //Calcular el IVA
    if ($('input#exenta').is(':checked')) {
        $("#iva_pre").val(0);
    }else{

        var iva_total = $("#neto_pre").val() * 1.19;
    
        $("#iva_pre").val(iva_total.toFixed(0) - $("#neto_pre").val());
    }



    //Suma Neto + IVA

    var sub_total = $("#sub_total_pre").val();

    var total_pagar = parseInt($("#neto_pre").val()) + parseInt($('#iva_pre').val());

    $("#total_pre").val(total_pagar);

    

    // $("#total_pre").val(new Intl.NumberFormat().format(total_pagar));



    // $("#total_nv_dv").val(new Intl.NumberFormat().format(total_pagar));

    // $("#total_nv_original").val(total_pagar);

    // $("#resta_nv").val(new Intl.NumberFormat().format(total_pagar));

    

    sumaDescuento();

}

//Suma del descuento %

function sumaDescuento()

{

    var sdescuento= 0;

    var sub_total = $('#sub_total_pre').val();

    var descuento_pesos = $('#descuento_pesos').val();

    var sdescuento = parseInt(descuento_pesos) / parseInt(sub_total) * 100;

    /* $(".descuento_req").each(function () {

        sdescuento+=Number($(this).val());

    });*/

    var cantidad_fix= 0;

    var cantidad_fix = sdescuento.toFixed(0); //mostrar 2 decimales

    $("#descuento_porcentaje").val(cantidad_fix);



    if (isNaN($("#descuento_porcentaje").val())) {

        $("#descuento_porcentaje").val(0);

    }

    

}

function VerificarIVA() {
    if ($('input#exenta').is(':checked')) {
        $("#iva_pre").val(0);
    }else{

        var iva_total = $("#neto_pre").val() * 1.19;
    
        $("#iva_pre").val(iva_total.toFixed(0) - $("#neto_pre").val());
    }
}