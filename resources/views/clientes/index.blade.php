@extends('layouts.frontend')
@section('title', 'Listado de Clientes')
@section('content')

<div class="row">
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-body ">
                <h4 class="card-title mb-4">Listado</h4>
                <div class="table-rep-plugin">
                    <div class="table-wrapper">
                        <div class="btn-toolbar">
                            <div class="btn-group dropdown-btn-group pull-right">
                                <a href="{{route('clientes.create')}}" class="btn btn-primary">Crear cliente</a>                                
                            </div>
                        </div>
                    </div>
                </div>
                <div id="table_data">
                    <table id="laravel_datatable" class="table table-striped">
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
                        <tbody>
                            @foreach($clientes as $cliente)
                                <tr>
                                    <td>{{ $cliente->personalidad }}</td>
                                    <td>{{ $cliente->nombre_empresa }}</td>
                                    <td>{{ $cliente->rut_empresa }}</td>
                                    <td>{{ $cliente->profesion }}</td>
                                    <td>{{ $cliente->direccion }}</td>
                                    <td>{{ $cliente->region_id }}</td>
                                    <td>{{ $cliente->comuna_id }}</td>
                                    <td>{{ $cliente->comentario }}</td>
                                    <td>{{ $cliente->telefono }}</td>
                                    <td>{{ $cliente->pass_sii }}</td>
                                    <td>{{ $cliente->tasa_ppm }}</td>
                                    <td>{{ $cliente->fecha_cobro }}</td>
                                    <td>
                                        <a href="#" class="editarCliente" id="{{ $cliente->id }}"  data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"><i class="bx bx-edit"></i></a>
                                        <a href="#" class="eliminarCliente text-danger" id="{{ $cliente->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"><i class="bx bx-shield"></i></a>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $clientes->links() !!}
                </div>
            </div>            
        </div>
    </div>
</div>
{{--MODAL EDITAR--}}
<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar CLiente</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal row" role="form">
                    @include('clientes.formulario')
                    <div class="row justify-content-end mt-4">
                        <div class="col-sm-12">
                            <div>
                                <button id="actualizarCliente" class="btn btn-primary w-md">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@push('styles')
    
@endpush

@push('script')
    <script src="{{asset('js/clientes/index.js')}}"></script>
@endpush
