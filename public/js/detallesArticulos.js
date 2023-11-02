function agregar (id)
{
    var producto = {
        id: id,
        bodega_uso: $(`#bodega_uso_${id}`).val(),
        titulo: $(`#titulo_${id}`).val(),
        cantidades: $(`#cantidades_${id}`).val(),
        bodega: $(`#id_bodega${id}`).val(),
        nom_bodega: $(`#id_bodega${id} option:selected`).text(),
        stock_actual: $(`#stock_actual_${id}`).val(),
        cantidad_bodega: $(`#cantidad_actual_${id}`).val(),
    }
    if($(`#id_bodega${id}`).val().length == '')
    {
        alert("Debe elegir una bodega!!");
        return false;
    }
    if ($(`#cantidad_actual_${id}`).val() == 0 ) {
        alert("No puede agregar cantidad, ya que en la bodega no hay stock!!");
        return false;
    }
    if(producto.cantidades.trim().length > 0 ){
            if($(`#result-table-${id}`).length > 0 ){
                let cantidad = parseInt($(`#result-cant-${id}`).val());
                cantidades = parseInt(producto.cantidades) + cantidad;
                $(`#result-cant-${id}`).val(cantidades);
            }else{
                var _htmlRender = __renderTable(producto);
                $("tbody#resultado").append(_htmlRender);
            }
            $(`#cantidades_${id}`).val("");
            $(`#id_bodega${id} option[value='']`).prop('selected',true);
            $(`#cantidad_actual_${id}`).val("");
    }else{
        alert("Debe agregar una cantidad!!");
    }
}

function __renderTable(producto)
{
    var _html = `
        
        <tr id="result-table-${producto.id}" class="columnas">
            <td hidden><input type='text' name='articulo_id[]' value='${producto.id}'></td>
            <td hidden><input type='text' name='bodega_uso[]' value='${producto.bodega_uso}'></td>
            <td  scope="row" class="align-middle">${producto.titulo}</td>
            <td  scope="row" class="align-middle" id="requerido_stock_${producto.id}"><input type='number' name='cantidades[]' id='result-cant-${producto.id}' class='form-control cantidad_req' value='${producto.cantidades}'></td> 
            <td  scope="row" class="align-middle">${producto.nom_bodega}</td>
            <td  scope="row" class="align-middle" id="disponible_stock_${producto.id}"><input type='number' name='cantidad_seleccionada[]' id='stock_actual_${producto.id}' readonly class='form-control-plaintext text-center' value='${producto.cantidad_bodega}' step='any'></td>
            <td  scope="row" class="align-middle"><input type='number' name='stock_actual[]' id='stock_actual_${producto.id}' readonly class='form-control-plaintext text-center stock_disponible' value='${producto.stock_actual}' step='any'></td>

            <td  scope="row" class="align-middle"><a id="result-delete-${producto.id}" class='btn btn-danger btn-sm text-white' onclick="eliminar(${producto.id})"><i class="far fa-trash-alt"></i></a></td> 
        </tr>
    `;
    return _html;
    
}
//ELIMINAR ITEM
function eliminar(id) 
{
    $('#result-table-'+id).remove();
}