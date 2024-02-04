@extends('layouts.frontend')
@section('title', 'Crear Factura y Cobranza')
@section('content')

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
                                @foreach ($clientes as $cliente)
                                    <input type="hidden" name="cliente_id[]" value="{{$cliente->id}}">
                                @endforeach
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
                            <div class="accordion" id="accordionExample">
                                @foreach ($periodos as $periodo)
                                @php
                                    $periodo_num = explode("-", $periodo->periodo);
                                        
                                    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                                    $mes = $meses[($periodo_num[1]) - 1];
                                    $asunto = $mes;
                                    
                                @endphp
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{$periodo->id}}">
                                            <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$periodo->id}}" aria-expanded="false" aria-controls="collapse{{$periodo->id}}">
                                            {{$asunto}} {{$periodo_num[0]}} {!! $periodo->periodo_cerrado == 'No' ? '<span class="badge badge-soft-success" style="margin-left: 10px;">Abierto</span>' : ' <span class="badge badge-soft-danger" style="margin-left: 10px;">Cerrado</span>' !!}
                                            </button>
                                        </h2>
                                        <div id="collapse{{$periodo->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$periodo->id}}" data-bs-parent="#accordionExample" style="">
                                            <div class="accordion-body text-black">
                                                <table id="tabla" class="table text-center table-bordered  mt-5">
                                                    <thead class="text-center">
                                                        <tr>
                                                            <th>Exento?</th>
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
                                                        @foreach ($clientePeriodos as $item)
                                                            @if ($periodo->id == $item->periodo_id)
                                                                <tr id="result-table" class="columnas-{{$item->clientes->id}}_{{$periodo->id}}">
                                                                    <td  hidden><input type="text" id='cliente_periodo_id_{{$item->clientes->id}}_{{$periodo->id}}' value="{{$item->id}}"></td>
                                                                    <td  scope="row" class="align-middle text-center"><input type='text' id='nombre_cliente_{{$item->clientes->id}}_{{$periodo->id}}' readonly class='form-control servicio mx-auto text-center' value='{{$item->clientes->nombre_empresa}}' ></td>
                                                                    <td  scope="row" class="align-middle text-center"><input type='text' id='descripcion_producto_{{$item->clientes->id}}_{{$periodo->id}}'  class='form-control mx-auto text-center' value='Honorarios {{$asunto}} {{$periodo_num[0]}}' ></td>
                                                                    <td  scope="row" class="align-middle "><input type='text' id='cantidad_producto_{{$item->clientes->id}}_{{$periodo->id}}' style="width: 50px;" class='form-control cantidad mx-auto text-center cantidad_req' value='1' readonly></td>
                                                                    <td  scope="row" class="align-middle"><input type='number' id='valor_neto_{{$item->clientes->id}}_{{$periodo->id}}'  style="width: 100px;" class='form-control valor_unitreq mx-auto text-center'  onkeyup="calcularIVA({{$item->clientes->id}}, {{$periodo->id}});" value='{{$item->clientes->monto_base}}'></td> 
                                                                    <td  scope="row" class="align-middle"><input type='text' id='iva_{{$item->clientes->id}}_{{$periodo->id}}' readonly style="width: 80px;" class='form-control-plaintext text-center' value='0' step='any'></td>
                                                                    <td  scope="row" class="align-middle"><input type='text' id='valor_iva_{{$item->clientes->id}}_{{$periodo->id}}' readonly style="width: 80px;" class='form-control-plaintext text-center' value='0' step='any'></td>
                                                                    <td  scope="row" class="align-middle">
                                                                        <select class="form-control" id="forma_pago_id_{{$item->clientes->id}}_{{$periodo->id}}">
                                                                            @foreach ($forma_pago as $fp)
                                                                                <option value="{{$fp->id}}">{{$fp->nombre_fp}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </td>
                                                                    <td  scope="row" class="align-middle">
                                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                                            <span class="btn text-black d-none" id="idcobranza_{{$item->clientes->id}}_{{$periodo->id}}"></span>
                                                                            @if ($item->cobranza_id > 0)
                                                                                <span class="btn text-black">{{$item->cobranza_id}}</span>
                                                                                <a href="{{route('send.cobranza', $item->cobranza_id)}}" class="btn text-success">Enviar C.</a>
                                                                            @else
                                                                                <a href="#" id="btnCobranza{{$item->clientes->id}}_{{$periodo->id}}" onclick="GenerarCobranza({{$item->clientes->id}}, {{$periodo->id}})" class="btn text-success">Cobranza</a>
                                                                            @endif

                                                                            <a href="#" id="btnFactura{{$item->clientes->id}}_{{$periodo->id}}" onclick="FacturaSii({{$item->clientes->id}}, {{$periodo->id}})" class="btn text-primary">Sii</a>
                                                                        </div>
                                                                    </td>
                                                                    <td  scope="row" class="align-middle text-center"><a class='btn btn-danger btn-sm text-white' onclick="eliminar({{$item->clientes->id}}, {{$periodo->id}})"><i class="far fa-trash-alt"></i></a></td> 
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
        function exentoChequeo(id, periodoid){
            if ($('#exento_'+id+'_'+periodoid).is( ":checked" )) {
                $("#valor_neto_"+id+'_'+periodoid).removeAttr("onkeyup");
                $("#btnFactura"+id+'_'+periodoid).addClass("d-none");

            }else{
                $("#valor_neto_"+id+'_'+periodoid).attr('onkeyup','calcularIVA('+id+','+periodoid+')');
                $("#btnFactura"+id+'_'+periodoid).removeClass("d-none");
            }
        }
        function eliminar(id, periodoid)
        {
            $('.columnas-'+id+'_'+periodoid).remove();
        }
        function calcularIVA(id, periodoid)
        {
            var neto = $("#valor_neto_"+id+'_'+periodoid).val();
            var suma = neto * 0.19;
            var ivatotal = (neto * 19)/100;
            $("#iva_"+id+'_'+periodoid).val(Math.ceil(ivatotal));
            var iva_c = (parseInt(neto) * 0.19) + parseInt(neto);
            let iva = Math.ceil(iva_c);
            $("#valor_iva_"+id+'_'+periodoid).val(isNaN(iva_c)? 0 : iva_c.toFixed(0));
        }
        function GenerarCobranza(id,periodoid) {
            if($('#valor_neto_'+id+'_'+periodoid).val() == 0){
                alert('Debe colocar un monto.');
                return false;
            }
            $.ajax({
                type:'POST',
                url:'{{url("clientes/cobranza")}}/'+id,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id" : id,
                    "nombre_cliente": $('#nombre_cliente_'+id+'_'+periodoid).val(),
                    "descripcion_producto": $('#descripcion_producto_'+id+'_'+periodoid).val(),
                    "cantidad_producto": $('#cantidad_producto_'+id+'_'+periodoid).val(),
                    "valor_neto": $('#valor_neto_'+id+'_'+periodoid).val(),
                    "iva": $('#iva_'+id+'_'+periodoid).val(),
                    "valor_iva": $('#valor_iva_'+id+'_'+periodoid).val(),
                    "forma_pago_id": $('#forma_pago_id_'+id+'_'+periodoid).val(),
                    "cliente_periodo_id": $('#cliente_periodo_id_'+id+'_'+periodoid).val(),
                },
                beforeSend: function() {
                  //  $('#staticBackdrop').modal('show');
                },
                success:function(data) {
                    $('#btnCobranza'+id+'_'+periodoid).addClass('d-none');
                    $('#idcobranza_'+id+'_'+periodoid).removeClass('d-none');
                    $('#idcobranza_'+id+'_'+periodoid).html(data);
                    alert('Registro enviado con exito!!');
                },
                error: function (msg) {
                    console.log(msg);
                    var errors = msg.responseJSON;
                },
                complete: function() {
                    
                },
            });
        }
        function FacturaSii(id, periodoid) {
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