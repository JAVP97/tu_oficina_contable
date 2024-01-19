<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
              <title>#{{$cotizacion->id}} - {{$cliente->name}} {{$cliente->lastname}} {{$cotizacion->fecha_cotizacion->format('d-m-Y')}}</title>  
              <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
              <style>
                body{
                  font-size: 11px;
                }
                .border-top {
                    border-top: 1px solid #000000 !important;
                }
                .border {
                  border: 1px solid #000000 !important;
                }
              </style>
    </head>
    <body class="container-fluid">
      <table width="100%">
        <tr>
          <td><img src="https://www.bcasual.cl/wp-content/uploads/2019/09/logo-bcasual.jpg" alt="" style="width:150px"></td>
          <td>
            <table>
              <tr>
                <th>Cliente:</th>
                <td>{{$cliente->name}} {{$cliente->lastname}}</td>
              </tr>
              <tr>
                <th>Teléfono:</th>
                <td>{{$cliente->phone}}</td>
              </tr>
              <tr>
                <th>E-mail:</th>
                <td>{{$cliente->email}}</td>
              </tr>
              @if (isset($cotizacion->email_cliente_cc))
                  <tr>
                    <th>E-mail Copia:</th>
                    <td>{{$cotizacion->email_cliente_cc}}</td>
                  </tr>
              @endif
            </table>
          </td>
          <td width="35%" style="border:3px solid green;color:green;font-size:20px">
            <table width="100%" style="text-align: center">
              <tr>
                <td>Cotización</td>
              </tr>
              <tr>
                <th>{{$cotizacion->id}}</th>
              </tr>
              <tr>
                <td>1</td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <br>
      <div style="float: right">
        <span><strong>Fecha Emisión</strong> {{$cotizacion->created_at->format('d, M Y')}}</span>
      </div>
      <table width="50%" style="border:3px solid black;">
        <tr> {{-- Primero --}}
          <th style="padding: 10px 0 0 10px">Cliente:</th>
          <td>{{$cliente->name}} {{$cliente->lastname}}</td>
        </tr>
        <tr>
          <th style="padding: 0 0 0 10px">Teléfono:</th>
          <td>{{$cliente->phone}}</td>
        </tr>
         <tr> {{-- Ultimo --}}
          <th style="padding: 0 0 10px 10px">E-mail:</th>
          <td>{{$cliente->email}}</td>
        </tr>
      </table>

      <table  style="font-size: 10px;width:100%" border="1">
        <thead class="text-center">
          <tr>
            <th>Foto</th>
            <th>Producto</th>
            <th>Fabricación</th>
            <th>Precio Venta Sin IVA</th>
            <th>-</th>
            <th>Cantidad</th>
            <th>Valor Total</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>


      </body>



      </html>