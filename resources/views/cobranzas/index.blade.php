@extends('layouts.frontend')
@section('title', 'Listado de Cobranzas')
@section('content')

<div class="row">
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-body ">
                <h4 class="card-title mb-4">Listado</h4>
                <div id="table_data">
                    <table id="laravel_datatable" class="table table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
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
                            @foreach ($cobranzas as $cobranza)
                                <tr>
                                    <td>{{$cobranza->id}}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><a href="{{route('cobranzas.show', $cobranza->id)}}">Ver</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $cobranzas->links() !!}
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
       url:"/cobranza/pagination/fetch_data?page="+page,
       success:function(data)
       {
        $('#table_data').html(data);
       }
      });
     }
      
    });
    </script>
@endpush