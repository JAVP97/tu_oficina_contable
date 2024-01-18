@extends('layouts.frontend')
@section('title', 'Crear Factura')
@section('content')
<form method="POST" action="{{ route('factura.store') }}">
    @csrf
    <div class="container-fluid">
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
                                        <th>Quitar</th>
                                    </tr>
                                </thead>
                                <tbody id="resultado">
                                    @foreach ($clientes as $cliente)
                                        <tr id="result-table" class="columnas-0">
                                            <td  scope="row" class="align-middle" hidden><input type="hidden" name="cliente_id[]" value="{{$cliente->id}}"></td>
                                            <td  scope="row" class="align-middle text-center"><input type='text' name='nombre_cliente[]' id='nombre_cliente'  class='form-control servicio mx-auto text-center' value='{{$cliente->nombre_empresa}}' style='width:220px'></td>
                                            <td  scope="row" class="align-middle text-center"><input type='text' name='descripcion_producto[]' id='descripcion_producto'  class='form-control mx-auto text-center' value='Honorarios {{$asunto}}' style='width:220px'></td>
                                            <td  scope="row" class="align-middle "><input type='number' name='cantidad_producto[]' id='cantidad_producto'  class='form-control cantidad mx-auto text-center cantidad_req' value='1' style='width:80px'></td>
                                            <td  scope="row" class="align-middle"><input type='number' name='valor_neto[]' id='valor_neto_{{$cliente->id}}'  class='form-control valor_unitreq mx-auto text-center'  onkeyup="calcularIVA({{$cliente->id}});" value='0' style='width:100px'></td> 
                                            <td  scope="row" class="align-middle"><input type='number' name='iva[]' id='iva_{{$cliente->id}}' readonly class='form-control-plaintext text-center' value='0' step='any'></td>
                                            <td  scope="row" class="align-middle"><input type='number' name='valor_iva[]' id='valor_iva_{{$cliente->id}}' readonly class='form-control-plaintext text-center' value='0' step='any'></td>
                                            <td  scope="row" class="align-middle">
                                                <select class="form-control" name="forma_pago_id[]" id="forma_pago_id">
                                                    @foreach ($forma_pago as $fp)
                                                        <option value="{{$fp->id}}">{{$fp->nombre_fp}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td  scope="row" class="align-middle text-center"><a class='btn btn-danger btn-sm text-white' onclick="eliminar(0)"><i class="far fa-trash-alt"></i></a></td> 
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row justify-content-center mt-4">
                                <div class="col-sm-12">
                                    <div>
                                        <button type="submit" class="btn btn-primary w-md">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('styles')
@endpush

@push('script')
    <script src="{{asset('js/detallesFactura.js')}}"></script>
    <script>

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