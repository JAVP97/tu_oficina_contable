@extends('layouts.frontend')
@section('title', 'Crear Factura y Cobranza')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                            <form action="{{route('periodo.store')}}" method="POST" class="row">
                                @csrf
                                <div class="col-4">
                                    <label for="periodo">Periodo</label>
                                    <input type="month" name="periodo" id="periodo" class="form-control">
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-success mt-4">Generar</button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                    <!-- end card -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">CLIENTES</h5>
                            <table id="tabla" class="table text-center table-bordered align-middle nowrap mt-5">
                                <thead class="text-center">
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Concepto facturado</th>
                                        <th>Cantidad</th>
                                        <th>Monto</th>
                                        <th>IVA</th>
                                        <th>Monto + IVA</th>
                                        <th>Forma pago</th>
                                        <th>Generar Doc.</th>
                                        <th>Quitar</th>
                                    </tr>
                                </thead>
                                <tbody id="resultado">
                                    @foreach ($clientes as $cliente)
                                        <tr id="result-table" class="columnas-{{$cliente->id}}">
                                            <td  scope="row" class="align-middle text-center"><input type='text' id='nombre_cliente_{{$cliente->id}}' readonly class='form-control servicio mx-auto text-center' value='{{$cliente->nombre_empresa}}' style='width:220px'></td>
                                            <td  scope="row" class="align-middle text-center"><input type='text' id='descripcion_producto_{{$cliente->id}}'  class='form-control mx-auto text-center' value='Honorarios {{$asunto}}' style='width:220px'></td>
                                            <td  scope="row" class="align-middle "><input type='number' id='cantidad_producto_{{$cliente->id}}'  class='form-control cantidad mx-auto text-center cantidad_req' value='1' style='width:80px' readonly></td>
                                            <td  scope="row" class="align-middle"><input type='number' id='valor_neto_{{$cliente->id}}'  class='form-control valor_unitreq mx-auto text-center'  onkeyup="calcularIVA({{$cliente->id}});" value='0' style='width:100px'></td> 
                                            <td  scope="row" class="align-middle"><input type='number' id='iva_{{$cliente->id}}' readonly class='form-control-plaintext text-center' value='0' step='any'></td>
                                            <td  scope="row" class="align-middle"><input type='number' id='valor_iva_{{$cliente->id}}' readonly class='form-control-plaintext text-center' value='0' step='any'></td>
                                            <td  scope="row" class="align-middle">
                                                <select class="form-control" id="forma_pago_id_{{$cliente->id}}">
                                                    @foreach ($forma_pago as $fp)
                                                        <option value="{{$fp->id}}">{{$fp->nombre_fp}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td  scope="row" class="align-middle">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="#" id="btnFactura{{$cliente->id}}" onclick="FacturaSii({{$cliente->id}})" class="btn text-primary">Sii</a>
                                                    <a href="#" id="btnCobranza{{$cliente->id}}" onclick="GenerarCobranza({{$cliente->id}})" class="btn text-success">Cobranza</a>
                                                </div>
                                            </td>
                                            <td  scope="row" class="align-middle text-center"><a class='btn btn-danger btn-sm text-white' onclick="eliminar({{$cliente->id}})"><i class="far fa-trash-alt"></i></a></td> 
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Enviando información</h5>
                </div>
                <div class="modal-body">
                    <p>Espere un momento que estamos enviando la información para generar el documento.</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
@endpush

@push('script')
    <script src="{{asset('js/detallesFactura.js')}}"></script>
    <script>
        function eliminar(id)
        {
            $('.columnas-'+id).remove();
        }
        function calcularIVA(id)
        {
            var neto = $("#valor_neto_"+id).val();
            var suma = neto * 0.19;
            var ivatotal = (neto * 19)/100;
            $("#iva_"+id).val(ivatotal);
            var iva_c = (parseInt(neto) * 0.19) + parseInt(neto);
            let iva = Math.ceil(iva_c);
            $("#valor_iva_"+id).val(isNaN(iva)? 0 : iva.toFixed(0));
        }
        function GenerarCobranza(id) {
            if($('#valor_neto_'+id).val() == 0){
                alert('Debe colocar un monto.');
                return false;
            }
            $.ajax({
                type:'POST',
                url:'{{url("clientes/cobranza")}}/'+id,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id" : id,
                    "nombre_cliente": $('#nombre_cliente_'+id).val(),
                    "descripcion_producto": $('#descripcion_producto_'+id).val(),
                    "cantidad_producto": $('#cantidad_producto_'+id).val(),
                    "valor_neto": $('#valor_neto_'+id).val(),
                    "iva": $('#iva_'+id).val(),
                    "valor_iva": $('#valor_iva_'+id).val(),
                    "forma_pago_id": $('#forma_pago_id_'+id).val()
                },
                beforeSend: function() {
                    $('#staticBackdrop').modal('show');
                },
                success:function(data) {
                    alert('Registro enviado con exito!!');
                    $('#btnCobranza'+id).addClass('d-none');
                },
                error: function (msg) {
                    console.log(msg);
                    var errors = msg.responseJSON;
                },
                complete: function() {
                    $('#staticBackdrop').modal('hide');
                },
            });
        }
        function FacturaSii(id) {
            alert('FALTA CONEXION CON LA API')
        }
        // $('#region_id').on('change', function() { 
        //     var region = $(this).val();
        //     if($.trim(region) != ''){
        //         $.get("{{ url('regiones') }}", {region: region}, function(region){
        //             $('#comuna_id').empty();
        //             $('#comuna_id').append("<option value=''>Seleccione Comuna</option>");
        //             $.each(region, function (index, value){
        //             $('#comuna_id').append("<option value='"+ index +"'>"+ value +"</option>");
        //             });

        //         });
        //     }
        // });

        // $('#cliente_id').change(function () {
        //         var id_cliente = $(this).val();

        //         if ($.trim(id_cliente) != '') {
        //             $.get("{{route('clientes.get')}}", {id_cliente: id_cliente}, function(cliente) {
        //                 console.log(cliente);
        //                 $('#rut_cliente').empty();
        //                 $('#nombre_empresa').empty();
        //                 $('#direccion').empty();
        //                 $('#region').empty();
        //                 $('#comuna').empty();
        //                 $('#tipo_compra').empty();
        //                 $('#giro').empty();
        //                 $.each(cliente, function (index, value) {
        //                     $('#rut_cliente').val(value.rut_empresa);
        //                     $('#nombre_empresa').val(value.nombre_empresa);
        //                     $('#name').val(value.name);
        //                     $('#direccion').val(value.direccion);
        //                     $('#region').val(value.region);
        //                     $('#comuna').val(value.comuna);
        //                     $('#tipo_compra').val(value.tipo_compra);
        //                     $('#giro').val(value.giro);
        //                     $("#id_sectores option[value='"+value.id_sectores+"']").prop("selected", "selected");
        //                 })
        //             });
        //         }
        // })
    </script>
@endpush