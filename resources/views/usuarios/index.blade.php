@extends('layouts.frontend')
@section('title', 'Usuarios')


@section('content')
<!-- start page title -->
<div class="row">
  <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0 font-size-18">Usuarios</h4>

          <div class="page-title-right">
              <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{url('home')}}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active">Usuarios</li>
              </ol>
          </div>

      </div>
  </div>
</div>

<div class="container-fluid">
  <div class="card">
    <div class="card-body border-bottom">
        <div style="float:right">
            <a href="{{route('users.create')}}" class="btn btn-primary"><i class="bx bx-plus"></i> Crear nuevo usuario</a>
        </div>
    </div>
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
          <thead>
              <tr>
                  <th>Nombre</th>
                  <th>Email</th>
                  <th>RUT</th>
                  <th>Roles</th>
                  <th>Acción</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($usuarios as $row )
              <tr>
                  <td> {{ $row->name }}</td>
                  <td> {{ $row->email }}</td>
                  <td class="text-right">{{ $row->rut }} </td>
                  <td>
                    {{$row->getRoleNames()->implode(', ')}}
                  </td>
                  <td class="text-center">
                      <a class="btn btn-info btn-sm mr-2" href="{{ route('users.show', $row->id) }}"><i class="mdi mdi-eye-outline"></i></a>
                      <a class="btn btn-primary btn-sm mr-2" href="{{ route('users.edit', $row->id) }}"><i class="fas fa-pen"></i></a>
                        <form action="{{ route('users.destroy', $row->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm text-white"><i class="fas fa-trash-alt"></i></button>
                        </form>
                  </td>
              </tr>
              @endforeach
          </tbody>
      </table>
    </div>
  </div>
</div>
@endsection



@push('styles')

    <link rel="stylesheet" href="{{ url('js/components/datatables-bs4/css/dataTables.bootstrap4.min.css') }}"> 

    <link rel="stylesheet" href="{{ url('js/components/datatables-responsive/css/responsive.bootstrap4.min.css') }}"> 

@endpush



@push('script')

    <!-- DataTables -->

    <script src="{{ url('js/components/datatables/jquery.dataTables.min.js') }}"></script> 

    <script src="{{ url('js/components/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script> 

    <script src="{{ url('js/components/datatables-responsive/js/dataTables.responsive.min.js') }}"></script> 

    <script src="{{ url('js/components/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script> 
    <script src="{{ url('js/jquery.rut.js') }}"></script> 

    <script>

      $(function () {

        $("#example1").DataTable({

          "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla =(",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                  "sFirst": "Primero",
                  "sLast": "Último",
                  "sNext": ">>",
                  "sPrevious": "<<"
                },
                "oAria": {
                  "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                  "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                  "copy": "Copiar",
                  "colvis": "Visibilidad"
                }
            },

          "responsive": true,

          "autoWidth": false,

        });

      });

    </script>
@endpush