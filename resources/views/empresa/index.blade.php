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
                                @foreach($empresas as $e)
                                    @if ($e->id == 1)
                                        
                                    @else
                                    <a href="{{route('empresa.create')}}" class="btn btn-primary">Crear Empresa</a>                                
                                        
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div id="table_data">
                    <table id="laravel_datatable" class="table table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>Razón Social</th>
                                <th>Dirección</th>
                                <th>Región</th>
                                <th>Comuna</th>
                                <th>Tipo Venta</th> 
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Giro</th>
                                <th>Actividad Económica</th>
                                <th><i class="bx bx-cog font-size-16"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($empresas as $e)
                                <tr>
                                    <td>{{ $e->razon_social }}</td>
                                    <td>{{ $e->direccion_empresa }}</td>
                                    <td>{{ $e->region_id }}</td>
                                    <td>{{ $e->comuna_id }}</td>
                                    <td>{{ $e->tipo_venta }}</td>
                                    <td>{{ $e->email_empresa }}</td>
                                    <td>{{ $e->telefono_empresa }}</td>
                                    <td>{{ $e->giro_empresa }}</td>
                                    <td>{{ $e->act_econo_empresa }}</td>
                                    <td>
                                        <a href="{{route('empresa.edit', $e->id)}}" class="btn btn-success">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $empresas->links() !!}
                </div>
            </div>            
        </div>
    </div>
</div>

@endsection

@push('styles')
    
@endpush

@push('script')
<script>
    $(document).ready(function(){
    
     $(document).on('click', '.pagination a', function(event){
      event.preventDefault(); 
      var page = $(this).attr('href').split('page=')[1];
      fetch_data(page);
     });
    
     function fetch_data(page)
     {
      $.ajax({
       url:"/empresa/pagination/fetch_data?page="+page,
       success:function(data)
       {
        $('#table_data').html(data);
       }
      });
     }
      
    });
    </script>
@endpush