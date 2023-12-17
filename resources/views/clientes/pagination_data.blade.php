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
                <td>{{ $cliente->comuna_id }}</td>
                <td>{{ $cliente->comentario }}</td>
                <td>{{ $cliente->telefono }}</td>
                <td>{{ $cliente->pass_sii }}</td>
                <td>{{ $cliente->tasa_ppm }}</td>
                <td>{{ $cliente->fecha_cobro }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
{!! $clientes->links() !!}