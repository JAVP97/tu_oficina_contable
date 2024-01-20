@extends('layouts.frontend')
@section('title', 'Listado de Cobranzas')
@section('content')

<div class="row">
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-body ">
                <h4 class="card-title mb-4">Listado de Cobranza</h4>
                <div id="table_data">
                    <table id="laravel_datatable" class="table table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Fecha de creación</th>
                                <th>Empresa</th>
                                <th>RUT</th>
                                <th>Forma de pago</th>
                                <th>Descripción</th>
                                <th>Monto neto</th> 
                                <th>IVA</th>
                                <th>Monto + IVA</th>
                                <th><i class="bx bx-cog font-size-16"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cobranzas as $cobranza)
                                <tr class="text-center">
                                    <th><a href="{{route('cobranzas.show', $cobranza->id)}}" target="_blanck">{{$cobranza->id}}</a></th>
                                    <td>{{$cobranza->created_at->format('d-m-Y')}}</td>
                                    <td>{{$cobranza->cliente->nombre_empresa}}</td>
                                    <td>{{$cobranza->cliente->rut_empresa}}</td>
                                    <td>{{$cobranza->formaPago->nombre_fp}}</td>
                                    <td>{{$cobranza->descripcion}}</td>
                                    <td>{{number_format($cobranza->valor_neto, 0, '', '.')}}</td>
                                    <td>{{number_format($cobranza->iva, 0, '', '.')}}</td>
                                    <td>{{number_format($cobranza->valor_iva, 0, '', '.')}}</td>
                                    <td><a href="{{route('cobranzas.show', $cobranza->id)}}" target="_blanck">Ver</a></td>
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