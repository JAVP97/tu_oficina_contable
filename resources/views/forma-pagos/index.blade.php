@extends('layouts.frontend')
@section('title', 'Forma de Pagos')
@section('content')

<div class="row">
    <div class="col-md-12 col-12">
        <div class="card col-12 col-md-6">
            <div class="card-body">
                <h5 class="card-title mb-4">Forma de Pagos</h5>
                <form action="{{route('forma-pago.store')}}" method="post" id="form" class="row gy-2 gx-3 align-items-center">
                @csrf
                    <div class="col-sm-auto">
                        <label class="visually" for="nombre_fp">Nombre forma de pago</label>
                        <input type="text" class="form-control" id="nombre_fp" name="nombre_fp" required>
                    </div>

                    <div class="col-sm-auto">
                        <button type="submit" class="btn btn-primary w-md mt-4" id="send">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card col-12 col-md-6">
            <div class="card-body table-responsive">
                <h4 class="card-title mb-4">Información</h4>
                <table id="laravel_datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                        <tr class="text-center">
                            <th>ID</th>
                            <th>Forma Pago</th>
                            <th><i class="bx bx-cog"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($forma_pago as $fp)
                            <tr>
                                <td>{{$fp->id}}</td>
                                <td>{{$fp->nombre_fp}}</td>
                                <td>
                                    <a href="{{route('forma-pago.edit', $fp->id)}}" class="btn btn-success">Editar</a>
                                    <form action="{{ route('forma-pago.destroy', $fp->id) }}" method="POST" style="display: inline;">
                                        {{ method_field('DELETE') }}
                                        @csrf
                                        <button class="btn btn-danger">Eliminar</button>
                                   </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    table{
        height: auto !important;
        display: flex !important;
        flex-flow: column !important;
        border-collapse: collapse !important;
        padding: 0px !important;
    }
    tbody {
        flex: 1 1 auto !important;
        display: block !important;
        overflow-y: auto !important;
        overflow-x: hidden !important;
    }
    tr {
        width: 100%!important;
        display: table!important;
        table-layout: fixed!important;
    }
    table tr th {
        cursor: pointer!important;
        -webkit-user-select: none!important;
        -moz-user-select: none!important;
        -ms-user-select: none!important;
        user-select: none!important;
    }

    .sorting {
        background-color: #D4D4D4!important;
    }

    .asc:after {
     content: ' ↑'!important;
    }

    .desc:after {
     content: " ↓"!important;
    }
</style>
@endpush

@push('script')
<script>
    $('th').click(function() {
        var table = $(this).parents('table').eq(0)
        var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
        this.asc = !this.asc
        if (!this.asc) {
            rows = rows.reverse()
        }
        for (var i = 0; i < rows.length; i++) {
            table.append(rows[i])
        }
        setIcon($(this), this.asc);
        })

        function comparer(index) {
        return function(a, b) {
            var valA = getCellValue(a, index),
            valB = getCellValue(b, index)
            return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB)
        }
        }

        function getCellValue(row, index) {
        return $(row).children('td').eq(index).html()
        }

        function setIcon(element, asc) {
        $("th").each(function(index) {
            $(this).removeClass("sorting");
            $(this).removeClass("asc");
            $(this).removeClass("desc");
        });
        element.addClass("sorting");
        if (asc) element.addClass("asc");
        else element.addClass("desc");
        }
</script>
@endpush