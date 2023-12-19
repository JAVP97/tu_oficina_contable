@extends('layouts.frontend')
@section('title', 'Inicio')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Cliente información</h5>
                        <form method="POST" action="{{ route('clientes.store') }}" class="row">
                            @csrf
                            @include('clientes.formulario')
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