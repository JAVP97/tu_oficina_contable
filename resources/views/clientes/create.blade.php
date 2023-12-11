@extends('layouts.frontend')
@section('title', 'Inicio')
@section('content')
    <div class="container">
        <div class="row">
            <form method="POST" action="{{ route('clientes.store') }}">
                @csrf
                <div class="col-6">
                    <label for="personalidad" class="col-form-label">Personalidad</label>
                    <div class="form-group">
                        <input type="text" class="form-control @error('personalidad') is-invalid @enderror"
                            id="personalidad" name="personalidad" value="{{ old('personalidad') }}"
                            placeholder="Personalidad" required>
                        @error('personalidad')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
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
                <div class="col-6">
                    <div class="col-md-5">
                        <label for="rut" class="col-form-label">RUT</label>
                        <div class="hstack gap-1">
                            <input class="form-control" minlength="1" maxlength="13" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" name="rut_empresa" id="rut_empresa" @error('rut_empresa') is-invalid @enderror" value="{{ old('rut_empresa') }}" type="number" style="width: 91px;" required>
                            @error('rut_empresa')
                                <span class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-6">
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
                <div class="col-6">
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
                <div class="col-6">
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
                <div class="col-6">
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
                <div class="col-6">
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
                <div class="col-6">
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
                        <input type="text" class="form-control @error('tasa_ppm') is-invalid @enderror"
                            id="tasa_ppm" name="tasa_ppm" value="{{ old('tasa_ppm') }}"
                            required>
                        @error('direccion')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <label for="fecha_cobro" class="col-form-label">Fecha de cobro</label>
                    <div class="form-group">
                        <input type="text" class="form-control @error('fecha_cobro') is-invalid @enderror"
                            id="fecha_cobro" name="fecha_cobro" value="{{ old('fecha_cobro') }}"
                            required>
                        @error('fecha_cobro')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-sm-9">
                        <div>
                            <button type="submit" class="btn btn-primary w-md">Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')