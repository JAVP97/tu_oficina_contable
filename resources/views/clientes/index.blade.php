@extends('layouts.frontend')
@section('title', 'Listado de Clientes')
@section('content')

<div class="row">
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-body table-responsive">
                <h4 class="card-title mb-4">Listado</h4>
                <table id="laravel_datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                        <tr class="text-center">
                            <th>Personalidad</th>
                            <th>Nombre empresa</th>
                            <th>RUT</th>
                            <th>Profesión</th>
                            <th>Dirección</th> 
                            <th>Región</th>
                            <th>Comuna</th>
                            <th>Comentario</th>
                            <th>Teléfono</th>
                            <th>Pass SII</th>
                            <th>Tasa PPM</th>
                            <th>Fecha cobro</th>
                            <th><i class="bx bx-cog font-size-16"></i></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')