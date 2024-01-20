<!DOCTYPE html>
<html lang="es">
    <head>
      <meta charset="UTF-8">
      <title>Cobranza {{$empresa->razon_social}} #{{$data->id}}</title>  
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
        footer {
          position: fixed;
          bottom: -60px;
          left: 0px;
          right: 0px;
          height: 50px;

          /** Extra personal styles **/
          background-color: #03a9f4;
          color: white;
          text-align: center;
          line-height: 35px;
        }
      </style>
    </head>
    <body class="container-fluid">
      <table width="100%">
        <tr>
          <td width="20%" style="padding-right: 20px"><img src="https://www.tuoficinacontable.cl/wp-content/uploads/2024/01/logo-factura-sistema.png" alt="" style="width:150px"></td>
          <td>
            <table>
              <tr>
                <th style="color:red;text-transform: uppercase;font-size:14px"> {{$empresa->razon_social}}</th>
              </tr>
              <tr>
                <td style="color:#3e3676">Giro: {{$empresa->giro_empresa}}</td>
              </tr>
              <tr>
                <td style="color:#3e3676">{{$empresa->direccion_empresa}} - {{$empresa->comuna->name}}</td>
              </tr>
              <tr>
                <td style="color:#3e3676">eMail: {{$empresa->email_empresa}}  Telefono: {{$empresa->telefono_empresa}}</td>
              </tr>
              <tr>
                <td style="color:#3e3676">TIPO DE VENTA: {{$empresa->tipo_venta}}</td>
              </tr>
            </table>
          </td>
          <td width="35%" style="border:3px solid red;color:red;font-size:20px">
            <table width="100%" style="text-align: center">
              <tr>
                <th>R.U.T.:{{$empresa->rut_empresa}}</th>
              </tr>
              <tr>
                <th>FACTURA ELECTRONICA</th>
              </tr>
              <tr>
                <th>FOLIO NO ASIGNADO</th>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <br>
      <div style="text-align: right;color:red;font-size:14px;width:75%">
        S.I.I. - SANTIAGO CENTRO
      </div>
      <div style="float: right">
        <span><strong style="color: #3e3676">Fecha Emisión</strong> {{$data->created_at->format('d, M Y')}}</span>
      </div>
      <table width="50%" style="border:2px solid black;">
        <tr> {{-- Primero --}}
          <th style="padding: 10px 0 0 10px;color: #3e3676">SEÑOR(ES):</th>
          <td style="text-transform: uppercase">{{$data->cliente->nombre_empresa}}</td>
        </tr>
        <tr>
          <th style="padding: 0 0 0 10px;color: #3e3676">R.U.T:</th>
          <td style="text-transform: uppercase">{{$data->cliente->rut_empresa}}</td>
        </tr>
        <tr> {{-- Ultimo --}}
          <th style="padding: 0 0 0 10px;color: #3e3676">GIRO:</th>
          <td style="text-transform: uppercase">{{$data->cliente->giro_cliente}}</td>
        </tr>
        <tr>
          <th style="padding: 0 0 0 10px;color: #3e3676">DIRECCION:</th>
          <td style="text-transform: uppercase">{{$data->cliente->direccion}}</td>
        </tr>
        <tr>
          <th style="padding: 0 0 0 10px;color: #3e3676">COMUNA:</th>
          <td style="text-transform: uppercase">{{$data->cliente->comuna->name}}</td>
        </tr>
        <tr>
          <th style="padding: 0 0 0 10px;color: #3e3676">CIUDAD:</th>
          <td style="text-transform: uppercase">{{$data->cliente->comuna->name}}</td>
        </tr>
      </table>
      <br>
      <table width="100%" style="font-size: 10px;width:100%"  style="border:1px solid black">
        <thead class="text-center">
          <tr style="color: #3e3676; border:1px solid black">
            <th style="border-right:1px solid black">Codigo</th>
            <th style="border-right:1px solid black">Descripcion</th>
            <th style="border-right:1px solid black">Cantidad</th>
            <th style="border-right:1px solid black">Precio</th>
            <th style="border-right:1px solid black">%Impoto Adic.</th>
            <th style="border-right:1px solid black">%Desc.</th>
            <th style="border-right:1px solid black">Valor</th>
          </tr>
        </thead>
        <tbody>
          <tr style="text-align: center;">
            <td>-</td>
            <td>{{$data->descripcion}}</td>
            <td>{{$data->cantidad}}</td>
            <td>{{number_format($data->valor_neto, 0, '', '.')}}</td>
            <td>-</td>
            <td>-</td>
            <td>{{number_format($data->valor_neto, 0, '', '.')}}</td>
          </tr>
        </tbody>
      </table>
      <div style="border: 1px solid black; margin: 40px 0"></div>

      <table width="100%">
        <tr>
          <td>
            <strong style="color: #3e3676">Forma de pago:</strong> {{$data->formaPago->nombre_fp}}
          </td>
        </tr>
        <tr>
          <br>
        </tr>
        <tr>
          <td width="40%" style="padding-right: 20px"><img src="https://www.tuoficinacontable.cl/wp-content/uploads/2024/01/timbre-vista-previa.png" style="width:200px"></td>
          <td width="60%" style="border:2px solid black;">
            <table width="100%" style="text-align: right">
              <tr>
                <th style="color: #3e3676">MONTO NETO $</th>
                <td style="text-align: left !important; padding-left: 20px">{{number_format($data->valor_neto, 0, '', '.')}}</td>
              </tr>
              <tr>
                <th style="color: #3e3676">I.V.A. 19% $</th>
                <td style="text-align: left !important; padding-left: 20px">{{number_format($data->iva, 0, '', '.')}}</td>
              </tr>
              <tr>
                <th style="color: #3e3676">IMPUESTO ADICIONAL $</th>
                <td style="text-align: left !important; padding-left: 20px">{{number_format(0, 0, '', '.')}}</td>
              </tr>
              <tr>
                <th style="color: #3e3676">TOTAL $</th>
                <td style="text-align: left !important; padding-left: 20px">{{number_format($data->valor_iva, 0, '', '.')}}</td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </body>
</html>