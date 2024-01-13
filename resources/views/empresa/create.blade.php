@extends('layouts.frontend')
@section('title', 'Crear Empresa')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Empresa información</h5>
                        <form method="POST" action="{{ route('empresa.store') }}" class="row">
                            @csrf
                            <div class="col-12 col-md-12">
                                <label for="razon_social" class="col-form-label">Razón Social</label>
                                <div class="form-group">
                                    <input type="text" name="razon_social" id="razon_social" class="form-control @error('nombre_empresa') is-invalid @enderror" value="{{old('razon_social')}}" required>
                                    @error('personalidad')
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
                            <div class="col-12 col-md-4">
                                <label for="tipo_venta" class="col-form-label">Tipo de Venta</label>
                                <div class="form-group">
                                    <input type="text" class="form-control @error('tipo_venta') is-invalid @enderror"
                                        id="tipo_venta" name="tipo_venta" value="{{ old('tipo_venta') }}">
                                    @error('tipo_venta')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="email_empresa" class="col-form-label">Email</label>
                                <div class="form-group">
                                    <input type="email" class="form-control @error('email_empresa') is-invalid @enderror"
                                        id="email_empresa" name="email_empresa" value="{{ old('email_empresa') }}"
                                        required>
                                    @error('email_empresa')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="telefono_empresa" class="col-form-label">Telefono</label>
                                <div class="form-group">
                                    <input type="text" class="form-control @error('telefono_empresa') is-invalid @enderror"
                                        id="telefono_empresa" name="telefono_empresa" value="{{ old('telefono_empresa') }}"
                                        required>
                                    @error('telefono_empresa')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="giro_empresa" class="col-form-label">Giro</label>
                                <div class="form-group">
                                    <input type="text" class="form-control @error('giro_empresa') is-invalid @enderror"
                                        id="giro_empresa" name="giro_empresa" value="{{ old('giro_empresa') }}"
                                        required>
                                    @error('giro_empresa')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="act_econo_empresa" class="col-form-label">Actividad Economica</label>
                                <div class="form-group">
                                    <input type="text" class="form-control @error('act_econo_empresa') is-invalid @enderror"
                                        id="act_econo_empresa" name="act_econo_empresa" value="{{ old('act_econo_empresa') }}"
                                        required>
                                    @error('act_econo_empresa')
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