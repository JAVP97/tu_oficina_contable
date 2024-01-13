@extends('layouts.frontend')
@section('title', 'Crear Factura')
@section('content')
<form method="POST" action="{{ route('factura.store') }}">
    @csrf
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body row">
                        <h5 class="card-title mb-4">DATOS EMISOR</h5>
                        <div class="col-12 col-md-12 mb-2">
                            <input type="hidden" name="empresa_id" value="{{$empresa->id}}">
                            <label class="visually-hidden" for="razon_social">Razón Social</label>
                            <div class="input-group">
                                <div class="input-group-text">Razón Social</div>
                                <input type="text" class="form-control" id="razon_social" value="{{$empresa->razon_social}}">
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-2">
                            <label class="visually-hidden" for="direccion_empresa">Dirección</label>
                            <div class="input-group">
                                <div class="input-group-text">Dirección</div>
                                <input type="text" class="form-control" id="direccion_empresa" value="{{$empresa->direccion_empresa}}">
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-2">
                            <label class="visually-hidden" for="region_id">Región</label>
                            <div class="input-group">
                                <div class="input-group-text">Región</div>
                                <input type="text" class="form-control" id="region_id" value="{{$empresa->regiones->name}}">
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-2">
                            <label class="visually-hidden" for="comuna_id">Comuna</label>
                            <div class="input-group">
                                <div class="input-group-text">Comuna</div>
                                <input type="text" class="form-control" id="comuna_id" value="{{$empresa->comuna->name}}">
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-2">
                            <label class="visually-hidden" for="tipo_venta">Tipo de Venta</label>
                            <div class="input-group">
                                <div class="input-group-text">Tipo de Venta</div>
                                <input type="text" class="form-control" id="tipo_venta" value="{{$empresa->tipo_venta}}">
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-2">
                            <label class="visually-hidden" for="email">Email</label>
                            <div class="input-group">
                                <div class="input-group-text">Email</div>
                                <input type="text" class="form-control" id="email" value="{{$empresa->email_empresa}}">
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-2">
                            <label class="visually-hidden" for="telefono_empresa">Teléfono</label>
                            <div class="input-group">
                                <div class="input-group-text">Teléfono</div>
                                <input type="text" class="form-control" id="telefono_empresa" value="{{$empresa->telefono_empresa}}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-2">
                            <label class="visually-hidden" for="giro_empresa">Giro</label>
                            <div class="input-group">
                                <div class="input-group-text">Giro</div>
                                <input type="text" class="form-control" id="giro_empresa" value="{{$empresa->giro_empresa}}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-2">
                            <label class="visually-hidden" for="act_econo_empresa">Actividad Economica</label>
                            <div class="input-group">
                                <div class="input-group-text">Actividad Economica</div>
                                <input type="text" class="form-control" id="act_econo_empresa" value="{{$empresa->act_econo_empresa}}">
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- end card -->
                <div class="card">
                    <div class="card-body row">
                        <h5 class="card-title mb-4">DATOS RECEPTOR</h5>
                        <div class="col-12 col-md-12 mb-2">
                            <label class="visually-hidden" for="razon_social">Cliente</label>
                            <div class="input-group">
                                <div class="input-group-text">Cliente</div>
                                <select name="cliente_id" id="cliente_id" class="form-control">
                                    <option value="">Seleccione cliente</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{$cliente->id}}">{{$cliente->nombre_empresa}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-2">
                            <label class="visually-hidden" for="rut_cliente">RUT</label>
                            <div class="input-group">
                                <div class="input-group-text">RUT</div>
                                <input type="text" class="form-control" id="rut_cliente" readonly value="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-2">
                            <label class="visually-hidden" for="nombre_empresa">Razon Social</label>
                            <div class="input-group">
                                <div class="input-group-text">Razón Social</div>
                                <input type="text" class="form-control" id="nombre_empresa" readonly value="">
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-2">
                            <label class="visually-hidden" for="direccion">Dirección</label>
                            <div class="input-group">
                                <div class="input-group-text">Dirección</div>
                                <input type="text" class="form-control" id="direccion" readonly value="">
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-2">
                            <label class="visually-hidden" for="region">Región</label>
                            <div class="input-group">
                                <div class="input-group-text">Región</div>
                                <input type="text" class="form-control" id="region" readonly value="">
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-2">
                            <label class="visually-hidden" for="comuna">Comuna</label>
                            <div class="input-group">
                                <div class="input-group-text">Comuna</div>
                                <input type="text" class="form-control" id="comuna" readonly value="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-2">
                            <label class="visually-hidden" for="tipo_compra">Tipo de Compra</label>
                            <div class="input-group">
                                <div class="input-group-text">Tipo de Compra</div>
                                <input type="text" class="form-control" id="tipo_compra" readonly value="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-2">
                            <label class="visually-hidden" for="giro_empresa">Giro</label>
                            <div class="input-group">
                                <div class="input-group-text">Giro</div>
                                <input type="text" class="form-control" id="giro_empresa" readonly value="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-2">
                            <label class="visually-hidden" for="act_econo_empresa">Contacto</label>
                            <div class="input-group">
                                <div class="input-group-text">Contacto</div>
                                <input type="text" class="form-control" id="act_econo_empresa" value="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-2">
                            <label class="visually-hidden" for="act_econo_empresa">RUT Solicitante</label>
                            <div class="input-group">
                                <div class="input-group-text">RUT Solicitante</div>
                                <input type="text" class="form-control" id="act_econo_empresa" value="">
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- end card -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">DATOS RECEPTOR</h5>
                            <span class="btn btn-success float-right mb-4" onclick="agregar()" style="cursor: pointer;float:right;"><i class="bx bx-plus"></i>  Agregar linea de detalle</span>
                            <table id="tabla" class="table text-center table-bordered align-middle nowrap mt-5">
                                <thead class="text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre producto</th>
                                        <th>Descripcion</th>
                                        <th>Cantidad</th>
                                        <th>Unidad</th>
                                        <th>Valor neto</th>
                                        <th hidden>Total neto</th>
                                        <th>Desc.%</th>
                                        <th hidden>Desc.$</th>
                                        <th>Sub Total</th>
                                        <th>Quitar</th>
                                    </tr>
                                </thead>
                                <tbody id="resultado">
                                    <tr id="result-table" class="columnas-0">
                                        <td  scope="row" class="align-middle"><b>0</b></td>
                                        <td  scope="row" class="align-middle text-center"><input type='text' name='nombre_producto[]' id='nombre_producto'  class='form-control servicio mx-auto text-center' value='' style='width:220px'></td>
                                        <td  scope="row" class="align-middle text-center"><input type='text' name='descripcion_producto[]' id='descripcion_producto'  class='form-control mx-auto text-center' value='' style='width:220px'></td>
                                        <td  scope="row" class="align-middle "><input type='number' name='cantidad_producto[]' id='cantidad_producto'  class='form-control cantidad mx-auto text-center cantidad_req'  onChange='obtTotalMat(0);' onkeyup='obtTotalMat(0);' value='0' style='width:80px'></td>
                                        <td  scope="row" class="align-middle "><input type='number' name='unidad[]' id='unidad'  class='form-control  mx-auto text-center' value='0' style='width:80px'></td>
                                        <td  scope="row" class="align-middle"><input type='number' name='valor_neto[]' id='valor_neto'  class='form-control valor_unitreq mx-auto text-center'  onChange='obtTotalMat(0);' onkeyup='obtTotalMat(0);' value='0' style='width:100px'></td> 
                                        <td hidden scope="row" class="align-middle"><input type='number' name='total_neto[]' readonly id='totales' class='form-control-plaintext valor_totreq text-center' onchange='calcTotal();' value='0'></td> 
                                        <td  scope="row" class="align-middle" id="descuento_alert_0"><input type='number' name='descuento[]' id='descuento_0' class='form-control text-center mx-auto descuento_req' step='any'  style='width:75px' onChange='CalPorcentaje(0);' onkeyup='CalPorcentaje(0);' value='0'></td> 
                                        <td hidden scope="row" class="align-middle"><input type='number' name='descuento_clp[]' id='descuentoclp_0' class='form-control-plaintext descuentoclp text-center' readonly step='any' value='0' onkeyup='CalCLP(0);' readonly></td> 
                                        <td  scope="row" class="align-middle"><input type='number' name='total_descuento_item[]' id='total_descuento_item' readonly class='form-control-plaintext text-center total_descuento' value='0' onChange='TotalPorcentaje();' step='any'></td>
                                        <td  scope="row" class="align-middle text-center"><a class='btn btn-danger btn-sm text-white' onclick="eliminar(0)"><i class="far fa-trash-alt"></i></a></td> 
                                    </tr>
                                </tbody>
                                <table style="width: 30%" class="table text-center table-bordered align-middle nowrap">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Sub Total</th>
                                            <th><input type="text" readonly class="form-control-plaintext text-center" name="sub_total_pre" id="sub_total_pre"></th>
                                        </tr>
                                        <tr>
                                            <th>Desc %</th>
                                            <th><input type="text" readonly class="form-control-plaintext text-center" name="descuento_porcentaje" id="descuento_porcentaje"></th>
                                        </tr>
                                        <tr>
                                            <th>Desc $</th>
                                            <th><input type="text" readonly class="form-control-plaintext text-center" name="descuento_pesos" id="descuento_pesos"></th>
                                        </tr>
                                        <tr>
                                            <th>IVA</th>
                                            <th><input type="text" readonly class="form-control-plaintext text-center" name="iva_pre" id="iva_pre"></th>
                                        </tr>
                                        <tr>
                                            <th>Neto</th>
                                            <th><input type="text" readonly class="form-control-plaintext text-center" name="neto_pre" id="neto_pre"></th>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <th><input type="text" readonly class="form-control-plaintext text-center" name="total_pre" id="total_pre"></th>
                                        </tr>
                                    </thead>
                                </table>
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
        $('#region_id').on('change', function() { 
            var region = $(this).val();
            if($.trim(region) != ''){
                $.get("{{ url('regiones') }}", {region: region}, function(region){
                    $('#comuna_id').empty();
                    $('#comuna_id').append("<option value=''>Seleccione Comuna</option>");
                    $.each(region, function (index, value){
                    $('#comuna_id').append("<option value='"+ index +"'>"+ value +"</option>");
                    });

                });
            }
        });

        $('#cliente_id').change(function () {
                var id_cliente = $(this).val();

                if ($.trim(id_cliente) != '') {
                    $.get("{{route('clientes.get')}}", {id_cliente: id_cliente}, function(cliente) {
                        console.log(cliente);
                        $('#rut_cliente').empty();
                        $('#nombre_empresa').empty();
                        $('#direccion').empty();
                        $('#region').empty();
                        $('#comuna').empty();
                        $('#tipo_compra').empty();
                        $('#giro').empty();
                        $.each(cliente, function (index, value) {
                            $('#rut_cliente').val(value.rut_empresa);
                            $('#nombre_empresa').val(value.nombre_empresa);
                            $('#name').val(value.name);
                            $('#direccion').val(value.direccion);
                            $('#region').val(value.region);
                            $('#comuna').val(value.comuna);
                            $('#tipo_compra').val(value.tipo_compra);
                            $('#giro').val(value.giro);
                            $("#id_sectores option[value='"+value.id_sectores+"']").prop("selected", "selected");
                        })
                    });
                }
            })
    </script>
@endpush