@extends('layouts.frontend')
@section('title', 'Libro de Bancos')
@section('content')

<div class="row">
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Ingresar Información</h5>
                <form action="{{route('LibroBancos.store')}}" method="post" id="form" class="row gy-2 gx-3 align-items-center">
                @csrf
                    <div class="col-sm-auto">
                        <label class="visually" for="fecha_ingreso">Fecha de ingreso</label>
                        <input type="date" class="form-control" id="fecha_ingreso" required>
                    </div>
                    <div class="col-sm-auto">
                        <label class="visually" for="tipo_operacion">Tipo de operación</label>
                        <select class="form-select" id="tipo_operacion" required>
                            <option selected="">Seleccione una opción</option>
                            <option value="Honorarios">Honorarios</option>
                            <option value="Gastos">Gastos</option>
                            <option value="Ingresos">Ingresos</option>
                        </select>
                    </div>
                    <div class="col-sm-auto">
                        <label class="visually" for="fecha_periodo">Periodo</label>
                        <input type="date" class="form-control" id="fecha_periodo" required>
                    </div>
                    <div class="col-sm-auto">
                        <label class="visually" for="descripcion">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" required>
                    </div>
                    <div class="col-sm-auto">
                        <label class="visually" for="factura">Factura</label>
                        <input type="text" class="form-control" id="factura" value="0" required>
                    </div>
                    <div class="col-sm-auto">
                        <label class="visually" for="debe">Debe</label>
                        <input type="text" class="form-control" id="debe" value="0" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" readonly>
                    </div>
                    <div class="col-sm-auto">
                        <label class="visually" for="debe">Haber</label>
                        <input type="text" class="form-control" id="haber" value="0" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" readonly>
                    </div>
                    
                    <div class="col-sm-auto">
                        <button type="submit" class="btn btn-primary w-md mt-4" id="send">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body table-responsive">
                <h4 class="card-title mb-4">Información</h4>
                <table id="laravel_datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                        <tr class="text-center">
                            <th>Fecha</th>
                            <th>Tipo de Operación</th>
                            <th>Periodo</th>
                            <th>Descripción</th>
                            <th>Factura</th> 
                            <th>Debe</th>
                            <th>Haber</th>
                            <th>Saldo</th>
                        </tr>
                    </thead>
                    <tbody id="result"></tbody>
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
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
<script src="https://momentjs.com/downloads/moment-with-locales.js"></script>
<script>
    $('#tipo_operacion').on('change', function() {
        if (this.value == 'Honorarios' || this.value == 'Ingresos') {
            $('#debe').attr('readonly', false);
            $('#haber').attr('readonly', true);
        } else if(this.value == 'Gastos'){
            $('#debe').attr('readonly', true);
            $('#haber').attr('readonly', false);
        }
    });
    $(document).ready(function () {
        $("form").submit(function (event) {
            var formData = {
                _token: "{{ csrf_token() }}",
                fecha_ingreso: $("#fecha_ingreso").val(),
                tipo_operacion: $("#tipo_operacion").val(),
                fecha_periodo: $("#fecha_periodo").val(),
                descripcion: $("#descripcion").val(),
                factura: $("#factura").val(),
                debe: $("#debe").val(),
                haber: $("#haber").val(),
            };
            $.ajax({
                type: "POST",
                url: "{{route('LibroBancos.store')}}",
                data: formData,
                dataType: "json",
                encode: true,
            }).done(function (data) {
                alert('Se ingresaron datos al libro de bancos.')
                $('#form')[0].reset();
                $('#debe').attr('readonly', true);
                $('#haber').attr('readonly', true);
                setInterval('location.reload()', 1000);

            });
            event.preventDefault();
        });
    });
    $(document).ready(function() {
        listadoData();

        function listadoData(){
            $.ajax({
                type: "GET",
                url: "{{route('list.data.lb')}}",
                data: {
                    _token: "{{ csrf_token() }}",
                }
            }).done(function (data) {
                console.log(data);
                for(var i =0;i < data.length;i++)
                {
                    var item = data[i];
                    $('#result').append(`
                        <tr>
                            <td>${moment(item.fecha_ingreso).locale('es').format("D MMMM YYYY")}</td>
                            <td>${item.tipo_operacion}</td>
                            <td>${moment(item.fecha_periodo).locale('es').format("MMMM YYYY")}</td>
                            <td>${item.descripcion}</td>
                            <td>${item.factura}</td>
                            <td><span class="text-success">${item.debe.toLocaleString('es-ES', {maximumFractionDigits: 0})}</span></td>
                            <td><span class="text-danger">${item.haber.toLocaleString('es-ES', {maximumFractionDigits: 0})}</span></td>
                            <td><span class="text-dark">${item.saldo.toLocaleString('es-ES', {maximumFractionDigits: 0})}</span></td>
                        </tr>`
                    );
                }
            });
        }
    });
</script>

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