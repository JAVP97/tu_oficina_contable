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
{!! $clientes->links() !!}