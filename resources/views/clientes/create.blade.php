@extends('layouts.frontend')
@section('title', 'Crear Cliente')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Cliente información</h5>
                        <form method="POST" action="{{ route('clientes.store') }}" class="row">
                            @csrf
                            <div class="col-12 col-md-3">
                                <label for="personalidad" class="col-form-label">Personalidad</label>
                                <div class="form-group">
                                    <select id="personalidad" name="personalidad" class="form-control @error('personalidad') is-invalid @enderror" required>
                                        <option value="Natural">Natural</option>
                                    </select>
                                    @error('personalidad')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="nombre_empresa" class="col-form-label">Nombre empresa</label>
                                <div class="form-group">
                                    <input type="text" class="form-control @error('nombre_empresa') is-invalid @enderror"
                                        id="nombre_empresa" name="nombre_empresa" value="{{ old('nombre_empresa') }}"
                                        placeholder="Nombre empresa" required>
                                    @error('nombre_empresa')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="rut" class="col-form-label">RUT</label>
                                <input class="form-control" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="rut_empresa" id="rut_empresa" @error('rut_empresa') is-invalid @enderror" value="{{ old('rut_empresa') }}" type="text" required>
                                @error('rut_empresa')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="profesion" class="col-form-label">Profesión</label>
                                <div class="form-group">
                                    <input type="text" class="form-control @error('profesion') is-invalid @enderror"
                                        id="profesion" name="profesion" value="{{ old('profesion') }}"
                                        placeholder="Profesión" required>
                                    @error('profesion')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="direccion" class="col-form-label">Dirección</label>
                                <div class="form-group">
                                    <input type="text" class="form-control @error('direccion') is-invalid @enderror"
                                        id="direccion" name="direccion" value="{{ old('direccion') }}"
                                        required>
                                    @error('direccion')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="region_id" class="col-form-label">Región</label>
                                <div class="form-group">
                                    <select name="region_id" id="region_id" class="form-select select2">
                                        <option selected>Seleccione Región</option>
                                        @foreach ($regiones as $region)
                                            <option value="{{$region->id}}">{{$region->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('region_id')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="comuna_id" class="col-form-label">Comuna</label>
                                <div class="form-group">
                                    <select name="comuna_id" id="comuna_id" class="form-select select2">
                                        <option selected>Seleccione Comuna</option>
                                        @foreach ($comunas as $comuna)
                                            <option value="{{$comuna->id}}">{{$comuna->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('comuna_id')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="telefono" class="col-form-label">Telefono</label>
                                <div class="form-group">
                                    <input type="text" class="form-control @error('telefono') is-invalid @enderror"
                                        id="telefono" name="telefono" value="{{ old('telefono') }}"
                                        required>
                                    @error('telefono')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="comentario" class="col-form-label">Comentario</label>
                                <div class="form-group">
                                    <input type="text" class="form-control @error('comentario') is-invalid @enderror"
                                        id="comentario" name="comentario" value="{{ old('comentario') }}"
                                        required>
                                    @error('comentario')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <h5 class="card-title mb-4">SII</h5>
                            <div class="col-6">
                                <label for="pass_sii" class="col-form-label">Contrasena SII</label>
                                <div class="form-group">
                                    <input type="text" class="form-control @error('pass_sii') is-invalid @enderror"
                                        id="pass_sii" name="pass_sii" value="{{ old('pass_sii') }}"
                                        required>
                                    @error('pass_sii')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="tasa_ppm" class="col-form-label">Tasa PPM</label>
                                <div class="form-group">
                                    <input type="number" min="0" class="form-control @error('tasa_ppm') is-invalid @enderror"
                                        id="tasa_ppm" name="tasa_ppm" value="{{ old('tasa_ppm') }}"
                                        required>
                                    @error('direccion')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <h5 class="card-title mb-4">Caracteristicas</h5>
                            <div class="col-12 col-md-3">
                                <label for="fecha_cobro" class="col-form-label">Fecha de cobro</label>
                                <div class="form-group">
                                    <input type="date" class="form-control @error('fecha_cobro') is-invalid @enderror"
                                        id="fecha_cobro" name="fecha_cobro" value="{{ old('fecha_cobro') }}"
                                        required>
                                    @error('fecha_cobro')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="notificar" class="col-form-label">Notificar</label>
                                <div class="form-group">
                                    <select id="notificar" name="notificar" class="form-control @error('notificar') is-invalid @enderror">
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                    
                                    @error('notificar')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="emails" class="col-form-label">Correos</label>
                                <div class="form-group">
                                    <input type="email" class="form-control @error('emails') is-invalid @enderror"
                                        id="emails" name="emails" value="{{ old('emails') }}"
                                        required>
                                    @error('emails')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>  
                            <div class="col-12 col-md-3">
                                <label for="exento_iva" class="col-form-label">Exento de IVA</label>
                                <div class="form-group">
                                    <select id="exento_iva" name="exento_iva" class="form-control @error('exento_iva') is-invalid @enderror">
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                    
                                    @error('exento_iva')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-3">
                                <label for="importaciones" class="col-form-label">Importaciones</label>
                                <div class="form-group">
                                    <select id="importaciones" name="importaciones" class="form-control @error('importaciones') is-invalid @enderror">
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                    @error('importaciones')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="remuneraciones" class="col-form-label">Remuneraciones</label>
                                <div class="form-group">
                                    <select id="remuneraciones" name="remuneraciones" class="form-control @error('remuneraciones') is-invalid @enderror">
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                    
                                    @error('remuneraciones')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="contabilidad" class="col-form-label">Contabilidad</label>
                                <div class="form-group">
                                    <select id="contabilidad" name="contabilidad" class="form-control @error('contabilidad') is-invalid @enderror">
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                    @error('contabilidad')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>  
                            <div class="col-12 col-md-3">
                                <label for="facturacion" class="col-form-label">Facturación</label>
                                <div class="form-group">
                                    <select id="facturacion" name="facturacion" class="form-control @error('facturacion') is-invalid @enderror">
                                        <option value="Si">Si</option>
                                        <option value="No">No</option>
                                    </select>
                                    
                                    @error('facturacion')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row justify-content-end mt-4">
                                <div class="col-sm-12">
                                    <div>
                                        <button type="submit" class="btn btn-primary w-md">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
        </div>
    </div>
@endsection

@push('styles')
@endpush

@push('script')
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
    </script>
@endpush