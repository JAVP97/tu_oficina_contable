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
                                        <h2 class="accordion-header" id="heading{{$periodo->id}}" style="display: flex;align-items: center;">
                                            <button class="accordion-button fw-medium collapsed d-inline" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$periodo->id}}" aria-expanded="false" aria-controls="collapse{{$periodo->id}}">
                                            {{$asunto}} {{$periodo_num[0]}} {!! $periodo->periodo_cerrado == 'No' ? '<span class="badge badge-soft-success" style="margin-left: 10px;">Abierto</span>' : ' <span class="badge badge-soft-danger" style="margin-left: 10px;">Cerrado</span>' !!}
                                        </button>
                                        <span class="btn btn-sm {{ $periodo->periodo_cerrado == 'No' ? 'btn-danger' : 'btn-success' }}" id="cerrar_{{$periodo->id}}" style="margin: 0 10px;" onclick="StatusPeriodo({{$periodo->id}})">{{ $periodo->periodo_cerrado == 'No' ? 'Cerrar' : 'Abrir' }}</span>
                                        </h2>
                                        <div id="collapse{{$periodo->id}}" class="accordion-collapse collapse" aria-labelledby="heading{{$periodo->id}}" data-bs-parent="#accordionExample" style="">
                                            <div class="accordion-body text-black">
                                                <input type="hidden" id="conceto{{$periodo->id}}" value="{{$asunto}} {{$periodo_num[0]}}">
                                                <input type="hidden" id="periodo_cerrado_{{$periodo->id}}" value="{{$periodo->periodo_cerrado}}">
                                                @if ($periodo->periodo_cerrado == 'Si')
                                                    
                                                @else
                                                    <select id="clientenuevo_{{$periodo->id}}" onchange="agregar({{$periodo->id}})">
                                                        <option value="">Agregar Cliente</option>
                                                        @foreach ($clientes as $cliente)
                                                            <option value="{{$cliente->id}}">{{$cliente->nombre_empresa}}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
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
                                                    <tbody id="resultado{{$periodo->id}}">
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
    <script>
        $(document).ready(async ()=>{
            await traerFormasPagos();
            listadoClientesPeriodos();
        })
        function listadoClientesPeriodos() {
            $.ajax({
                type: "GET",
                url: '/listado-clientes-periodos',
                success: function(res) {
                    if (res.length > 0) {
                        //recorremos informacion
                        res.forEach(async (e) => {
                            let html = '';
                            let html_btn_delete = '';
                            if (e.cobranza_id > 0) {
                                html = ` <span class="btn text-black">${e.cobranza_id}</span>
                                    <a href="/cobranza/enviar-mail/${e.cobranza_id}" class="btn text-success">Enviar C.</a>`;
                                
                                html_btn_delete = ``; 
                            } else {
                                html_btn_delete = `<a class='btn btn-danger btn-sm text-white' onclick="eliminar(${e.cliente_id}, ${e.periodo_id}, ${e.id_cliente_perido})"><i class="far fa-trash-alt"></i></a>`; 
                                html = `<a href="#" id="btnCobranza${e.cliente_id}_${e.periodo_id}_${e.id_cliente_perido}'" onclick="GenerarCobranza(${e.cliente_id}, ${e.periodo_id}, ${e.id_cliente_perido})" class="btn text-success">Cobranza</a>`;
                            }
                            $(`#resultado${e.periodo_id}`).append(`
                                <tr id="result-table" class="columnas-${e.cliente_id}_${e.periodo_id}_${e.id_cliente_perido}">
                                    <td hidden><input type="text" id='cliente_periodo_id_${e.cliente_id}_${e.periodo_id}_${e.id_cliente_perido}' value="${e.id_cliente_perido}"></td>
                                    <td><input type="checkbox" id='exento_${e.cliente_id}_${e.periodo_id}_${e.id_cliente_perido}' onchange="exentoChequeo(${e.cliente_id}, ${e.periodo_id}, ${e.id_cliente_perido})"></td>
                                    <td  scope="row" class="align-middle text-center"><input type='text' id='nombre_cliente_${e.cliente_id}_${e.periodo_id}_${e.id_cliente_perido}' readonly class='form-control servicio mx-auto text-center' value='${e.nombre_empresa}' ></td>
                                    <td  scope="row" class="align-middle text-center"><input type='text' id='descripcion_producto_${e.cliente_id}_${e.periodo_id}_${e.id_cliente_perido}'  class='form-control mx-auto text-center' value='Honorarios ${$(`#conceto${e.periodo_id}`).val()}' ></td>
                                    <td  scope="row" class="align-middle "><input type='text' id='cantidad_producto_${e.cliente_id}_${e.periodo_id}_${e.id_cliente_perido}' style="width: 50px;" class='form-control cantidad mx-auto text-center cantidad_req' value='1' readonly></td>
                                    <td  scope="row" class="align-middle"><input type='number' id='valor_neto_${e.cliente_id}_${e.periodo_id}_${e.id_cliente_perido}'  style="width: 100px;" class='form-control valor_unitreq mx-auto text-center'  onkeyup="calcularIVA(${e.cliente_id}, ${e.periodo_id}, ${e.id_cliente_perido});" value="${e.monto_base}"></td> 
                                    <td  scope="row" class="align-middle"><input type='text' id='iva_${e.cliente_id}_${e.periodo_id}_${e.id_cliente_perido}' readonly style="width: 80px;" class='form-control-plaintext text-center' value='0' step='any'></td>
                                    <td  scope="row" class="align-middle"><input type='text' id='valor_iva_${e.cliente_id}_${e.periodo_id}_${e.id_cliente_perido}' readonly style="width: 80px;" class='form-control-plaintext text-center' value='0' step='any'></td>
                                    <td  scope="row" class="align-middle">
                                        <select class="form-control" id="forma_pago_id_${e.cliente_id}_${e.periodo_id}_${e.id_cliente_perido}">
                                            ${window.option_formas_pagos}
                                        </select>
                                    </td>
                                    <td  scope="row" class="align-middle">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <span class="btn text-black d-none" id="idcobranza_${e.cliente_id}_${e.periodo_id}_${e.id_cliente_perido}"></span>
                                            ${html}
                                            <a href="#" id="btnFactura${e.cliente_id}_${e.periodo_id}_${e.id_cliente_perido}'" onclick="FacturaSii(${e.cliente_id}, ${e.periodo_id}, ${e.id_cliente_perido})" class="btn text-primary">Sii</a>
                                        </div>
                                    </td>
                                    <td  scope="row" class="align-middle text-center">
                                        ${html_btn_delete} 
                                    </td>
                                </tr>
                            `);

                            calcularIVA(e.cliente_id, e.periodo_id, e.id_cliente_perido);
                        });

                    }else{
                        alert("Sin resultados en la busqueda...")
                    }
                }
            });
        }
        function agregar(periodo_id) {
            let cliente_id = $(`#clientenuevo_${periodo_id}`).val()
            
            $.ajax({
                type: "GET",
                url: '/agregar-clientes-periodos/',
                data: {
                    cliente_id : cliente_id,
                    periodo_id : periodo_id
                },
                success: function(res) {
                    if (res.length > 0) {
                        //recorremos informacion
                        res.forEach(async (e) => {
                            let html = '';
                            let html_btn_delete = '';
                            if (e.cobranza_id > 0) {
                                html = ` <span class="btn text-black">${e.cobranza_id}</span>
                                    <a href="/cobranza/enviar-mail/${e.cobranza_id}" class="btn text-success">Enviar C.</a>`;
                                
                                html_btn_delete = `nada`; 
                            } else {
                                html_btn_delete = `<td  scope="row" class="align-middle text-center"><a class='btn btn-danger btn-sm text-white' onclick="eliminar(${e.cliente_id}, ${e.periodo_id}, ${e.id_cliente_perido})"><i class="far fa-trash-alt"></i></a></td>`; 
                                html = `<a href="#" id="btnCobranza${e.cliente_id}_${e.periodo_id}_${e.id_cliente_perido}'" onclick="GenerarCobranza(${e.cliente_id}, ${e.periodo_id}, ${e.id_cliente_perido})" class="btn text-success">Cobranza</a>`;
                            }
                            $(`#resultado${e.periodo_id}`).append(`
                                <tr id="result-table" class="columnas-${e.cliente_id}_${e.periodo_id}_${e.id_cliente_perido}">
                                    <td hidden><input type="text" id='cliente_periodo_id_${e.cliente_id}_${e.periodo_id}_${e.id_cliente_perido}' value="${e.id_cliente_perido}"></td>
                                    <td><input type="checkbox" id='exento_${e.cliente_id}_${e.periodo_id}_${e.id_cliente_perido}' onchange="exentoChequeo(${e.cliente_id}, ${e.periodo_id}, ${e.id_cliente_perido})"></td>
                                    <td  scope="row" class="align-middle text-center"><input type='text' id='nombre_cliente_${e.cliente_id}_${e.periodo_id}_${e.id_cliente_perido}' readonly class='form-control servicio mx-auto text-center' value='${e.nombre_empresa}' ></td>
                                    <td  scope="row" class="align-middle text-center"><input type='text' id='descripcion_producto_${e.cliente_id}_${e.periodo_id}_${e.id_cliente_perido}'  class='form-control mx-auto text-center' value='Honorarios ${$(`#conceto${e.periodo_id}`).val()}' ></td>
                                    <td  scope="row" class="align-middle "><input type='text' id='cantidad_producto_${e.cliente_id}_${e.periodo_id}_${e.id_cliente_perido}' style="width: 50px;" class='form-control cantidad mx-auto text-center cantidad_req' value='1' readonly></td>
                                    <td  scope="row" class="align-middle"><input type='number' id='valor_neto_${e.cliente_id}_${e.periodo_id}_${e.id_cliente_perido}'  style="width: 100px;" class='form-control valor_unitreq mx-auto text-center'  onkeyup="calcularIVA(${e.cliente_id}, ${e.periodo_id}, ${e.id_cliente_perido});" value="${e.monto_base}"></td> 
                                    <td  scope="row" class="align-middle"><input type='text' id='iva_${e.cliente_id}_${e.periodo_id}_${e.id_cliente_perido}' readonly style="width: 80px;" class='form-control-plaintext text-center' value='0' step='any'></td>
                                    <td  scope="row" class="align-middle"><input type='text' id='valor_iva_${e.cliente_id}_${e.periodo_id}_${e.id_cliente_perido}' readonly style="width: 80px;" class='form-control-plaintext text-center' value='0' step='any'></td>
                                    <td  scope="row" class="align-middle">
                                        <select class="form-control" id="forma_pago_id_${e.cliente_id}_${e.periodo_id}_${e.id_cliente_perido}">
                                            ${window.option_formas_pagos}
                                        </select>
                                    </td>
                                    <td  scope="row" class="align-middle">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <span class="btn text-black d-none" id="idcobranza_${e.cliente_id}_${e.periodo_id}_${e.id_cliente_perido}"></span>
                                            ${html}
                                            <a href="#" id="btnFactura${e.cliente_id}_${e.periodo_id}_${e.id_cliente_perido}" onclick="FacturaSii(${e.cliente_id}, ${e.periodo_id}, ${e.id_cliente_perido})" class="btn text-primary">Sii</a>
                                        </div>
                                    </td>
                                    ${hml_btn_delete}
                                </tr>
                            `);

                            calcularIVA(e.cliente_id, e.periodo_id, e.id_cliente_perido);
                        });

                    }else{
                        alert("Sin resultados en la busqueda...")
                    }
                }
            });
        }
        function traerFormasPagos() {
            $.ajax({
                type: "GET",
                url: '/formas-pagos-json',
                success: function(res) {
                    if (res.length > 0) {
                        res.forEach(element => {
                            window.option_formas_pagos += `<option value="${element.id}">${element.nombre_fp}</option>` 
                        });
                    }
                }
            });
        }

        function exentoChequeo(id, periodoid, clienteperiodoid){
            if ($('#exento_'+id+'_'+periodoid+'_'+clienteperiodoid).is( ":checked" )) {
                $("#valor_neto_"+id+'_'+periodoid+'_'+clienteperiodoid).removeAttr("onkeyup");
                $("#btnFactura"+id+'_'+periodoid+'_'+clienteperiodoid).addClass("d-none");
                $("#iva_"+id+'_'+periodoid+'_'+clienteperiodoid).val(0);
                $("#valor_iva_"+id+'_'+periodoid+'_'+clienteperiodoid).val(0);

            }else{
                calcularIVA(id, periodoid, clienteperiodoid);
                $("#valor_neto_"+id+'_'+periodoid+'_'+clienteperiodoid).attr('onkeyup','calcularIVA('+id+','+periodoid+', '+clienteperiodoid+')');
                $("#btnFactura"+id+'_'+periodoid+'_'+clienteperiodoid).removeClass("d-none");
            }
        }
        function eliminar(id, periodoid, clienteperiodoid)
        {
            $('.columnas-'+id+'_'+periodoid+'_'+clienteperiodoid).remove();
        }
        function calcularIVA(id, periodoid, clienteperiodoid)
        {
            var neto = $("#valor_neto_"+id+'_'+periodoid+'_'+clienteperiodoid).val();
            var suma = neto * 0.19;
            var ivatotal = (neto * 19)/100;
            $("#iva_"+id+'_'+periodoid+'_'+clienteperiodoid).val(Math.ceil(ivatotal));
            var iva_c = (parseInt(neto) * 0.19) + parseInt(neto);
            let iva = Math.ceil(iva_c);
            $("#valor_iva_"+id+'_'+periodoid+'_'+clienteperiodoid).val(isNaN(iva_c)? 0 : iva_c.toFixed(0));
        }
        function GenerarCobranza(id,periodoid, clienteperiodoid) {
            if($('#valor_neto_'+id+'_'+periodoid+'_'+clienteperiodoid).val() == 0){
                alert('Debe colocar un monto.');
                return false;
            }
            $.ajax({
                type:'POST',
                url:'{{url("clientes/cobranza")}}/'+id,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id" : id,
                    "nombre_cliente": $('#nombre_cliente_'+id+'_'+periodoid+'_'+clienteperiodoid).val(),
                    "descripcion_producto": $('#descripcion_producto_'+id+'_'+periodoid+'_'+clienteperiodoid).val(),
                    "cantidad_producto": $('#cantidad_producto_'+id+'_'+periodoid+'_'+clienteperiodoid).val(),
                    "valor_neto": $('#valor_neto_'+id+'_'+periodoid+'_'+clienteperiodoid).val(),
                    "iva": $('#iva_'+id+'_'+periodoid+'_'+clienteperiodoid).val(),
                    "valor_iva": $('#valor_iva_'+id+'_'+periodoid+'_'+clienteperiodoid).val(),
                    "forma_pago_id": $('#forma_pago_id_'+id+'_'+periodoid+'_'+clienteperiodoid).val(),
                    "cliente_periodo_id": $('#cliente_periodo_id_'+id+'_'+periodoid+'_'+clienteperiodoid).val(),
                },
                beforeSend: function() {
                  //  $('#staticBackdrop').modal('show');
                },
                success:function(data) {
                    $('#btnCobranza'+id+'_'+periodoid+'_'+clienteperiodoid).addClass('d-none');
                    $('#idcobranza_'+id+'_'+periodoid+'_'+clienteperiodoid).removeClass('d-none');
                    $('#idcobranza_'+id+'_'+periodoid+'_'+clienteperiodoid).html(data);
                    alert('Registro enviado con exito!!');
                    $(`#resultado${periodoid}`).empty()
                    listadoClientesPeriodos()
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
        function StatusPeriodo(periodoid) {
            $.ajax({
                type:'PUT',
                url:'{{url("periodo")}}/'+periodoid,
                data: {
                    "_token": "{{ csrf_token() }}",
                    periodo_cerrado : $('#periodo_cerrado_'+periodoid).val()
                },
                success:function(data) {
                    window.location.reload()

                    $('#cerrar_'+periodoid).removeClass('btn-info');
                    $('#cerrar_'+periodoid).addClass('btn-danger');
                    // $('#idcobranza_'+id+'_'+periodoid+'_'+clienteperiodoid).html(data);
                }
            });
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